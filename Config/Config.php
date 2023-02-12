<?php
	//define("BASE_URL", "http://localhost:8080/el_artesano/");
	const BASE_URL="http://localhost:8080/el_artesano";
	//const LIBS ="Libraries/";
	//const VIEWS ="Views/";
//se cambian variables goblales

	//Datos envio de correo
	const NOMBRE_REMITENTE = "El Artesano";
	const EMAIL_REMITENTE = "no-reply@el_artesano.com";
	const NOMBRE_EMPRESA = "El Artesano";
	const WEB_EMPRESA = "Página Web empresa";//www.elartesano.com

	//Zona horaria
	date_default_timezone_set('America/Bogota');

	//Datos para la conexion de la base de datos
	const DB_HOST="localhost";
	const DB_NAME="db_elartesano";//nombre de la base de datos que vamos a usar
	const DB_USER="root";
	const DB_PASSWORD="";//contraseña de la base de datos
	const DB_CHARSET="charset=UTF8";

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "$";

	
?>