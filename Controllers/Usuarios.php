<?php 
class Usuarios extends Controllers
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
			getPermisos(2);
		}

		public function Usuarios()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header("Location:".base_url().'/dashboard');		
			}
			$data['page_tag']="Usuarios";//se coloca como titulo en la pestaña del navegador
			$data['page_title']="USUARIOS <small>Tienda Virtual</small>";
			$data['page_name']="usuarios";
			$data['page_functions_js']="functions_usuarios.js";
			$this->views->getView($this,"usuarios",$data);//hace referncia a la carpeta vistas al archivo Home.php.......tambien data envia informacion a la ista
		} 

		public function setUsuario($value='')
		{
			
			if($_POST){

				//VALIDA QUE SE ESTE LLENO LOS CAMPOS DEL USUARIO
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtDireccion'])|| empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) )
				{
					//SE CREA UNA ARRA PARA EL SWAL
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
				//SE CREA VARIAMBLES DONDE SE ALMACENAN LOS DATOS RECIBIDOS  
					$idUsuario = intval($_POST['idUsuario']);
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$strDireccion = ucwords(strClean($_POST['txtDireccion']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strEmail = strtolower(strClean($_POST['txtEmail']));
					$intTipoId = intval(strClean($_POST['listRolid']));
					$intStatus = intval(strClean($_POST['listStatus']));
					$request_user="";
					//VALIDACION
					if($idUsuario == 0)
					{
						$option = 1;
						//VALIDAMOS SI NO EXISTE CONTRASEÑA SI NO TIENE SE CREA UNA AUTOMATICAMENTE
						//HASH SIRVE PARA ENCRIPTAR 
						$strPassword =  empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);
						if ($_SESSION['permisosMod']['w']) {
							$request_user = $this->model->insertUsuario($strIdentificacion,
																				$strNombre, 
																				$strApellido,
																				$strDireccion, 
																				$intTelefono, 
																				$strEmail,
																				$strPassword, 
																				$intTipoId, 
																				$intStatus );
						}
					}else{
						$option = 2;
						$strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
						if ($_SESSION['permisosMod']['u']) {
							$request_user = $this->model->updateUsuario($idUsuario,
																		$strIdentificacion, 
																		$strNombre,
																		$strApellido,
																		$strDireccion, 
																		$intTelefono, 
																		$strEmail,
																		$strPassword, 
																		$intTipoId, 
																		$intStatus);
						}
					}					
					if($request_user > 0 )//SI ES MAYOR A 0 SIGNIFICA QUE SI SE INGRESO EL REGISTRO 
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_user == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				//sleep(3);
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getUsuarios()
		{
			if ($_SESSION['permisosMod']['r']) {
				// verifica si tiene acceso el usuario 				
			
			$arrData = $this->model->selectUsuarios();
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
					$btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['id_persona'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
				}
				if($_SESSION['permisosMod']['u']){
					//validacion para que no se pueda editar administradores a excepcion del usuario root
					if(($_SESSION['idUser']== 2 and $_SESSION['userData']['id_rol']== 1) || ($_SESSION['userData']['id_rol'] == 1 and $arrData[$i]['id_rol'] !=1 )){
						$btnEdit = '<button class="btn btn-primary  btn-sm btnEditUsuario" onClick="fntEditUsuario(this,'.$arrData[$i]['id_persona'].')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
					}else{
						$btnEdit = '<button class="btn btn-secondary  btn-sm" disabled><i class="fas fa-pencil-alt"></i></button>';
					}
				}
				if($_SESSION['permisosMod']['d']){
					//bloquea al usuario administrados la opcion de eliminarse 3 condicion 
					if(($_SESSION['idUser']== 2 and $_SESSION['userData']['id_rol']== 1) || ($_SESSION['userData']['id_rol'] == 1 and $arrData[$i]['id_rol'] !=1 ) and $_SESSION['userData']['id_persona']!= $arrData[$i]['id_persona']){
					$btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['id_persona'].')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
					}else{
						$btnDelete = '<button class="btn btn-secondary  btn-sm" disabled><i class="fas fa-trash-alt"></i></button>';
					}
				}


				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		//extrae los datos del usuario 
		public function getUsuario( $idpersona){
			
			if ($_SESSION['permisosMod']['r']) {
				$idusuario = intval($idpersona);
				if($idusuario > 0)
				{
					$arrData = $this->model->selectUsuario($idusuario);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function delUsuario()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['d']) {
					$intIdpersona = intval($_POST['idUsuario']);
					$requestDelete = $this->model->deleteUsuario($intIdpersona);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		//metodo para perfil de usuario 
		public function perfil()
		{
			$data['page_tag']="Perfil";//se coloca como titulo en la pestaña del navegador
			$data['page_title']="Perfil de usuario";
			$data['page_name']="perfil";
			$data['page_functions_js']="functions_usuarios.js";
			$this->views->getView($this,"perfil",$data);//hace referncia a la carpeta vistas al archivo Home.php.......tambien data envia informacion a la ista
		}

		public function putPerfil(){
			if($_POST){
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					$idUsuario = $_SESSION['idUser'];
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = strClean($_POST['txtNombre']);
					$strApellido = strClean($_POST['txtApellido']);
					$strDireccion = strClean($_POST['txtDireccion']);
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strPassword = "";
					if(!empty($_POST['txtPassword'])){
						$strPassword = hash("SHA256",$_POST['txtPassword']);
					}
					$request_user = $this->model->updatePerfil($idUsuario,
																$strIdentificacion, 
																$strNombre,
																$strApellido, 
																$intTelefono, 
																$strPassword);
					if($request_user)
					{
						sessionUser($_SESSION['idUser']);
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
					}
				}
				//sleep(3);
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
}	
?>