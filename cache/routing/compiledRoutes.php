<?php


/**
 * Generated with RoutingCacheManager
 *
 * on 2017-06-15 01:12:37
 */

$app = Yee\Yee::getInstance();

/* File: C:\xampp\htdocs\TicketSystem\App\Controllers/InternController.php*/
$app->map("/", "\\App\\Controllers\\InternController::___index")->via("GET")->name("intern.index");
$app->map("/test", "\\App\\Controllers\\InternController::___testRoute")->via("GET")->name("intern.testroute");
$app->map("/layout", "\\App\\Controllers\\InternController::___layout")->via("GET")->name("");
$app->map("/login", "\\App\\Controllers\\InternController::___login")->via("GET")->name("");
$app->map("/welcome", "\\App\\Controllers\\InternController::___welcome")->via("GET")->name("");

