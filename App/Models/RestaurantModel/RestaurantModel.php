<?php
namespace App\Models\RestaurantModel;

	class RestaurantModel 
{

protected $app;
private $db;
private $table;
private $subcategory;
private $quantity;
private $restData;
	
public function __construct($table=null,$subcategory=null,$quantity=null)
{
	$this->app=\Yee\Yee::getInstance();

	$this->table         = $table;
	$this->subcategory   = $subcategory;
	$this->quantity      = $quantity;

    $conect = $this->db = $this->app->connection['hotel'];

}

public function insertData()
{
	$check = true;
	$check_quant = true;
	$check_sub = true;


    if (!preg_match('/^[1-9][0-9]{0,4}$/', $this->table)) {
        $this->app->flash('error_table','only ditgit allow');
	    $check = false;
	}


	if (!preg_match('/^[1-9][0-9]{0,4}$/', $this->quantity)) {
        $this->app->flash('error_quantity','only ditgit allow');
        $check_quant = false;
    }

    if(!$check || !$check_quant || !$check_sub){
    	$this->app->redirect('restaurant',200);
    	return false;
    }
    else{

    	

    	
    	$tableOrderData = array(

    		'table_id' => $this->table
    	);
    	//var_dump($tableOrderData);die;

    	$tableOderId = $this->db->insert('table_order', $tableOrderData);
    	//var_dump($tableOderId);die;
    	$orderData = array(
    		'table_order_id' => $tableOderId,
    		'quantity' => $this->quantity,
    		'product_id' => $this->subcategory
    	);

    	$con = $this->db->insert('orders',$orderData);
    	return true;
    }



    
}

	public function getData()
	{
		$data = [];

		$tables = $this->db->get('restaurant_tables');
		$products = $this->db->get('product');
		$orders = $restData = $this->db->rawQuery('
		 SELECT product.name, product.price,orders.table_order_id, orders.quantity, restaurant_tables.table_number
		 FROM restaurant_tables
		 JOIN table_order ON restaurant_tables.table_number = table_order.table_id
	   	 JOIN orders ON table_order.id = orders.table_order_id
	 	 JOIN product on product.id = orders.product_id');
		//var_dump($orders);die;


		$data['tables'] = $tables;
		//var_dump($tables);die;
		$data['products'] = $products;
		//var_dump($products);die;
		$data['orders'] = $orders;
		//	var_dump($orders);die;
		

		return $data;
	}
	

	public function DeleteRow($id) 
	{
		$this->app->connection['hotel']->where('table_order_id', $id);
		if($this->app->connection['hotel']->delete('orders')) return true;

	} 


	

	public function EditRow($id)
	{	
		$data = [];

		$tables = $this->db->get('restaurant_tables');
		$products = $this->db->get('product');
		$orders = $restData = $this->db->rawQuery('
		 SELECT product.name, product.price,orders.table_order_id, orders.quantity, restaurant_tables.table_number
		 FROM restaurant_tables
		 JOIN table_order ON restaurant_tables.table_number = table_order.table_id
	   	 JOIN orders ON table_order.id = orders.table_order_id
	 	 JOIN product on product.id = orders.product_id WHERE orders.table_order_id =' ."$id");
		//var_dump($id);die;


		$data['tables'] = $tables;
		//var_dump($tables);die;
		$data['products'] = $products;
		//var_dump($products);die;
		$data['orders'] = $orders;
		//	var_dump($orders);die;
		
		//$this->app->connection['hotel']->where ('table_order_id', $orders);
        // if ($this->app->connection['hotel']->update ('orders', $data))

		return $data;	


// 		$data = Array (
//     'firstName' => 'Bobby',
//     'lastName' => 'Tables',
//     'editCount' => $app->db['db1']->inc(2),
//     // editCount = editCount + 2;
//     'active' => $app->db['db1']->not()
//     // active = !active;
// );
// $app->db['db1']->where ('id', 1);
// if ($app->db['db1']->update ('users', $data))
//     echo $app->db['db1']->count . ' records were updated';
// else
//     echo 'update failed: ' . $app->db['db1']->getLastError();
	}

	public function updateRedocrd($id,$data)
	{
// 		$data = Array (
//     'firstName' => 'Bobby',
//     'lastName' => 'Tables',
//     'editCount' => $app->db['db1']->inc(2),
//     // editCount = editCount + 2;
//     'active' => $app->db['db1']->not()
//     // active = !active;
// );
$this->app->connection['hotel']->where ('table_order_id', $id);
$this->app->connection['hotel']->update ('orders', $data);return true;
    // echo $app->db['db1']->count . ' records were updated';
// else
//     echo 'update failed: ' . $app->db['db1']->getLastError();
// 	}
}
}