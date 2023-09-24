<?php
header('Content-type: application/json');

error_reporting(~E_NOTICE);
include_once "helper.php";
$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:'';
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
		// me_or_admin();
		// die(json_encode(['id'=>$id, 'k'=>me_or_admin()]));
		if(me_or_admin()){
			$tr = make_query("select * from videos where id=:c",[':c'=>$id]);
			$t = $tr->fetch(PDO::FETCH_ASSOC);
			$currentDirectory = getcwd();
			// die($t['video_url']);

			unlink("..{$t['video_url']}");
			make_query("delete from videos where id=:c",[':c'=>$id]);
			$msg['status'] = 1;
			$msg['message'] = 'Ad '.DELETE;
		}

		break;
	default:
		// code...
		break;
}

echo json_encode($msg);