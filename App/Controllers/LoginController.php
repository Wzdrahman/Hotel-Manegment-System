<?php
namespace App\Controllers;

use Yee\Managers\Controller\Controller;
use App\Models\UserModel;

class LoginController extends Controller
{


    /**
     * @Route('/log')
     * @Name('intern.index')
     * @Method('GET')
     */
    public function index()
    {
        $app  = $this->getYee();
        $app->render('log.twig');
        
    }

    /**
     * @Route('/log')
     * @Name('intern.data')
     * @Method('POST')
     */

    public function loginPost()
    {
    	$app = $this->getYee();

    	$email = $app->request->post('email');
        $password = $app->request->post('password');

        $user = new UserModel($email,$password);


    	var_dump($email);
    	var_dump($password);
    	var_dump($user->getUsers());
    	$user->validateUser();

    }
   
        
    }
