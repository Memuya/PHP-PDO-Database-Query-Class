<?php
class DB {
	protected $db;
	protected $host = "localhost";
	protected $dbname = "dbname";
	protected $user = "root";
	protected $pass = "";

	/**
	* Calls the connect() method to connect to the database when the DB object is created
	*/
	public function __construct() {
		try {
			$this->connect();
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}
	}

	/**
	* Connects to database via PDO and sets the error mode to exception
	*/
	public function connect() {
		try {
			$this->db = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->pass);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}
	}

	/**
	* Returns the database connection to be used outside of the clas
	*
	* e.g. $q = $this->db->getDB()->query("sql");
	*/
	public function getDB() {
		return $this->db;
	}

	public function setDBName($name) {
		$this->dbname = $name;
	}

	public function setHost($host) {
		$this->host = $host;
	}

	public function setDBUser($user) {
		$this->user = $user;
	}

	public function setDBPass($pass) {
		$this->pass = $pass;
	}
}
