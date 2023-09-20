<?php
header('Content-type: application/json');

error_reporting(~E_NOTICE);
include_once "helper.php";
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		if(isset($_GET['id'])){

		}else{

		}
		break;
	case "POST":
		break;
	case "PUT":
		break;
	case "DELETE":
		break;
	default:
		// code...
		break;
}

echo json_encode($msg);