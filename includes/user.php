<?php

class User extends DatabaseObject {

	protected static $table_name = "users";
	protected static $db_fields = array('id', 'username', 'name', 'email', 'password', 'company_name', 'phone_number', 'street_address1', 'street_address2', 'city', 'state', 'zip');
	public $id;
	public $username;
	public $password;
	public $name;
	public $email;
	public $company_name;
	public $phone_number;
	public $street_address1;
	public $street_address2;
	public $city;
	public $state;
	public $zip;

	public static function is_unique($username) {
		if(strlen($username) > 0 ) {
			$sql  = "SELECT * FROM users ";
			$sql .= "WHERE username = '{$username}' ";
			$sql .= "LIMIT 1";

			$result_array = self::find_by_sql($sql);
			return empty($result_array) ? true : false;
		}else
			return false;
	}

	public static function authenticate($username="", $password="") {
		global $db;
		$username = $db->escape_value($username);
		$password = $db->escape_value($password);

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";

		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}

}

?>