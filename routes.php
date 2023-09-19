<?php
error_reporting(~E_NOTICE);
$uri = $_SERVER['REQUEST_URI'];
$query_string = $_SERVER['QUERY_STRING'];

echo json_encode($_SERVER);
switch($uri){
	case "/":
		require_once "views/index.php";
		break;
	case "/login":
		require_once "views/login.php";
		break;
	case "/signup":
		require_once "views/signup.php";
		break;
	default:
		require_once "views/404.php";
		break;
}