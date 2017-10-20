<?php
namespace App\Models\RegisterUserModel;

class RegisterUserModel
{

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

    public function __construct($email, $username, $firstName, $secondName, $password, $password1, $date, $hash)
    {

        $this->app = \Yee\Yee::getInstance();

        $this->email = $email;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->password = $password;
        $this->password1 = $password1;
        $this->hash = $hash;

        $date = date('Y-m-d H:i:s');
        $this->date = $date;

        $con = $this->db = $this->app->connection['hotel'];

    }

    //Insert user data in data base

    public function insertUser()
    {

        // $email = mysqli_real_escape_string(trim($this->email));
        // $username = mysqli_real_escape_string(trim($this->username));
        // $password = mysqli_real_escape_string(trim($this->password));
        // $firstName = mysqli_real_escape_string(trim($this->firstName));
        // $secondName = mysqli_real_escape_string(trim($this->secondName));

        // Check if input characters for email field are valid

        $_SESSION['username'] = $this->username;
        $_SESSION['first_name'] = $this->firstName;
        $_SESSION['second_name'] = $this->secondName;
        // var_dump($_SESSION);die;

        if (empty($this->email) && empty($this->username) && empty($this->firstName) && empty($this->secondName) && empty($this->password) && empty($this->password1)) {
            $this->app->flash('empty_fields', "all fieds are required");
            return false;

        }

        // Check if input characters for email field are valid

        if (!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $this->email)) {
            $this->app->flash('error_email', "invalid email");
            return false;
        }

        // check if input characters for username field are valid

        if (!$this->username) {
            $this->app->flash('error_username', "Invalid username");
            return false;
        }

        // check if input characters for password field are valid

        if (mb_strlen($this->password, 'utf8') < 4 || mb_strlen($this->password, 'utf8') > 40) {
            $this->app->flash('error_password', "invalid password");
            return false;
        }

        // check if input characters for firstName field are valid

        if (mb_strlen($this->firstName, 'utf8') < 4 || mb_strlen($this->firstName, 'utf8') > 20) {
            $this->app->flash('error_firstName', "invalid firstName");
            return false;
        }

        // check if input characters for secondName field are valid

        if (mb_strlen($this->secondName, 'utf8') < 4 || mb_strlen($this->secondName, 'utf8') > 30) {
            $this->app->flash('error_secondName', "invalidd Last name");
            return false;
        }

        //var_dump($hash);

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            echo "invalid email";
        }

        if ($this->password1 !== $this->password) {
            $this->app->flash('Error_message', 'unmatch password');
            return false;
        }

        $this->password = hash('sha256', $this->password);
        //check whether username is unique

        // $test = $this->db->WHERE('email', $this->email);
        // $checkUsername = $this->db->get('user');

        // if ($checkUsername > 0) {
        //     $this->app->flash('Error_username', "the email already exist");
        //     return false;
        // } else {

        // hasing password and set unique hash key

        $hash = md5(rand(0, 1000));
        $hashPassword = hash('sha256', $this->password);
        $hashPassword1 = hash('sha256', $this->password1);
        // var_dump($test);die;
        $data = array(
            "email" => $this->email,
            "username" => $this->username,
            "first_name" => $this->firstName,
            "last_name" => $this->secondName,
            "password" => $hashPassword,
            "password1" => $hashPassword1,
            "hash" => $hash,
            // "user_ip" => '201.06.16',
            "sign_up" => $this->date,
        );

        // var_dump($data);die;
        return $this->db->insert('user', $data);
        // }
    }

    //        public function validateEmail() {

    // }

    // public function validatePass() {
    //     if()
    // }

}
