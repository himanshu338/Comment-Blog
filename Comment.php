<?php

require_once("ex1.php");
//require_once("database.php");
require_once("functions.php");
require_once("session.php");
require_once("user.php");
//require_once("cmnt.php");

class Comment{

	public $id;
	public $user_id;
	public $area;
	public $user_name;

	public function create(){
	global $database;
	$sql="INSERT INTO comment (user_id,user_name,area) VALUES ('";
	$sql.=$database->escape_value($this->user_id)."', '";
	$sql.=$database->escape_value($this->user_name)."', '";
	$sql.=$database->escape_value($this->area)."')";
	if($database->query($sql))
	redirect_to("main.php");
	else
	echo "'xxxxxxx";
  	}
	public static function find_by_sql($sql="") {
    	global $database;
    	$result_set = $database->query($sql);
    	$object_array = array();
    	while ($row = $database->fetch_array($result_set)) {
    	  $object_array[] = self::instantiate($row);
    	}

	return $object_array;
   	// return array_shift($object_array);              // array_shift return only top element;
  	}
	private static function instantiate($record) {
    	$object = new self;
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  $object_vars = get_object_vars($this);
	  return array_key_exists($attribute, $object_vars);
	}

}

?>
