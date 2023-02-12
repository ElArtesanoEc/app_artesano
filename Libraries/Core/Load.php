<?php 
	
	//convierte la primera letra en mayuscula
	//$controller=ucwords($controller); 
	//Load
	$controllerFile= "Controllers/".$controller.".php";
	if (file_exists($controllerFile)) 
	{
		require_once($controllerFile);
		$controller=new $controller();
		if (method_exists($controller, $method)) 
		{
			$controller->{$method}($params);
		}else{
			require_once("Controllers/Errors.php");
			echo("NO EXISTE EL metodo");
			
		}

	}else{
		require_once("Controllers/Errors.php");
		//echo("NO EXISTE EL CONTROLADOR");
		
	}

 ?>