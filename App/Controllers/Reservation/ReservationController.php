<?php

namespace App\Controllers\Reservation;

use App\Models\ReservationModel\ReservationModel;
use Yee\Managers\Controller\Controller;

class ReservationController extends Controller
{

    /**
     * @Route('/reservation(/:month)(/:year)')
     * @Name('reservation.schedule')
     * @Method('Get')
     */

    public function reservation($month = null, $year = null)
    {

        // var_dump($month);
        // var_dump($year);die;
        $app = $this->getYee();
        $show = new ReservationModel();
        $date = $show->daysInMonth($month, $year);
        $ev = $show->buildEvent($month, $year);
        $navi = $show->createNavi($month, $year);
        $showAll = $show->show();

        $data = [
            'ev' => $ev,
            'navi' => $navi,
            'dayinmoth' => $date,
            'rooms' => $showAll['rooms'],
            'allDateMonth' => $showAll['allDateInMonth']];

        $app->render('reservations/index.twig', $data);

    }

    /**
     * @Route('/reservation(/:month)(/:year)')
     * @Name('reservation.event')
     * @Method('POST')
     */

    public function insertEv($month, $year)
    {
        // $month = ['month'];
        // $year = ['year'];

        $app = $this->getYee();

        $name = $app->request->post('name');
        $startDate = $app->request->post('start');
        $endDate = $app->request->post('end');
        $id = $app->request->post('id');
        $status = $app->request->post('status');

        $event = new ReservationModel($name, $startDate, $endDate, $id, $status);
        $newEvent = $event->insertEvent();

        if ($newEvent) {
            $app->response->redirect('/reservation/' . $month . '/' . $year, 200);
        } else {
            return false;
        }
    }

    /**
     * @Route('/facility/room/create')
     * @Name('reservation.room')
     * @Method('POST')
     */
    public function roomCreate()
    {
        $app = $this->getYee();
        $room = $app->request->post('room');
        $capacity = $app->request->post('capacity');
        $status = $app->request->post('status');

        $addRoom = new ReservationModel();
        $newRoom = $addRoom->addNewRoom($room, $capacity, $status);
        if ($newRoom) {
            $app->redirect('/reservation', 200);
            return;
        }

        return false;
    }

    /**
     * @Route('/reservationedit/:id')
     * @Name('reservation.room')
     * @Method('GET')
     */

    public function editRoom($id)
    {
        $app = $this->getYee();

        $edit = new ReservationModel();
        $editRoom = $edit->editRoom($id);
        // $data['orders'] = $result[0]['quantity'];

        $editParam = [
            'rooms' => $editRoom,
        ];

        $app->render('reservations/editRoom.twig', $editParam);

    }

    /**
     * @Route('/updateroom/:id')
     * @Name('update.room')
     * @Method('POST')
     */

    public function updateRoom($id)
    {
        $app = $this->getYee();
        $room = $app->request->post('room');
        // var_dump($room);
        $capacity = $app->request->post('capacity');
        // var_dump($capacity);
        $status = $app->request->post('status');

        $update = new ReservationModel();
        $updateRoom = $update->updateRooms($id, $room, $capacity, $status);

        if ($updateRoom) {
            $app->redirect('/reservation', 200);
        } else {
            echo 'hui';
        }
    }
}
