<?php
namespace App\Controllers;

use App\Models\Login\UserModel;
use Yee\Managers\Controller\Controller;

class LoginController extends Controller
{

    /**
     * @Route('/login')
     * @Name('login.form')
     * @Method('Get')
     */
    public function index()
    {
        $app = $this->getYee();
        $app->render('login.twig');
    }

    /**
     * @Route('/login')
     * @Name('login.data')
     * @Method('POST')
     */
    public function loginPost()
    {
        $app = $this->getYee();

        $email = $app->request->post('email');
        $password = $app->request->post('password');

        $user = new UserModel($email, $password);
        $logUser = $user->getUser();
        // var_dump($logUser);die;
        // $user = UserModel::getByEmail($email);
        // $test = $user->getByEmail($email);
        // var_dump($test);die;
        // $check = $user->validate();

        if ($logUser) {
            $app->redirect('/dash', 200);
        } else {
            $app->redirect('/login', 200);
            flash('error_message', 'wrong password or email');
        }
        // Auth::login($user);

        // if (isset($_SESSION['username'])) {
        //     $app->render('/welcome', array(
        //         'username' => $_SESSION['username'],
        //     ));

        // } else {
        //     $app->render('login.twig');
        // }

        // // if($user->validateUser()){
        // //     $app->redirect('/welcome');
        // //  }else {
        // //     echo 'flash message';
        // // }
        // // echo  $email;
        // //  var_dump($password);

        // $app->render('login.twig');
    }

}
