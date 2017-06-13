<?php
namespace App\Controllers;
use Yee\Managers\Controller\Controller;


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


}