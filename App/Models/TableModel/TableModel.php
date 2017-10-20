<?php

namespace App\Models\TableModel;

class TableModel 

{
	
	protected $app;
	private $db;
	private $category;

	public function __construct($category = null)
	{
		$this->app=\Yee\Yee::getInstance();

		$this->category = $category;

		$con = $this->db = $this->app->connection['hotel'];
		// var_dump($con);die;

	}

	public function getSubCategories($categories)
	{

		$subCategories = [];

		foreach ($categories as $category) {
			$subCategory = $this->getSubCategory($category['category_id']);
		    $subCategories[$category['category_tag']] = $subCategory;
		}

		return $subCategories;
	}

	public function getCategories()
	{
		return $this->db->get('category');
	}

	// public function getTableOrder()
	// {

	// 	$orders  = $this->db->rawQuery(" SELECT orders.id, orders.quantity, restaurant_tables.table_number as 'table', product.name as 'product_name', product.price FROM orders LEFT JOIN restaurant_tables ON restaurant_tables.id=orders.table_id LEFT JOIN product ON product.id = orders.product_id WHERE restaurant_tables.id = ?, $id 
	// 		"); 
	// }

	public function getSubCategory($id)
	{
		return $this->db->rawQuery("SELECT menu.category_id,menu.menu_id, menu.name, menu.price, menu.description,menu.photo FROM menu JOIN category ON menu.category_id = category.category_id WHERE category.category_id = '$id' ",$id);
	}

}