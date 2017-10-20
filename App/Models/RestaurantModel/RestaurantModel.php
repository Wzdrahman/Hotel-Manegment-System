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

    private $tableFields = [
        'table_id',
        'quantity',
        'product_id',
    ];

    private function getTableFieldsFromArray($array)
    {
        return array_filter($array, function ($key) {
            return in_array($key, $this->tableFields);
        }, ARRAY_FILTER_USE_KEY);
    }

    public function __construct($table = null, $subcategory = null, $quantity = null)
    {
        $this->app = \Yee\Yee::getInstance();

        $this->table = $table;
        $this->subcategory = $subcategory;
        $this->quantity = $quantity;

        $conect = $this->db = $this->app->connection['hotel'];

    }

    public function insertData()
    {
        $check = true;
        $check_quant = true;
        $check_sub = true;

        if (!preg_match('/^[1-9][0-9]{0,4}$/', $this->table)) {
            $this->app->flash('error_table', 'only ditgit allow');
            $check = false;
        }

        if (!preg_match('/^[1-9][0-9]{0,4}$/', $this->quantity)) {
            $this->app->flash('error_quantity', 'only ditgit allow');
            $check_quant = false;
        }

        if (!$check || !$check_quant || !$check_sub) {
            $this->app->redirect('restaurant', 200);
            return false;
        } else {

            $orderData = array(
                'table_id' => $this->table,
                'quantity' => $this->quantity,
                'product_id' => $this->subcategory,
            );

            $con = $this->db->insert('orders', $orderData);
            return true;
        }
    }

    public function getData()
    {
        $data = [];

        $tables = $this->db->get('restaurant_tables');
        $products = $this->db->get('product');
        $orders = $this->db->rawQuery("
			SELECT orders.id, orders.quantity,
				 restaurant_tables.table_number as 'table',
				 product.name as 'product_name',
				 product.price
			FROM orders
			LEFT JOIN restaurant_tables ON restaurant_tables.id=orders.table_id
			LEFT JOIN product ON product.id = orders.product_id ");
        //var_dump($orders);die;

        //var_dump($tables);die;
        $data['products'] = $products;
        //var_dump($products);die;
        $data['orders'] = $orders;
        //var_dump($orders);die;

        //var_dump($data);die;
        return $data;

    }

    public function DeleteRow($id)
    {
        $this->app->connection['hotel']->where('id', $id);
        if ($this->app->connection['hotel']->delete('orders')) {
            return true;
        }

    }

    public function GetRestaurantTables()
    {
        return $this->db->get('restaurant_tables');
    }
    public function GetProducts()
    {
        return $this->db->get('product');
    }
    public function GetOrderJoin($id)
    {
        return $this->db->rawQuery("
		 SELECT orders.id, orders.quantity,
				 restaurant_tables.table_number as 'table',
				 product.name as 'product_name',
				 product.price
			FROM orders
			LEFT JOIN restaurant_tables ON restaurant_tables.id=orders.table_id
			LEFT JOIN product ON product.id = orders.product_id
	 	 WHERE orders.id = '$id' ", $id);
    }
    public function GetOrdersJoin()
    {
        return $this->db->rawQuery("
		 SELECT orders.id, orders.quantity,
				 restaurant_tables.table_number as 'table',
				 product.name as 'product_name',
				 product.price
			FROM orders
			LEFT JOIN restaurant_tables ON restaurant_tables.id=orders.table_id
			LEFT JOIN product ON product.id = orders.product_id
			WHERE orders.id = '$id'
	 	 ");
    }

    public function updateRedocrd($id, $newTable, $newProductName, $newQuantity)
    {
        // var_dump($newTable);die;
        $arr = [
            'table_id' => $newTable,
            'product_id' => $newProductName,
            'quantity' => $newQuantity,
        ];
        ///    var_dump($arr);die;

        $this->db->where('id', $id);
        $this->db->update('orders', $arr);
        //$this->db->update('restaurant_tables',$tableNumber);
        //$this->db->where('product_id',$id);
        // $this->db->update('product',$product);
        return true;
        //->update('restaurant_tables',$datanew)
        ;
    }

    // public function Order($subcategory, $quantity)
    // {

    //     error_reporting(0);
    //     echo '<p align="center">JollyBee Food Corporation</br>
    //     1/F Kalentong cor. Shaw Blvd. Mandaluyong City 550</br>
    //         </br></p></br>';

    //     if (isset($_POST['btnGen'])) {
    //         {

    //             foreach ($subcategory as $data) {

    //                 if ($data == 'Chicken Joy') {
    //                     $price = 90.00;
    //                     $total += 90.00;
    //                 } else if ($data == 'Jolly Spaghetti') {
    //                     $price = 50.00;
    //                     $total += 50.00;

    //                 } else if ($data == 'Yum Burger') {
    //                     $price = 29.00;
    //                     $total += 29.00;
    //                 } else if ($data == 'Jolly Twirls') {
    //                     $price = 25.00;
    //                     $total += 25.00;
    //                 } else if ($data == 'Big Champ') {
    //                     $price = 120.00;
    //                     $total += 120.00;
    //                 }

    //                 echo $data . $_POST["txtQty"][$i] . '<br>';
    //                 echo $price . '<br>';

    //             }

    //         }

    //     }

    //     echo $total;
    // }

    // public function getInvoice()
    // {
    //     //  A4 width: 219mm
    //     // default margin: 10mm each sidebar
    //     // wreitable horizontal:   219-(10*2)=189mm

    //     $pdf = new FPDF('p', 'mm', 'A4');
    //     var_dump($pdf);die;

    //     $pdf->AddPage();

    //     // set font to arial , bold, 14pt

    //     $pdf->SetFont('Arial', '8', 14);

    //     // Cell(width, height, text, border, end line, [align])

    //     $pdf->Cell(130, 5, '', 1, 0);
    //     $pdf->Cell(59, 5, '', 1, 1); //end of line

    //     var_dump($pdf->Output());die;

    // }
}
