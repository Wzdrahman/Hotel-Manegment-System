<?php
namespace App\Models\RegisterUserModel;

class RegisterUserModel { 


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

public function __construct($email,$password,$password1,$username ,$firstName,$secondName){

		$this->app          = \Yee\Yee::getInstance();

		$this->email 		= $email; 
		$this->username     = $username;	
		$this->password 	= $password;
		$this->password1	= $password1;
		$this->firstName    = $firstName;
		$this->secondName   = $secondName;
		$date=date('Y-m-d');
		
		$b=$this->db = $this->app->connection['hotel'];	
		
	}

	public function insertUsers() {

	
			// $email = mysqli_real_escape_string(trim($this->email));
			// $username = mysqli_real_escape_string(trim($this->username));
			// $password = mysqli_real_escape_string(trim($this->password));
			// $firstName = mysqli_real_escape_string(trim($this->firstName));
			// $secondName = mysqli_real_escape_string(trim($this->secondName));	

			if (!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $this->email)) {
				$this->app->flash('error_email',"invalid email");
			}

			if(!$this->username){
				$this->app->flash('error_username',"Invalid username");
				return false;
			}

			if(mb_strlen($this->password,'utf8') < 4 || mb_strlen($this->password) > 40){
				$this->app->flash('error_password',"invalid password");
			}

			if(mb_strlen($this->firstName,'utf8') < 4 || mb_strlen($this->firstName) > 20){
				$this->app->flash('error_firstName',"invalid firstName");
			}

			if(mb_strlen($this->secondName,'utf8') < 4 || mb_strlen($this->secondName) > 30){
				$this->app->flash('error_secondName',"invalidd Last name");
			}
		

		$hash=hash('sha256',$this->password);
		var_dump($hash);

			if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			    echo "This (email_id) email address is considered valid.";
			    return true;
			}	
			return false;	

			if($this->password1 !== $this->password ){
				$this->$app->flash('Error_message','bad password');
				return false;
			}
			return true;


		$data = Array ("user_id" => $this->email,
			 		   "username" => $this->username,
		               "first_name" => $this->firstName,
		               "last_name" => $this->secondName,
		               "pass" => $this->password,
		               "password" => $this->password1, 
		               "user_ip" => '201.06.16',
		               "sign_up" => $date
		               );


		var_dump($email);
        var_dump($username);
        var_dump($password);
        var_dump($firstName);

	 $this->db->insert('user', $data);




	
	}

 //    	public function validateEmail() {


		


	// }

	  // public function validatePass() {
	  // 	if()
	  // }



}