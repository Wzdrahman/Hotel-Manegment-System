<?php

namespace App\Models\ReservationModel;

class ReservationModel
{
    private $app;
    private $db;
    public $check;
    private $name;
    private $startDate;
    private $endDate;
    private $status;
    private $room;
    private $capacity;

    public function __construct($name = null, $startDate = null, $endDate = null, $id = null, $status = null)
    {
        $this->app = \Yee\Yee::getInstance();
        $this->name = $name;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->id = $id;
        $this->status = $status;
        $this->currentDay = 1;

        $con = $this->db = $this->app->connection['hotel'];

    }

    public function show()
    {

        $app = new \Yee\Yee();

        $year = date("Y", time());
        $month = date("m", time());

        $this->currentYear = $year;

        $this->currentMonth = $month;
        $daysInMonth = $this->daysInMonth = $this->daysInMonth($month, $year);
        $creativeNavi = $this->createNavi($month, $year);

        $data['days'] = $daysInMonth;
        $data['navi'] = $creativeNavi;
        //var_dump($data);
        $data['rooms'] = $this->_getRooms();
        $data['allDateInMonth'] = $this->_allDateInMonth();
        return $data;

        return $weeksInMonth = $this->_weeksInMonth($month, $year);

    }

    public function createNavi($month, $year)
    {

        if (null == ($year)) {
            $year = date("Y", time());
        }

        if (null == ($month)) {
            $month = date("m", time());
        }
        //var_dump($month);
        $nextMonth = $month == 12 ? 1 : intval($month) + 1;

        $nextYear = $month == 12 ? intval($year) + 1 : $year;

        $preMonth = $month == 1 ? 12 : intval($month) - 1;

        $preYear = $month == 1 ? intval($year) - 1 : $year;

        return $navi = ['nextMonth' => $nextMonth,
            'nextYear' => $nextYear,
            'preMonth' => $preMonth,
            'preYear' => $preYear,
            'month' => $month,
            'year' => $year,
        ];

    }

    private function _weeksInMonth($month = null, $year = null)
    {

        if (null == ($year)) {
            $year = date("Y", time());
        }

        if (null == ($month)) {
            $month = date("m", time());
        }

        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month, $year);

        $numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);

        $monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $daysInMonths));

        $monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));

        if ($monthEndingDay < $monthStartDay) {

            $numOfweeks++;

        }

        return $numOfweeks;
    }

    /**
     * calculate number of days in a particular month
     */
    public function daysInMonth($month = null, $year = null)
    {

        if (null == ($year)) {
            $year = date("Y", time());
        }

        if (null == ($month)) {
            $month = date("m", time());
        }

        return date('t', strtotime($year . '-' . $month . '-01'));
    }

    private function _getRooms()
    {

        $result = $this->db->get('rooms');

        return $rooms['rooms'] = $result;
    }

    private function _allDateInMonth()
    {
        $allDate[] = "";
        for ($i = $this->currentDay; $i <= $this->daysInMonth(); $i++) {
            $this->currentDate = date('Y-m-d', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($this->currentDay)));
            $this->currentDay++;
            //
            $allDate[] = $this->currentDate;

        }
        // var_dump($allDate);
        return $allDate;
    }

    public function updateRooms($id, $room, $capacity, $status)
    {

        $updatedRoom = [
            'id' => $id,
            'room' => $room,
            'capacity' => $capacity,
            'status' => $status,
        ];

        $this->db->where('id', $id);
        $this->db->update('rooms', $updatedRoom);

        return true;

    }

    private function _deleteRooms()
    {

    }

    public function currentDate($month, $year)
    {
        $app = new \Yee\Yee();

        $this->currentYear = $year;

        $this->currentMonth = $month;

        return $daysInMonth['currentDay'] = $this->daysInMonth = $this->_daysInMonth($month, $year);
    }

    public function insertEvent()
    {
        $eventData = array(

            "name" => $this->name,
            "start" => $this->startDate,
            "end" => $this->endDate,
            "room_id" => $this->id,
            "status" => $this->status,
        );

        return $this->db->insert('reservation', $eventData);

    }

    public function addNewRoom($room, $capacity, $status)
    {
        $roomData = array(

            "room" => $room,
            "capacity" => $capacity,
            "status" => $status,
        );
// var_dump($this->room);
        // var_dump($this->capacity);
        // var_dump($this->status);die;
        return $this->db->insert('rooms', $roomData);

    }

    public function editRoom($id)
    {
        return $this->db->rawQuery("
            SELECT rooms.id, rooms.room, rooms.capacity, rooms.status
            FROM rooms WHERE rooms.id = '$id' ", $id);
    }

    public function buildEvent($month, $year)
    {
        if (is_null($month)) {
            $month = date('m', time());
        }

        if (is_null($year)) {
            $year = date("Y", time());
        }

        $lastDayOfMonth = date("t", mktime(0, 0, 0, $month, 1, $year));
        $begginingTime = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
        $endingTime = date("Y-m-d", mktime(23, 59, 00, $month, $lastDayOfMonth, $year));

        $event = $this->db->rawQuery("
            SELECT reservation.room_id,reservation.name,reservation.start,reservation.end,reservation.status FROM reservation WHERE reservation.start >= DATE('" . $begginingTime . "') AND  reservation.end <= DATE('" . $endingTime . "')");

        return $event;
    }

}
