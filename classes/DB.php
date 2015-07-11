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
	
	/**
	 * Set the database name
	 * 
	 * @param string $name
	 */
	public function setDBName($name) {
		$this->dbname = $name;
	}
	
	/**
	 * Set the database host
	 * 
	 * @param string $host
	 */
	public function setHost($host) {
		$this->host = $host;
	}

	/**
	 * Set the database username
	 * 
	 * @param string $user
	 */
	public function setDBUser($user) {
		$this->user = $user;
	}
	
	/**
	 * Set the database user's password
	 * 
	 * @param string $pass
	 */
	public function setDBPass($pass) {
		$this->pass = $pass;
	}
}
