<?php
class SQL1{
	private $connection;
	private $last_query;
	private $magic_quotes_active;
	private $real_escapes_string_exists;
	function __construct(){
		$this->open_connection();
		$this->magic_quotes_active=get_magic_quotes_gpc();
		$this->real_escape_string_exists=function_exists("mysql_real_escape_string");
	}
	public function open_connection(){
		$this-> connection=mysql_connect("localhost","root","");
		if(!$this->connection)
			die("database connection failed".mysql_error());
		else{
			$db_select=mysql_select_db("login_system",$this->connection);
			if(!$db_select)
				die("database selectin failed".mysql_error());
		}
			
	}
	public function close_connection(){
		if(isset($this->connection)){
		mysql_close($this->connection);
		unset($this->connection);
		}
	}
	public function query($sql){
		$this->last_query=$sql;
		$result=mysql_query($sql,$this->connection);
		$this->confirm_query($result);
		return $result;
	}
	public function escape_value($value)
	{
		
		if($this->real_escapes_string_exists)
		{
			if($this->magic_quotes_active)
				$value=stringsplashes($value);
			else{
				$value=addslashes($value);
			}
		}
		return $value;
	}
	private function confirm_query($result)	
	{
		if(!$result)
		{
			echo "last query is:".$this->last_query."<br>";
			die("database query failed".mysql_error());
		}
	}
	public function fetch_array($result_set)
	{
		return mysql_fetch_array($result_set);
	}
	public function num_rows($result)
	{
		return mysql_num_rows($result);
	}
	public function insert_id()
	{
		return mysql_insert_id($this->connection);
	}
	public function affected_rows()
	{
		return mysql_affected_rows($this->connection);
	}
}

$database=new SQL1();
?>
