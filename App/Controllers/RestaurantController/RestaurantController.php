<?php

namespace App\Controllers\RestaurantController;

use Yee\Managers\Controller\Controller;
use App\Models\RestaurantModel\RestaurantModel;

class RestaurantController extends Controller 
{
	
	/**
     * @Route('/restaurant')
     * @Name('restaurant.form')
     * @Method('Get')
     */
   public function index()
    {
        $app  = $this->getYee();

        $restaurant = new RestaurantModel();
        $data = $restaurant->getData();

        $data = [
        	'data' => $data
        ];

        //var_dump($data);die;
        
        
        $app->render('Restaurant/restaurant.twig', $data);
    }


    /**
     * @Route('/restaurant')
     * @Name('restaurant.data')
     * @Method('POST')
     */
     public function restaurantData() {
        $app  = $this->getYee();

        $table = $app->request->post('table_number');
        $subcategory = $app->request->post('sub_category');
        $quantity = $app->request->post('quantity');

        $restaurant = new RestaurantModel($table,$subcategory,$quantity);       
        $b=$restaurant->insertData();

        if ($b) {
        	$app->redirect('/restaurant',200);
    		return true;
        } else { 
        	$app->redirect('/login',200);
        	return false;
        }
     }

      /**
     * @Route('/restaurantdel/:id')
     * @Name('restaurant.data')
     * @Method('GET')
     */

     public function Delete($id)
     {
        $app  = $this->getYee();		
     	$del = new RestaurantModel();
     	$delete = $del->DeleteRow($id);
     	if($delete){
     		$app->redirect('/restaurant',200);
     	}
     }

   
   /**
     * @Route('/restaurantedit/:id')
     * @Name('restaurant.data')
     * @Method('GET')
     */

     public function Edit($id)
     {
      	$app  = $this->getYee();
     	$edit = new RestaurantModel();
     	
        $editRow = $edit->EditRow($id);

       	$edit = [
       		'edit' => $editRow
       	];

       	//	var_dump($edit);die;

       	
        $app->render('/edit.twig',$edit);
     	//var_dump($editRow);die;	
     	
     	// if($editRow)
     	// {
     	// 	$app->redirect('/edit',$editRow,200);
     	// }
     }
     

     /**
     * @Route('/update/:id')
     * @Name('restaurant.data')
     * @Method('POST')
     */

     public function updateData($id)
     {	
     	$app = $this->getYee();
     	$data = $app->request->post();

     	$dataRecord = new RestaurantModel();
     	$dataRecord->updateRedocrd($id,$data);


     	if($dataRecord){
     		redirect('/restaurant',200);
     	}

     	

     }

}