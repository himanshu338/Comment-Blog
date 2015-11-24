<?php
// It's going to need the database
require_once('database.php');

class User {
	
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM data");
  }
  
  public static function find_by_id($id=0) {
    $result_array = self::find_by_sql("SELECT * FROM data WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
  
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }

	//return $object_array;
    return array_shift($object_array);              // array_shift return only top element;
  }

  public function create(){
	global $database;
	$sql="INSERT INTO data (username,password,firstname,lastname) VALUES ('";
	$sql.=$database->escape_value($this->username)."', '";
	$sql.=$database->escape_value($this->password)."', '";
	$sql.=$database->escape_value($this->firstname)."', '";
	$sql.=$database->escape_value($this->lastname)."')";
	if($database->query($sql))
	redirect_to("mainpage.php");
	else
	echo "'xxxxxxx";
	
  }

  public static function authenticate($username="",$password=""){
	global $database;
	$sql="SELECT * FROM data WHERE username='";
	$sql.=$database->escape_value($username)."' AND  password='";
	$sql.=$database->escape_value($password)."' LIMIT 1";
	$result_array=self::find_by_sql($sql);
	return $result_array;
	//return !empty($result_array) ? array_shift($result_array) : false;
}

  public function full_name() {
    if(isset($this->first_name) && isset($this->last_name)) {
      return $this->first_name. " " .$this->last_name;
    } else {
      return "qwertt";
    }
  }

	private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		// Simple, long-form approach:
		// $object->id 				= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name 	= $record['last_name'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // get_object_vars returns an associative array with all attributes 
	  // (incl. private ones!) as the keys and their current values as the value
	  $object_vars = get_object_vars($this);
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $object_vars);
	}
}

?>
