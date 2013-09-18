<?php
require_once("config.php");

class MySQLDatabase {
	
	private $connection = null;
	public $last_query = null;

	function __construct() {
		$this->open_connection();
	}

	public	function open_connection() {
		$this->connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$this->connection) {
			die('Unable to connect to database:'. $this->$connection->connect_error);
		}else {
			$this->set_charset();
		}
	}

	public function close_connection() {
		if(isset($this->connection)) {
			mysqli_close($this->connection);
			unset($this->connection);
		}
	}

	public function query($sql) {
		$this->last_query = $sql;
		if(!$result = $this->connection->query($sql)) {
			die('Database query failed:'. $this->connection->error);
		}
		return $result;
	}

	public function fetch_array($result) {
		return $result->fetch_assoc();
	}

	public function escape_value($value) {
		$this->connection->real_escape_string($value);
		return $value;
	}

	private function set_charset() {
		if (!$this->connection->set_charset('utf8')) {
   		die('Error loading character set utf8 :'. $this->connection->error);
		} 
	}

	public function num_rows($result) {
		return $result->num_rows;
	}

	public function affected_rows() {
		return $this->connection->affected_rows;
	}

	public function insert_id() {
		return $this->connection->insert_id;
	}
}

global $db;
$db = new MySQLDatabase();

?>