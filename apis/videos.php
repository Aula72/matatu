<?php
header('Content-type: application/json');

error_reporting(~E_NOTICE);
include_once "helper.php";
$method = $_SERVER['REQUEST_METHOD'];

$user_id = get_token_from_id()['user_id']?get_token_from_id()['user_id']:'';
switch ($method) {
	case 'GET':
		if(isset($_GET['id'])){

		}else{
			if(isset($user_id)){
				$vid = [];
			// $user_id = get_token_from_id()['user_id'];
				$v = make_query("select * from videos where user_id=:id",[':id'=>$user_id]);
				foreach($v->fetchAll(PDO::FETCH_ASSOC) as $video){
					array_push($vid, $video);
				}
				$msg['videos'] = $vid;
			}else{
				$v = make_query("select * from videos");
				foreach($v->fetchAll(PDO::FETCH_ASSOC) as $video){
					array_push($vid, $video);
				}
				$msg['videos'] = $vid;
			}
			
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