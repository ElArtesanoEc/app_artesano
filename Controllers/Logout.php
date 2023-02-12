<?php
	class Logout
	{
		public function __construct()
		{
			session_start();
			session_unset();
			session_destroy();//cierra las seciones
			header('location: '.base_url().'/login');//redicciona al login 
		}
	}
 ?>