<?php
namespace App\Models\Login;

class UserModel
{

    protected $app;
    private $db;
    private $email;
    private $password;

    public function __construct($email, $password)
    {

        $this->app = \Yee\Yee::getInstance();

        $this->email = $email;
        // $this->username = $username;
        $this->password = $password;

        $con = $this->db = $this->app->connection['hotel'];
        if (!$con) {
            $app->flash('error', 'OOPS something is wrong ');
        }

    }
    public function getUser()
    {
        $email = $this->db->where('email', $this->email)->get('user');
        var_dump($email);die;
        if (!$email) {
            $this->app->flash('errorm', "no user exists with this email please register");
            return false;
        } else {
            return $email;
        }
    }

    public function validate()
    {
        $checkUserData = $this->getUser();

        if (isset($_POST['login'])) {
            if ($checkUserData['password'] == $this->password) {
                $userEmail = addslashes(trim($this->email));
                $pass = addslashes(trim($this->password));

                $_SESSION['email'] = $checkUserData['email'];
                return true;
            } else {
                $this->app->flash('errorm', "password is not correct");
                $this->app->redirect('/login', 200);
            }
        }
    }

    // public function validateUser(){
    //     // $info= $this->getUsers();
    //     // if ($info["password"] == $this->password) {
    //     // $_SESSION['username'] = $this->username;

    //     return true;

    //     }
    //     return false;

}
