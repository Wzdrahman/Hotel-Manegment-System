<?php
namespace App\Controllers;
use Yee\Managers\Controller\Controller;
use App\Models\UserModel;

class LoginController extends Controller
{
   
    /**
     * @Route('/login')
     * @Name('login.form')
     * @Method('Get')
     */
   public function index()
    {
        $app  = $this->getYee();
        $app->render('login.twig');
    }
   
    /**
     * @Route('/login')
     * @Name('login.data')
     * @Method('POST')
     */
     public function loginPost()
    {
        $app  = $this->getYee();

        $email = $app->request->post('email');
        $password = $app->request->post('password');

        $user = new UserModel($email,$password);

        $check = $user->validate();

        if(isset($_SESSION['username'])) {
            $app->render('/welcome',array(
                'username' => $_SESSION['username']
                ));
                        
        }
        else{
            $app->render('login.twig');
        }
        
            // if($user->validateUser()){
            //     $app->redirect('/welcome');
            //  }else {
            //     echo 'flash message';
            // }
       echo  $email;
        var_dump($password);
      
         $app->render('login.twig');
    }
    

}