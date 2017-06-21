<?php
namespace App\Models; 

class UserModel {
	
	protected $app;
	private $db;
	private $email;
	private $password;
	private $password1;
	private $firstName;
	private $secondName;
	private $username;
	private $user_ip;
	private $date;
	
	public function __construct($email,$password,$password1 = null,$username = null,$firstName = null,$secondName = null){

		$this->app          = \Yee\Yee::getInstance();

		$this->email 		= $email;
		$this->username     = $username;	
		$this->password 	= $password;
		$this->password1    = $password1;
		$this->firstName    = $firstName;
		$this->secondName   = $secondName;
		
		
		$con=$this->db = $this->app->connection['hotel'];
		if(!$con){
			$app->flash('error','OOPS something is wrong ');
		}	
		
	}
	public function getUsers()
	{
		return $this->db->where('user_id',$this->email)->getOne('user');
	}	
	public function validate(){
		$check = $this->getUsers();

		if(isset($_POST['login'])){
			if($check['pass'] == $this->password){
				$userEmail = addslashes(trim($this->email));
				$pass = addslashes(trim($this->password));

				$_SESSION['username'] = $check['username'];
				$this->app->redirect('/welcome',200);
			}
				else
				{
					$this->app->flash('errorm',"password is not correct");
					$this->app->redirect('/login',200);
				}
		}
	}
	

	// public function validateUser(){
	// 	// $info= $this->getUsers();
	// 	// if ($info["password"] == $this->password) {
	// 	// $_SESSION['username'] = $this->username;
		

	// 	return true;
			
	// 	} 
	// 	return false;
	

   		

}