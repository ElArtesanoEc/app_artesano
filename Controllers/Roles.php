<?php 
	class Roles extends Controllers{
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

		public function Roles()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header("Location: ".base_url().'/dashboard');
			}
			$data['page_id']=3;
			$data['page_tag']="Roles Usuario";//se coloca como titulo en la pestaña del navegador
			$data['page_title']=" Roles Usuario <small>El ARTESANO</small>";
			$data['page_name']="Roles";
			$data['page_functions_js']="functions_roles.js";
			$this->views->getView($this,"roles",$data);//hace referncia a la carpeta vistas al archivo Home.php.......tambien data envia informacion a la ista
		}

		public function getSelectRoles(){
			$htmlOptions="";
			$arrData= $this->model->selectRoles();
			if (count($arrData)> 0) {
				for ($i=0; $i <count($arrData) ; $i++) { 
					if ($arrData[$i]['status']== 1) {
					$htmlOptions.='<option value="'.$arrData[$i]['id_rol'].'">'.$arrData[$i]['nombre_rol'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();
		}

		public function getRoles()
		{
			if ($_SESSION['permisosMod']['r']) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData= $this ->model->selectRoles();

				for ($i=0; $i < count($arrData); $i++) { 
					if ($arrData[$i]['status']==1) 
					{
						$arrData[$i]['status']='<span class="badge badge-pill badge-success">Activo</span>';
					}
					else{
						$arrData[$i]['status']='<span class="badge badge-pill badge-danger">Inactivo</span>';
					}


					if($_SESSION['permisosMod']['u']){
						$btnView = '<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['id_rol'].')" title="Permisos"><i class="fas fa-key"></i></button>';
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['id_rol'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['id_rol'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}

					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
					

				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
			
		}

		public function getRol(int $idrol)
		{
			if ($_SESSION['permisosMod']['r']) {
				$intIdrol = intval(strClean($idrol));//lo convierte en int y evita inyeciones sql
				if ($intIdrol > 0) 
				{
					$arrData= $this->model->selectRol($intIdrol);
					if (empty($arrData)) 
					{
						//se crea un arreglo con status y ms
						$arrResponse = array('status'=>false,'msg'=> 'Datos no encontrados');					
					}else{
						//se cre un aareglo con el estatus true y en data devjuelvo lo qu el metodo en slectRol
						$arrResponse = array('status' =>true, 'data'=> $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);//convierte en formato jason a lavariable arrRespondse

				}
			}
			die();
		}

		public function setRol()
		{
			if ($_SESSION['permisosMod']['w']) {
				$intIdrol=intval($_POST['idRol']);
				$strRol = strClean($_POST['txtNombre']);
				$strDescipcion= strClean($_POST['txtDescripcion']);
				$intStatus= intval($_POST['listStatus']);
				//$request_rol=$this->model->insertRol($strRol,$strDescipcion,$intStatus);


				if($intIdrol == 0)
				{
					//Crear
					$request_rol = $this->model->insertRol($strRol, $strDescipcion,$intStatus);
					$option = 1;
				}else{
					//Actualizar
					$request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescipcion, $intStatus);
					$option = 2;
				}


				if ($request_rol > 0) 
				{
					if($option == 1)
					{
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}
					//$arrResponse= array('status'=> true, 'msg' =>'Datos guardados correctamente');

				}else if($request_rol == 'exist')
				{
					$arrResponse= array('status'=> false, 'msg' =>'¡Atención! El Rol ya existe');
				}else{
					$arrResponse= array('status'=> false, 'msg' =>'No se pudo Almacenar los datos');
				}
				//sleep(3);
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function delRol()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['d']) {
					$intIdrol = intval($_POST['idrol']);
					$requestDelete = $this->model->deleteRol($intIdrol);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

	}
 ?>