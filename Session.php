<?php

require_once("user.php");
require_once("database.php");
class session{

	private $logged_in=false;
	public $user_id;
	public $user_name;
	function __construct(){
		session_start();
		$this->check_login();
		/*if($this->logged_in){
		}
		else{
		}*/
	}

	private function check_login(){
		if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
			$this->user_id=$_SESSION['user_id'];
			$this->user_name=$_SESSION['user_name'];
			$this->logged_in=true;
		}
		else{
			unset($this->user_id);
			unset($this->user_name);
			$this->logged_in=false;
		}	
	}
	public function is_logged_in(){
		return $this->logged_in;
	}
	public function login($user)
	{
		if($user){
			$this->user_id=$_SESSION['user_id']=$user->id;
			$this->user_name=$_SESSION['user_name']=$user->username;
			$this->logged_in=true;
		}			
	}
	public function logout(){
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		unset($this->user_id);
		unset($this->user_name);
		$this->logged_in=false;
	}
}

$session=new session();
?>
