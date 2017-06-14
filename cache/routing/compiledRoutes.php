<?php


/**
 * Generated with RoutingCacheManager
 *
 * on 2017-06-14 07:05:37
 */

$app = Yee\Yee::getInstance();

/* File: D:\wamp64\www\intern\App\Controllers/InternController.php*/
$app->map("/", "\\App\\Controllers\\InternController::___index")->via("GET")->name("intern.index");
$app->map("/test", "\\App\\Controllers\\InternController::___testRoute")->via("GET")->name("intern.testroute");

