<?php
header('Content-type: application/json');
error_reporting(~E_NOTICE);
include_once "helper.php";
$method = $_SERVER['REQUEST_METHOD'];

$data = json_decode(file_get_contents("php://input"));

$id = $_GET['id'];	
$user_id  = get_token_from_id()['user_id'];	
$p_id = $data['p_id'];
$ad_status = $data['ad_status'];
$ad_type = $data['ad_type'];
switch ($method) {
	case 'GET':
		if(isset($_GET['id'])){
			$ads = make_query('select * from ad where id=:id', [':id'=>$_GET['id']]);
			$msg['ad'] = $ads->fetch(PDO::FETCH_ASSOC);
		}else{
			$my_adds = [];
			$ads = make_query('select * from ad');
			foreach($ads->fetchAll(PDO::FETCH_ASSOC) as $ad){
				array_push($my_adds, $ad);
			}
			$msg["ads"] = $my_adds;
		}
		break;
	case "POST":
		missing_fields([$user_id, $ad_status,$p_id]);
		$q = "insert into ad set user_id=:user_id,ad_type=:ty, ad_status=:ad_status,p_id=:p_id";
		if(make_query([":user_id"=>$user_id,':ty'=>$ad_type,":ad_status"=>$ad_status,":p_id"=>$p_id])){
			$msg["status"] = 0;
			$msg["message"] = "Ad added successfully...";
		}else{
			$msg["status"] = 0;
			$msg["message"] = "Ad was not created...";
		}
		break;
	case "PUT":
		if()
		missing_fields([$user_id, $ad_status,$p_id]);
		$q = "update ad set  ad_status=:ad_status,p_id=:p_id, ad_type=:ty where ad_id=:ad_id";
		if(make_query($q,[":ad_id"=>$id,":ad_status"=>$ad_status,':ty'=>$ad_type,":p_id"=>$p_id])){
			$msg["status"] = 0;
			$msg["message"] = "Ad ".SUCCESS;
		}else{
			$msg["status"] = 0;
			$msg["message"] = FAIL;
		}
		break;
	case "DELETE":
		$q = "delete from ad where id=:ad_id";
		make_query($q, [':ad_id'=>$id]);
		$msg['status'] = 1;
		$msg['message'] = 'Ad '.DELETE;
		break;
	default:
		// code...
		break;
}

echo json_encode($msg);