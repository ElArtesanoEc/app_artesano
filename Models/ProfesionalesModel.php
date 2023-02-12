<?php 
//require("conexion.php");
class ProfesionalesModel extends Mysql
{
	private $conexion;


	private $intIdUsuario;
	private $strIdentificacion;
	private $strEmail;
	private $strPassword;
	private $strNombre;
	private $strApellido;
	private $intProfesionId;
	private $intGremioId;
	private $strDireccion;
	private $intTelefono;

	private $strNivelInstruccion;
	private $strFechaInstrucion;
	private $strNombreInstitucion;
	private $strTitulo;
	private $strOtrasHabilidades;

	private $strCargo;
	private $strEmpresa;
	private $strFechaIni;
	private $strFechaFin;
	private $strDescripActs;

	private $strNombreRef;
	private $strApellidoRef;
	private $intTelefonoRef;
	private $strEmailRef;

	private $intInstitucionID;
	private $intEmpresaID;
	private $intReferenciaID;
	
	private $intTipoId;

	
	public function __construct()
	{
		parent::__construct();
		/*$this->conexion = new Conexion();
		$this->conexion = $this->conexion->conect();*/

	}	

	public function SelectProfesion()
	{
			$sql = "SELECT * FROM profesion";
			$request = $this->select_all($sql);
			return $request;
	}

	public function selectGremio()
	{
			$sql = "SELECT * FROM gremio";
			$request = $this->select_all($sql);
			return $request;
	}	


	public function insertProfesional(string $cedula, string $email, string $password, string $nombre, string $apellido, int $profesionId, int $gremioId, string $direccion, int 
		$num_celular, int $nivelInst, string $nombreInstitucion, string $dateInstruccion, string $titulo, string $otrasActs, string $cargo, string $empresa, string $datecargoIni, string $datecargoFin, string $descripcion, string $nombreRef, string $apellidoRef, int $telefonoRef, string $emailRef, int $tipoid)
	{

				$this->strIdentificacion = $cedula;				
				$this->strEmail=$email;
				$this->strPassword=$password;
				$this->strNombre=$nombre;
				$this->strApellido=$apellido;
				$this->intProfesionId=$profesionId;
				$this->intGremioId=$gremioId;
				$this->strDireccion=$direccion;
				$this->intTelefono=$num_celular;

				$this->strNivelInstruccion=$nivelInst;
				$this->strFechaInstrucion=$dateInstruccion;
				$this->strNombreInstitucion=$nombreInstitucion;
				$this->strTitulo=$titulo;
				$this->strOtrasHabilidades=$otrasActs;

				$this->strCargo=$cargo;
				$this->strEmpresa=$empresa;
				$this->strFechaIni=$datecargoIni;
				$this->strFechaFin=$datecargoFin;
				$this->strDescripActs=$otrasActs;

				$this->strNombreRef=$nombreRef;
				$this->strApellidoRef=$apellidoRef;
				$this->intTelefonoRef=$telefonoRef;
				$this->strEmailRef=$emailRef;

				$this->intTipoId = $tipoid;


		$return = 0;
		$sql = "SELECT * FROM profesional WHERE 
				email_profesional = '{$this->strEmail}' or cedula_p = '{$this->strIdentificacion}' ";
		$request = $this->select_all($sql);

		if(empty($request))
		{
			/*informacion personal*/
			$query_insert  = "INSERT INTO profesional(cedula_p,nombre_p,apellido_p,direccion_p,num_celular_p,email_profesional,password,rol_id,profesion_id,gremio_id)
							  VALUES(?,?,?,?,?,?,?,?,?,?)";/*insertar categoria*/
        	$arrData = array($this->strIdentificacion,
    						$this->strNombre,
    						$this->strApellido,
    						$this->strDireccion,
    						$this->intTelefono,
    						$this->strEmail,
    						$this->strPassword,
    						$this->intTipoId,
    						$this->intProfesionId,
    						$this->intGremioId
    						/*$this->intInstitucionID,
        					$this->intEmpresaID,      					
        					$this->intReferenciaID*/);
        	$request_insert = $this->insert($query_insert,$arrData);

        	if ($request_insert=1) {

        					/*informacion academica*/
			$query_insert1  = "INSERT INTO institucion(nivel_instrucion,nombre_institucion,titulo_adquirido,fechaFin,otras_habilidades) 
							  VALUES(?,?,?,?,?)";
        	$arrData = array($this->strNivelInstruccion,
    						$this->strNombreInstitucion,
    						$this->strTitulo,
    						$this->strFechaInstrucion,
    						$this->strOtrasHabilidades);
        	$request_insert1 = $this->insert($query_insert1,$arrData);

        	}
        	if ($request_insert1=1) {

        		/*experiencia profecional*/
        	$query_insert2  = "INSERT INTO empresa(nombre_empresa,cargo,descripcion_act,fecha_ini,fecha_fin) 
							  VALUES(?,?,?,?,?)";
        	$arrData = array($this->strEmpresa,
    						$this->strCargo,
    						$this->strDescripActs,
    						$this->strFechaIni,
    						$this->strFechaFin);
        	$request_insert2 = $this->insert($query_insert2,$arrData);

        	
        	}
        	if ($request_insert2=1) {
        		/*Referencias*/
        	$query_insert3  = "INSERT INTO referencias(nombre_referencia,apellido_referencia,telefono_referencia,email_referencia) 
							  VALUES(?,?,?,?)";
        	$arrData = array($this->strNombreRef,
    						$this->strApellidoRef,
    						$this->intTelefonoRef,
    						$this->strEmailRef);
        	$request_insert3 = $this->insert($query_insert3,$arrData);
        	        
        	}

        	$return = $request_insert3;
		}else{
			$return = "exist";
		}
        return $return;
	}

	public function selectProfesionales()
		{
			$sql = "SELECT pr.id_profesional,
						   pr.cedula_p,
						   pr.nombre_p,
						   pr.apellido_p,
						   pr.num_celular_p,
						   pr.email_profesional,
						   pf.nombre_profesion as profesion,
						   g.nombreG as gremio,
						   pr.status
					FROM profesional pr
					INNER JOIN profesion pf 
					on pr.profesion_id = pf.id_profesion 
					INNER JOIN gremio g
					on pr.gremio_id = g.id_gremio
					WHERE pr.status != 0 ";
					$request = $this->select_all($sql);
			return $request;
		}

	public function selectProfesional(int $idpersona){
			$this->intIdUsuario = $idpersona;
			$sql = "SELECT id_persona,cedula,nombre,apellido,num_celular,email_user,status, DATE_FORMAT(datacreated, '%d-%m-%Y') as fechaRegistro 
					FROM persona 
					WHERE id_persona = $this->intIdUsuario and rol_id=2" ;
			$request = $this->select($sql);
			return $request;
		}

	public function updateProfesional(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password){

			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			//$this->strDireccion = $direccion;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;


			$sql = "SELECT * FROM persona WHERE (email_user = '{$this->strEmail}' AND id_persona != $this->intIdUsuario)
										  OR (cedula = '{$this->strIdentificacion}' AND id_persona != $this->intIdUsuario) ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				if($this->strPassword  != "")
				{
					$sql = "UPDATE persona SET cedula=?, nombre=?, apellido=?, num_celular=?, email_user=?, password=? 
							WHERE id_persona = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						//$this->strDireccion,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->strPassword);
				}else{
					$sql = "UPDATE persona SET cedula=?, nombre=?, apellido=?, num_celular=?, email_user=? 
							WHERE id_persona = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						//$this->strDireccion,
	        						$this->intTelefono,
	        						$this->strEmail);
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		
		}
		/*public function deleteUsuario(int $intIdpersona)
		{
			$this->intIdUsuario = $intIdpersona;
			$sql = "UPDATE persona SET status = ? WHERE id_persona = $this->intIdUsuario ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
			
		}*/


		public function deleteCliente(int $intIdpersona)
		{
			$this->intIdUsuario = $intIdpersona;
			$sql = "UPDATE persona SET status = ? WHERE id_persona = $this->intIdUsuario ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
			
		}
}

?>