<?php 
	class Dashboard extends Controllers{
		public function __construct()
		{
			sessionStart();
			parent::__construct();
			//session_start();
			//session_regenerate_id(true);
			if (empty($_SESSION['login'])) 
			{
				header('Location:'.base_url().'/login');
			}
			getPermisos(1);

		}

		public function dashboard()
		{
			$data['page_id']=2;
			$data['page_tag']="Dashboard - El ARTESANO";//se coloca como titulo en la pestaña del navegador
			$data['page_title']=" Dashboard - El ARTESANO";
			$data['page_name']="dashboard";
			//$data['page_functions_js'] = "functions_dashboard.js";
			
			$this->views->getView($this,"dashboard",$data);//hace referncia a la carpeta vistas al archivo Home.php.......tambien data envia informacion a la ista
		}

	}


 ?>