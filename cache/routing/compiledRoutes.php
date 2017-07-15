<?php


/**
 * Generated with RoutingCacheManager
 *
 * on 2017-07-14 04:38:50
 */

$app = Yee\Yee::getInstance();

/* File: C:\xampp\htdocs\kinguin\App\Controllers/InternController.php*/
$app->map("/", "\\App\\Controllers\\InternController::___index")->via("GET")->name("intern.index");
$app->map("/test", "\\App\\Controllers\\InternController::___testRoute")->via("GET")->name("intern.testroute");
$app->map("/layout", "\\App\\Controllers\\InternController::___layout")->via("GET")->name("");
$app->map("/login", "\\App\\Controllers\\InternController::___login")->via("GET")->name("");
$app->map("/welcome", "\\App\\Controllers\\InternController::___welcome")->via("GET")->name("");
$app->map("/dash", "\\App\\Controllers\\InternController::___dash")->via("GET")->name("");
$app->map("/edit", "\\App\\Controllers\\InternController::___edit")->via("GET")->name("");

/* File: C:\xampp\htdocs\kinguin\App\Controllers/LoginController.php*/
$app->map("/login", "\\App\\Controllers\\LoginController::___index")->via("GET")->name("login.form");
$app->map("/login", "\\App\\Controllers\\LoginController::___loginPost")->via("POST")->name("login.data");

/* File: C:\xampp\htdocs\kinguin\App\Controllers/RegisterController.php*/
$app->map("/register", "\\App\\Controllers\\RegisterController::___index")->via("GET")->name("register.form");
$app->map("/register", "\\App\\Controllers\\RegisterController::___registerPost")->via("POST")->name("register.data");

/* File: C:\xampp\htdocs\kinguin\App\Controllers/RestaurantController/RestaurantController.php*/
$app->map("/restaurant", "\\App\\Controllers\\RestaurantController\\RestaurantController::___index")->via("GET")->name("restaurant.form");
$app->map("/restaurant", "\\App\\Controllers\\RestaurantController\\RestaurantController::___restaurantData")->via("POST")->name("restaurant.data");
$app->map("/restaurantdel/:id", "\\App\\Controllers\\RestaurantController\\RestaurantController::___Delete")->via("GET")->name("restaurant.data");
$app->map("/restaurantedit/:id", "\\App\\Controllers\\RestaurantController\\RestaurantController::___Edit")->via("GET")->name("restaurant.data");
$app->map("/update/:id", "\\App\\Controllers\\RestaurantController\\RestaurantController::___updateData")->via("POST")->name("restaurant.data");

