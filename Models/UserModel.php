<?php

namespace App\Models;

class UserModel {
	protected $app;
	private $db;
	private $username;
	private $password;
	private $secondName;
	private $username;

	public function __construct($username,$password){

		$this->name = $username;
		$this->password = $password;

		$this->app = \Yee\Yee::getInstance();
		$this->db = $this->app->connection[
		'ticket_system'];
	}

	public function getUsers(){
		return $this->db->where('id',$this->email)-get('user');
	}

	public function getUsers()
	$data = Array (
		"id" => $email,
		"firstName" => $fistName,
		"lastName" => $secondName,
		"username" => $username,
		"password" => $password
		)
	$this->db->insert('user',$data);

}
public function validateUser(){
		$info = $this->getUser();
		var_dump($info);

		if($info['password'] == $this->password) {
			echo 'yep';
		}
	}
}
