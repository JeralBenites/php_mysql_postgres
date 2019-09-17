<?php

class ClaseCon{

	private $cnx = "";
 	private $server = "";
	private $user = "";
	private $password = "";
	private $bd = "";
	private $bdstate = "";
	private $port = "";

	function __construct(){
		include_once('Data.php');
		$this->server = $config['SERVER'];
		$this->user = $config['USER'];
		$this->password = $config['PASSWORD'];
		$this->bd = $config['BD'];
		$this->bdstate = $config['BDSTATE'];
		$this->port = $config['PORT'];
		$this->cnx = '';
	}

	function conectar(){
		switch ($this->bdstate) {
			case 'mysql':
				$this->cnx = mysqli_connect($this->server,$this->user,$this->password,$this->bd,$this->port) or die('Fuite Bateria !!');
				break;
			case 'postgres':
				$cadena = "host=".$this->server." port=".$this->port." dbname=".$this->bd." user=".$this->user." password=".$this->password;
				$this->cnx = pg_connect($cadena);
				break;
		}
	}

	function consultar($sql=''){
		$this->conectar();
		switch ($this->bdstate) {
			case 'mysql':
			 		mysqli_set_charset($this->cnx,"utf8");
					$temp = mysqli_query($this->cnx,$sql);
					while($fila = mysqli_fetch_assoc($temp)){
							$data[] = $fila;
					}
					mysqli_free_result($temp);
					mysqli_close($this->cnx);
					return $data;
				break;
			case 'postgres':
					$temp = pg_query($this->cnx,$sql);
					while($fila = pg_fetch_assoc($temp)){
						$data[] = $fila;
					}
					pg_close($this->cnx);
					return $data;
				break;
		}
	}

	function ejecutar($sql=''){
		$this->conectar();
		switch ($this->bdstate) {
			case 'mysql':
			 		mysqli_set_charset($this->cnx,"utf8");
					$temp = mysqli_query($this->cnx,$sql);
					return mysqli_fetch_assoc($temp);
				break;
			case 'postgres':
					$temp = pg_query($this->cnx,$sql);
					return pg_fetch_assoc($temp);
				break;
		}
	}

	function Guardar($sql=''){
		$this->conectar();
		switch ($this->bdstate) {
			case 'mysql':
			 		mysqli_set_charset($this->cnx,"utf8");
					if ($this->cnx->query($sql) === TRUE) {
					    return True;
					} else {
					    return "Error: " . $sql . "<br>" . $this->cnx;
					}
					$this->cnx->close();
				break;
			case 'postgres':
					$result = pg_query($this->cnx, $sql);
					if ($result) {
							return True;
					} else {
							return "Error: " . $sql . "<br>" . $this->cnx;
					}
				break;
		}
	}


	function desconectar(){
		switch ($this->bdstate) {
			case 'mysql':
					mysqli_close($this->cnx);
				break;
			case 'postgres':
					pg_close($this->cnx);
				break;
		}

	}

}
?>
