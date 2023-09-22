<?php
header('Content-type: application/json');

error_reporting(~E_NOTICE);
include_once "helper.php";
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		if(isset($_GET['id'])){

		}else{
			
			$vid = [];
			$user_id = get_token_from_id()['user_id'];
			$v = make_query("select * from videos where user_id=:id",[':id'=>$user_id]);
			foreach($v->fetchAll() as $video){
				array_push($vid, $video);
			}
			$msg['videos'] = $vid;
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