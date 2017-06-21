<?php
namespace App\Controllers;
use Yee\Managers\Controller\Controller;
use App\Models\RegisterUserModel\RegisterUserModel;


class RegisterController extends Controller
{
   
    /**
     * @Route('/register')
     * @Name('register.form')
     * @Method('Get')
     */
   public function index()
    {
        $app  = $this->getYee();
        $app->render('register.twig');
    }
   
   /**
     * @Route('/register')
     * @Name('register.data')
     * @Method('POST')
     */
     public function registerPost()
    {
        $app  = $this->getYee();

        $email = $app->request->post('email');
        $username = $app->request->post('username');
        $password = $app->request->post('password');
        $password1 = $app->request->post('password1');
        $firstName = $app->request->post('lastName');
        $secondName = $app->request->post('firstName');

        

        $user = new RegisterUserModel($email,$password,$password1,$username,$firstName,$secondName);
        $b=$user->insertUsers();
          
        if($b){
           $app->redirect('/welcome');
        }
        else{
            
            $app->redirect('/register');
        }
         $app->render('login.twig');
        
        
    }
    
    
}   