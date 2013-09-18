<?php

class Item extends DatabaseObject {

	protected static $table_name = "items";
	protected static $db_fields = array('id','name', 'description', 'price', 'oz');
	public $id;
	public $name;
	public $description;
	public $price;
	public $oz;

	public static function is_unique($name) {
		$sql = "SELECT * FROM items ";
		$sql .= "WHERE name = '{$name}' ";
		$sql .= "LIMIT 1";

		$result_array = self::find_by_sql($sql);
		return empty($result_array) ? true : false;
	}

}

?>