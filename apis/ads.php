<?php
header('Content-type: application/json');
error_reporting(~E_NOTICE);
include_once "helper.php";
$method = $_SERVER['REQUEST_METHOD'];

$data = json_decode(file_get_contents("php://input"), true);

$id = $_GET['id'];	
$user_id = get_token_from_id()['user_id']?get_token_from_id()['user_id']:'';	
// die(json_encode($data));
$p_id = $data['p_id'];
$ad_status = $data['ad_status'];
$ad_type = $data['ad_type'];
$name = $data['name'];
switch ($method) {
	case 'GET':
		if(isset($_GET['id'])){
			$ads = make_query('select * from ad where id=:id', [':id'=>$_GET['id']]);
			$msg['ad'] = $ads->fetch(PDO::FETCH_ASSOC);
		}else{
			$my_adds = [];
			$ads = make_query('select * from ad');
			foreach($ads->fetchAll(PDO::FETCH_ASSOC) as $ad){
				$y = make_query("select * from ad_img where ad_id=:f",[':f'=>$ad['id']]);
				$i = [];
				foreach($y->fetchAll(PDO::FETCH_ASSOC) as $yi){
					array_push($i, $yi);
				}
				$p['ad_status']=$ad["ad_status"];
				$p['ad_type']=$ad["ad_type"];
				$p['added_on']=$ad["added_on"];
				$p['id']=$ad["id"];
				$p['name']=$ad["name"];
				$p['p_id']=$ad["p_id"];
				$p['user_id']=$ad["user_id"];
				$p['pics'] = $i;
				array_push($my_adds, $p);
			}
			$msg["ads"] = $my_adds;
		}
		break;
	case "POST":
		missing_fields([$user_id, $ad_status,$p_id]);
		$q = "insert into ad set user_id=:user_id,ad_type=:ty, ad_status=:ad_status,name=:n,p_id=:p_id";
		if(make_query($q,[":user_id"=>$user_id,':n'=>$name,':ty'=>$ad_type,":ad_status"=>$ad_status,":p_id"=>$p_id])){
			$msg["status"] = 0;
			$msg["message"] = "Ad ".SUCCESS;
		}else{
			$msg["status"] = 0;
			$msg["message"] = FAIL;
		}
		break;
	case "PUT":
		// if()
		missing_fields([$user_id, $ad_status,$p_id]);
		$q = "update ad set  ad_status=:ad_status,p_id=:p_id,name=:n, ad_type=:ty where ad_id=:ad_id";
		if(make_query($q,[":ad_id"=>$id,':n'=>$name,":ad_status"=>$ad_status,':ty'=>$ad_type,":p_id"=>$p_id])){
			$msg["status"] = 1;
			$msg["message"] = "Ad ".UPDATE;
		}else{
			$msg["status"] = 0;
			$msg["message"] = FAIL;
		}
		break;
	case "DELETE":
		// me_or_admin();
		if(me_or_admin()){
			//delete images
			$tr = make_query("select * from ad_img where ad_id=:c",[':c'=>$id]);
			foreach($tr->fetchAll() as $d){
				unlink("..{$d['uri']}");
			}
			make_query("delete from ad_img where ad_id=:c",[':c'=>$id]);
			$q = "delete from ad where id=:ad_id";
			make_query($q, [':ad_id'=>$id]);
			$msg['status'] = 1;
			$msg['message'] = 'Ad '.DELETE;
		}
		
		break;
	default:
		// code...
		break;
}

echo json_encode($msg);