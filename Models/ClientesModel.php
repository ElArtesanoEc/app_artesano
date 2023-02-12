<?php 
class ClientesModel extends Mysql
{
	private $intIdUsuario;
	private $strIdentificacion;
	private $strNombre;
	private $strApellido;
	private $intTelefono;
	private $strEmail;
	private $strPassword;
	private $strToken;
	private $intTipoId;
	private $intStatus;
	
	public function __construct()
	{
		parent::__construct();
	}	

	public function insertCliente(string $cedula, string $nombre, string $apellido,int $num_celular, string $email, string $password, int $tipoid){

			$this->strIdentificacion = $cedula;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $num_celular;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;


		$return = 0;
		$sql = "SELECT * FROM persona WHERE 
				email_user = '{$this->strEmail}' or cedula = '{$this->strIdentificacion}' ";
		$request = $this->select_all($sql);

		if(empty($request))
		{
			$query_insert  = "INSERT INTO persona(cedula,nombre,apellido,num_celular,email_user,password,rol_id) 
							  VALUES(?,?,?,?,?,?,?)";
        	$arrData = array($this->strIdentificacion,
    						$this->strNombre,
    						$this->strApellido,
    						$this->intTelefono,
    						$this->strEmail,
    						$this->strPassword,
    						$this->intTipoId);
        	$request_insert = $this->insert($query_insert,$arrData);
        	$return = $request_insert;
		}else{
			$return = "exist";
		}
        return $return;
	}

	public function selectClientes()
		{
			$sql = "SELECT id_persona,cedula,nombre,apellido,num_celular,email_user,status
					FROM persona  
					WHERE rol_id=2 and status != 0 ";
			$request = $this->select_all($sql);
					return $request;
		}

	public function selectCliente(int $idpersona){
			$this->intIdUsuario = $idpersona;
			$sql = "SELECT id_persona,cedula,nombre,apellido,num_celular,email_user,status, DATE_FORMAT(datacreated, '%d-%m-%Y') as fechaRegistro 
					FROM persona 
					WHERE id_persona = $this->intIdUsuario and rol_id=2" ;
			$request = $this->select($sql);
			return $request;
		}

	public function updateCliente(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password){

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