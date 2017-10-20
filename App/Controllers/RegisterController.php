<?php
namespace App\Controllers;

use App\Models\RegisterUserModel\RegisterUserModel;
use Yee\Managers\Controller\Controller;

class RegisterController extends Controller
{

    /**
     * @Route('/register')
     * @Name('register.form')
     * @Method('Get')
     */

    public function index()
    {
        $app = $this->getYee();
        $app->render('register.twig');
    }

    /**
     * @Route('/register')
     * @Name('register.form')
     * @Method('POST')
     */

    public function registerPost()
    {
        $app = $this->getYee();

        $email = $app->request->post('email');
        $username = $app->request->post('username');
        $secondName = $app->request->post('first_name');
        $firstName = $app->request->post('last_name');
        $password = $app->request->post('password');
        $password1 = $app->request->post('password1');

        $user = new RegisterUserModel($email, $username, $firstName, $secondName, $password, $password1, $hash = null, $date = null);
        $newUser = $user->insertUser();

        if ($newUser) {
            $app->redirect('/login');
        } else {

            $app->redirect('/register');
        }

    }

}
