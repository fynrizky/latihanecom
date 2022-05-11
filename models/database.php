<?php
class Database {
	private $host;
	private $user;
	private $pass;
	private $database;
	public $koneksi; //property



	function __construct($host, $user, $pass, $database) {
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->database = $database;

		$this->koneksi = new mysqli($this->host, $this->user, $this->pass, $this->database) or die (mysqli_error());
		if (!$this->koneksi) {
			return false;
		}else{
			return true;
		}
	}	

}
?>
