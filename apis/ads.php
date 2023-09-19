<?php
header('Content-type: application/json');
error_reporting(~E_NOTICE);
include_once "helper.php";
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		if(isset($_GET['id'])){
			$ads = make_query('select * from ads where id=:id', [':id'=>$_GET['id']]);
			$msg['ad'] = $ads->fetch(PDO::FETCH_ASSOC);
		}else{
			$my_adds = [];
			$ads = make_query('select * from ads');
			foreach($ads->fetchAll(PDO::FETCH_ASSOC) as $ad){
				array_push($my_adds, $ad);
			}
			$msg["ads"] = $my_adds;
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