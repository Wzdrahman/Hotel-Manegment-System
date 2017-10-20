<?php

namespace App\Controllers\Table;

use Yee\Managers\Controller\Controller;
use App\Models\TableModel\TableModel;


class TableController extends Controller
{ 

	/**
     * @Route('/tables')	
     * @Name('table.data')
     * @Method('Get')
     */

	public function showCategory()
	{
		$app = $this->getYee();

		$category = new TableModel();
		$categories = $category->getCategories();
		$subCategory = $category->getSubCategories($categories);

		//var_dump($subCategory);die;
		$data = [
			'categories'=> $categories,
			'subCategories' => $subCategory,
			'javascript' => ['custom/table-menu.js']
		];
		//var_dump($data);die;

		$app->render('Restaurant/menu.twig', $data);
	}


	// /**
 //     * @Route('/table/:id')
 //     * @Name('subCategory.data')
 //     * @Method('Get')
 //     */

	// public function showSubCategory($id)
	// {
	// 	$app = $this->getYee();
		
	// 	$category = new TableModel();
	// 	$subCategory = $category->getSubCategory($id);
		
	// 	$data = [
	// 		'subCategory' => $subCategory
	// 	];

	// 	$app->render('tableMenu.twig', $data);
	// }

}