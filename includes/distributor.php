<?php

class Distributor extends DatabaseObject {

	protected static $table_name = "distributors";
	protected static $db_fields = array('id', 'name', 'email');
	public $id;
	public $name;
	public $email;

}

?>