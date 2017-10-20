<?php


/**
 * Generated with RoutingCacheManager
 *
 * on 2017-10-08 03:42:13
 */

$app = Yee\Yee::getInstance();

/* File: C:\xampp\htdocs\kinguin\App\Controllers/Home/HomeController.php*/

/* File: C:\xampp\htdocs\kinguin\App\Controllers/InternController.php*/
$app->map("/", "\\App\\Controllers\\InternController::___index")->via("GET")->name("intern.index");
$app->map("/test", "\\App\\Controllers\\InternController::___testRoute")->via("GET")->name("intern.testroute");
$app->map("/layout", "\\App\\Controllers\\InternController::___layout")->via("GET")->name("");
$app->map("/login", "\\App\\Controllers\\InternController::___login")->via("GET")->name("");
$app->map("/welcome", "\\App\\Controllers\\InternController::___welcome")->via("GET")->name("");
$app->map("/dash", "\\App\\Controllers\\InternController::___dash")->via("GET")->name("");
$app->map("/edit", "\\App\\Controllers\\InternController::___edit")->via("GET")->name("");
$app->map("/order", "\\App\\Controllers\\InternController::___order")->via("GET")->name("");
$app->map("/table", "\\App\\Controllers\\InternController::___menu")->via("GET")->name("");

/* File: C:\xampp\htdocs\kinguin\App\Controllers/LoginController.php*/
$app->map("/login", "\\App\\Controllers\\LoginController::___index")->via("GET")->name("login.form");
$app->map("/login", "\\App\\Controllers\\LoginController::___loginPost")->via("POST")->name("login.data");

/* File: C:\xampp\htdocs\kinguin\App\Controllers/RegisterController.php*/
$app->map("/register", "\\App\\Controllers\\RegisterController::___index")->via("GET")->name("register.form");
$app->map("/register", "\\App\\Controllers\\RegisterController::___registerPost")->via("POST")->name("register.form");

/* File: C:\xampp\htdocs\kinguin\App\Controllers/Reservation/ReservationController.php*/
$app->map("/reservation(/:month)(/:year)", "\\App\\Controllers\\Reservation\\ReservationController::___reservation")->via("GET")->name("reservation.schedule");
$app->map("/reservation(/:month)(/:year)", "\\App\\Controllers\\Reservation\\ReservationController::___insertEv")->via("POST")->name("reservation.event");
$app->map("/facility/room/create", "\\App\\Controllers\\Reservation\\ReservationController::___roomCreate")->via("POST")->name("reservation.room");
$app->map("/reservationedit/:id", "\\App\\Controllers\\Reservation\\ReservationController::___editRoom")->via("GET")->name("reservation.room");
$app->map("/updateroom/:id", "\\App\\Controllers\\Reservation\\ReservationController::___updateRoom")->via("POST")->name("update.room");

/* File: C:\xampp\htdocs\kinguin\App\Controllers/Restaurant/RestaurantController.php*/
$app->map("/restaurant", "\\App\\Controllers\\Restaurant\\RestaurantController::___index")->via("GET")->name("restaurant.form");
$app->map("/restaurant", "\\App\\Controllers\\Restaurant\\RestaurantController::___restaurantData")->via("POST")->name("restaurant.data");
$app->map("/restaurantdel/:id", "\\App\\Controllers\\Restaurant\\RestaurantController::___Delete")->via("GET")->name("restaurant.data");
$app->map("/restaurantedit/:id", "\\App\\Controllers\\Restaurant\\RestaurantController::___Edit")->via("GET")->name("restaurant.data");
$app->map("/update/:id", "\\App\\Controllers\\Restaurant\\RestaurantController::___updateData")->via("POST")->name("restaurant.data");
$app->map("/order", "\\App\\Controllers\\Restaurant\\RestaurantController::___ShowOrder")->via("POST")->name("restaurant.data");
$app->map("/invoice", "\\App\\Controllers\\Restaurant\\RestaurantController::___printIvoice")->via("GET")->name("restaurant.invoice");

/* File: C:\xampp\htdocs\kinguin\App\Controllers/Table/TableController.php*/
$app->map("/tables", "\\App\\Controllers\\Table\\TableController::___showCategory")->via("GET")->name("table.data");

/* File: C:\xampp\htdocs\kinguin\App\Controllers/Tickets/TicketsController.php*/

