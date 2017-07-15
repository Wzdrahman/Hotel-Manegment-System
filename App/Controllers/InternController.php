<?php
namespace App\Controllers;
use Yee\Managers\Controller\Controller;
use App\Models\UserModel;


class InternController extends Controller
{
    /**
     * @Route('/')
     * @Name('intern.index')
     */
    public function index()
    {
        $app  = $this->getYee();
        $app->render('test.twig', array(
                'data' => 'hello',
                'test' => 'test',
                'countries' => 'bulgaria'
            ));
        
    }

    /**
     * @Route('/test')
     * @Name('intern.testRoute')
     */
    public function testRoute()
    {
        $app  = $this->getYee();
        $app->render('test.twig', array(
                'data' => 'hello',
                'test' => 'test',
                'countries' => 'the uk'
            ));
        
    }
    
    /**
     * @Route('/layout')
     */
     public function layout()
    {
        $app  = $this->getYee();
        $app->render('layout.twig');
    }


     /**
     * @Route('/login')
     */
     public function login()
    {
        $app  = $this->getYee();
        $app->render('login.twig');
    }

    /**
     * @Route('/welcome')
     */
     public function welcome()
    {
        $app  = $this->getYee();
        $app->render('welcome.twig');
    }


    /**
     * @Route('/dash')
     */
     public function dash()
    {
        $app  = $this->getYee();
        $app->render('dash.twig');
    }

    /**
     * @Route('/edit')
     */
     public function edit()
    {
        $app  = $this->getYee();
        $app->render('edit.twig');
    }
}