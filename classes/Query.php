<?php
require_once 'classes/DB.php';
class Query extends DB {
	private $count;
	private $data;
	private $sql;
	private $values;
	private $fetch_style;

	/**
	* Set sql query and the values to bind to the query
	*
	* @param string $sql
	* @param array $values
	*/
	public function __construct($sql, $values = []) {
		parent::__construct();
		$this->sql = $sql;
		$this->values = $values;
		$this->fetch_option = PDO::FETCH_OBJ;
	}

	/**
	* Returns all rows from the database
	*/
	public function getAll() {
		try {
			$q = $this->db->prepare($this->sql);

			$q->execute($this->values);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}
		
		$this->count = $q->rowCount();
		
		if($this->count != 0)
			while($r = $q->fetch($this->fetch_option)) 
				$this->data[] = $r;
				  
		return $this->data;
	}

	/**
	* Returns a single row from the database
	* Use as $obj->single()->fieldYouWant
	*/
	public function single() {
		try {
			$q = $this->db->prepare($this->sql);

			$q->execute($this->values);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}
		
		$this->count = $q->rowCount();
		
		if($this->count != 0)
			$this->data = $q->fetch($this->fetch_option);
				  
		return $this->data;
	}

	/**
	* Executes a query and return the amount of rows affected if no message is passed through
	* Used for queries such as DELETE, INSERT, UPDATE, etc
	*/
	public function commit($message = null) {
		try {
			$q = $this->db->prepare($this->sql);

			$q->execute($this->values);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$this->count = $q->rowCount();
		$suffix = ($this->count != 1) ? 's' : null;

		return (!empty($message)) ? $message : $this->count." row".$suffix." affected";
	}
	
	/**
	 * Change the PDO fetch style
	 * 
	 * @param string $style
	 */
	public function setFetchStyle($style) {
		$this->fetch_style = $style;
	}

	/**
	* Returns the last inserted ID
	*/
	public function lastInsertId() {
		return $this->db->lastInsertId();
	}

	/**
	* Returns the amount of rows affected from a query
	*/
	public function getCount() {
		return $this->count;
	}

	/**
	* Returns the data array
	*/
	public function getData() {
		return $this->data;
	}

	/**
	* Returns the SQL query as a string
	*/
	public function getSQL() {
		return $this->sql;
	}
}
