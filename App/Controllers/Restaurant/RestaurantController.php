<?php

namespace App\Controllers\Restaurant;

use App\Controllers\Restaurant\fpdf\FPDF;
use App\Models\RestaurantModel\RestaurantModel;
use Yee\Managers\Controller\Controller;

class RestaurantController extends Controller
{

    /**
     * @Route('/restaurant')
     * @Name('restaurant.form')
     * @Method('GET')
     */
    public function index()
    {
        $app = $this->getYee();

        $restaurant = new RestaurantModel();
        $data = $restaurant->getData();

        $data = [
            'data' => $data,
        ];

        $app->render('Restaurant/restaurant.twig', $data);
    }

    /**
     * @Route('/restaurant')
     * @Name('restaurant.data')
     * @Method('POST')
     */
    public function restaurantData()
    {

        $app = $this->getYee();

        $table = $app->request->post('table_number');
        $subcategory = $app->request->post('sub_category');
        $quantity = $app->request->post('quantity');

        $restaurant = new RestaurantModel($table, $subcategory, $quantity);
        $b = $restaurant->insertData();

        if ($b) {
            $app->redirect('/restaurant', 200);
            return true;
        } else {
            $app->redirect('/login', 200);
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
        $app = $this->getYee();
        $del = new RestaurantModel();
        $delete = $del->DeleteRow($id);
        if ($delete) {
            $app->redirect('/restaurant', 200);
        }
    }

    /**
     * @Route('/restaurantedit/:id')
     * @Name('restaurant.data')
     * @Method('GET')
     */

    public function Edit($id)
    {
        $app = $this->getYee();
        $restModel = new RestaurantModel();
        $result = $restModel->GetOrderJoin($id);
        $products = $restModel->GetProducts();
        $data = [];
        $data['tables'] = $result[0]['table'];
        //var_dump($tables);die;
        $data['products'] = $result[0]['product_name'];
        //var_dump($products);die;
        $data['orders'] = $result[0]['quantity'];

        $arr = [
            'result' => $result,
            'products' => $products,
        ];
        //var_dump( $arr);die;
        $app->render('edit.twig', $arr);
        //var_dump($editRow);die;

        // if($editRow)
        // {
        //     $app->redirect('/edit',$editRow,200);
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
        $newTable = $app->request->post('table_id');
        $newProductName = $app->request->post('subcategory');
        $newQuantity = $app->request->post('quantity');
        // var_dump($newTable);die;

        $dataRecord = new RestaurantModel();

        $data = $dataRecord->updateRedocrd($id, $newTable, $newProductName, $newQuantity);
        //var_dump($newData);die;

        if ($data) {
            $app->redirect('/restaurant', 200);
        }

    }

    /**
     * @Route('/order')
     * @Name('restaurant.data')
     * @Method('POST')
     */

    public function ShowOrder()
    {
        $app = $this->getYee();
        $subcategory = $app->request->post('cbItem');
        $quantity = $app->request->post('txtQty');

        $order = new RestaurantModel();

        $newOrder = $order->Order($subcategory, $quantity);

    }

    /**
     * @Route('/invoice')
     * @Name('restaurant.invoice')
     * @Method('GET')
     */

    public function printIvoice()
    {
        $app = $this->getYee();
        $pdf = new FPDF('p', 'mm', 'A4');

        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 14);

        $pdf->Cell(130, 5, 'Maria Eood', 1, 0);
        $pdf->Cell(59, 5, 'INVOICE', 1, 1);

        //SET font to arial reqular, 12pt
        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(130, 5, '[Street Address]', 1, 0);
        $pdf->Cell(59, 5, '', 1, 1); //end of line

        $pdf->Cell(130, 5, '[City, Country, ZIP]', 1, 0);
        $pdf->Cell(25, 5, 'Date', 1, 0);
        $pdf->Cell(34, 5, '[dd/mm/yyyy]', 1, 1); //end of line

        $pdf->Cell(130, 5, 'Phone [+123456789]', 1, 0);
        $pdf->Cell(25, 5, 'Invoice #', 1, 0);
        $pdf->Cell(34, 5, '[12345667', 1, 1); //end of line

        $pdf->Cell(130, 5, 'Fax [+123456789]', 1, 0);
        $pdf->Cell(25, 5, 'Customer ID', 1, 0);
        $pdf->Cell(34, 5, '[12345667', 1, 1); //end of line

        $pdf->Output();
        if ($pdf) {
            $app->render('invoice.twig', $pdf->Output());
        }
    }
}
