<?php


/**
 * Generated with RoutingCacheManager
 *
 * on 2017-06-21 02:54:57
 */

$app = Yee\Yee::getInstance();

/* File: C:\xampp\htdocs\kinguin\App\Controllers/InternController.php*/
$app->map("/", "\\App\\Controllers\\InternController::___index")->via("GET")->name("intern.index");
$app->map("/test", "\\App\\Controllers\\InternController::___testRoute")->via("GET")->name("intern.testroute");
$app->map("/layout", "\\App\\Controllers\\InternController::___layout")->via("GET")->name("");
$app->map("/login", "\\App\\Controllers\\InternController::___login")->via("GET")->name("");
$app->map("/welcome", "\\App\\Controllers\\InternController::___welcome")->via("GET")->name("");

/* File: C:\xampp\htdocs\kinguin\App\Controllers/LoginController.php*/
$app->map("/login", "\\App\\Controllers\\LoginController::___index")->via("GET")->name("login.form");
$app->map("/login", "\\App\\Controllers\\LoginController::___loginPost")->via("POST")->name("login.data");

/* File: C:\xampp\htdocs\kinguin\App\Controllers/RegisterController.php*/
$app->map("/register", "\\App\\Controllers\\RegisterController::___index")->via("GET")->name("register.form");
$app->map("/register", "\\App\\Controllers\\RegisterController::___registerPost")->via("POST")->name("register.data");

