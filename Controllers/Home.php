<?php 
	class Home extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function home()
		{

			$data['page_tag']=NOMBRE_EMPRESA;//se coloca como titulo en la pestaña del navegador
			$data['page_title']=NOMBRE_EMPRESA;
			$data['page_name']="home";
			$data['page_content']="Lorem ipsum ";
			$this->views->getView($this,"home",$data);//hace referncia a la carpeta vistas al archivo Home.php.......tambien data envia informacion a la ista
		}
		public function insertar()
		{
			$data=$this->model->setUser("Maria",30);
			print_r($data);
		}
		public function verUsuario($id)
		{
			$data=$this->model->getUser($id);
			print_r($data);
		}
		public function actualizar($id)
		{
			$data=$this->model->updateUser(2,"Roverto",56);
			print_r($data);
		}
		public function verAllUser($id)
		{
			$data=$this->model->getUsers($id);
			print_r($data);
		}
		public function eliminarusuario($id)
		{
			$data=$this->model->delUsers($id);
			print_r($data);
		}


		




	}


 ?>