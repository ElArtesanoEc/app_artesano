<?php 
class Profesionales extends Controllers
{
		public function __construct()
		{
			sessionStart();
			parent::__construct();
			/*session_start();
			session_regenerate_id(true);*/
			if (empty($_SESSION['login'])) 
			{
				header('Location:'.base_url().'/login');
			}			
			getPermisos(4);
		}

		public function Profesionales()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header("Location:".base_url().'/dashboard');		
			}
			$data['page_tag']="Profesionales";//se coloca como titulo en la pestaña del navegador
			$data['page_title']="PROFESIONALES <small>El ARTESANO</small>";
			$data['page_name']="profesionales";
			$data['page_functions_js']="functions_profesionales.js";
			$this->views->getView($this,"profesionales",$data);//hace referncia a la carpeta vistas al archivo Home.php.......tambien data envia informacion a la ista
		} 

		public function setProfesional()
		{
			/*dep($_POST);
			dep($_FILES);
			exit();*/
			if($_POST){
				//dep($_POST);exit();
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtEmail']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['listProfid']) || empty($_POST['listGremid']) || empty($_POST['txtDireccion']) || empty($_POST['txtTelefono']) || empty($_POST['listIntruccionid']) || empty($_POST['txtNombreInstitucion']) || empty($_POST['txtDateInstrucion']) || empty($_POST['txtTitulo']) || empty($_POST['txtCargo']) || empty($_POST['txtEmpresa']) || empty($_POST['txtDatecargoini']) || empty($_POST['txtDatecargofin']) || empty($_POST['txtNombreRef']) || empty($_POST['txtApellidoRef']) || empty($_POST['txtEmailRef']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
						$idProfesional = intval($_POST['idProfesional']);
						$strIdentificacion = strClean($_POST['txtIdentificacion']);
						$strEmail = strtolower(strClean($_POST['txtEmail']));
						$strNombre = strClean($_POST['txtNombre']);
						$strApellido = strClean($_POST['txtApellido']);
						$intProfesion = intval($_POST['listProfid']);
						$intGremio = intval($_POST['listGremid']);
						$strDireccion = strClean($_POST['txtDireccion']);
						$intTelefono = intval(strClean($_POST['txtTelefono']));

						$strNivelInst = intval($_POST['listIntruccionid']);
						$strNombreInstitucion = strClean($_POST['txtNombreInstitucion']);
						$strDateInstruccion = strClean($_POST['txtDateInstrucion']);
						/*$date = DateTime::createFromFormat('m/Y', $strDateInstruccion);
						$strDateInstruccion = $date->format('Y-m-d');*/
						//$strDateInstruccionBD=date('Y-m-d',strtotime('01-'.str_replace('/','-',$strDateInstruccion)));
						$strTitulo = strClean($_POST['txtTitulo']);
						$strOtrasAct = strClean($_POST['txtOtrasAct']);

						$strCargo = strClean($_POST['txtCargo']);
						$strEmpresa = strClean($_POST['txtEmpresa']);
						$strDatecargoIni = strClean($_POST['txtDatecargoini']);
						$strDatecargoFin = strClean($_POST['txtDatecargofin']);
						$strDescripcion = strClean($_POST['txtDescripcionAct']);
						

						$strNombreRef = strClean($_POST['txtNombreRef']);
						$strApellidoRef = strClean($_POST['txtApellidoRef']);
						$intTelefonoRef = intval(strClean($_POST['txtTelefonoRef']));
						$strEmailRef = strtolower(strClean($_POST['txtEmailRef']));

						$intTipoId = 4;
						$request_profesional = "";
					if($idProfesional == 0)
					{
						$option = 1;
						$strPassword =  empty($_POST['txtPassword']) ? passGenerator() : $_POST['txtPassword'];
						$strPasswordEncript = hash("SHA256",$strPassword);
						if($_SESSION['permisosMod']['w']){
							$request_profesional = $this->model->insertProfesional($strIdentificacion,
																				$strEmail,
																				$strPasswordEncript,
																				$strNombre, 
																				$strApellido,
																				$intProfesion,
																				$intGremio,
																				$strDireccion, 
																				$intTelefono,
																				$strNivelInst,
																				$strNombreInstitucion,
																				$strDateInstruccion,
																				$strTitulo,
																				$strOtrasAct,
																				$strCargo,
																				$strEmpresa,
																				$strDatecargoIni,
																				$strDatecargoFin,
																				$strDescripcion,
																				$strNombreRef,
																				$strApellidoRef,
																				$intTelefonoRef, 
																				$strEmailRef,
																				$intTipoId);
						}
					}else{
						$option = 2;
						$strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
						if($_SESSION['permisosMod']['u']){
							$request_profesional = $this->model->updateCliente($idProfesional,
																		$strIdentificacion, 
																		$strNombre,
																		$strApellido, 
																		$intTelefono, 
																		$strEmail,
																		$strPassword);
						}
					}

					if($request_profesional > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
							$nombreUsuario = $strNombre.' '.$strApellido;
							$dataUsuario = array('nombreUsuario' => $nombreUsuario,
												 'email' => $strEmail,
												 'password' => $strPassword,
												 'asunto' => 'Bienvenido a tu tienda en línea');
							//sendEmail($dataUsuario,'email_bienvenida');
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_profesional == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}	
			die();
		}

		public function getProfesionales()
		{

			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectProfesionales();
				//dep($arrData);
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['id_profesional'].')" title="Ver categoría"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['id_profesional'].')" title="Editar categoría"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['id_profesional'].')" title="Eliminar categoría"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getSelectProfesion(){
			$htmlOptions = "";
			$arrData = $this->model->SelectProfesion();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					/*if($arrData[$i]['status'] == 1 ){*/
					$htmlOptions .= '<option value="'.$arrData[$i]['id_profesion'].'">'.$arrData[$i]['nombre_profesion'].'</option>';
					/*}*/
				}
			}
			echo $htmlOptions;
			die();	
		}
		public function getSelectGremio(){
			$htmlOptions = "";
			$arrData = $this->model->selectGremio();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					/*if($arrData[$i]['status'] == 1 ){*/
					$htmlOptions .= '<option value="'.$arrData[$i]['id_gremio'].'">'.$arrData[$i]['nombreG'].'</option>';
					/*}*/
				}
			}
			echo $htmlOptions;
			die();	
		}
}
 ?>