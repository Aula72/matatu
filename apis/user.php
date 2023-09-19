<?php
header('Content-type: application/json');
error_reporting(~E_NOTICE);
include_once "helper.php";
$method = $_SERVER['REQUEST_METHOD'];
// get_token_from_id();
switch ($method) {
	case 'POST':
		$data = json_decode(file_get_contents("php://input"), true);
		// die(json_encode($data));
		$username = $data['username'];
		$user_type = $data['user_type'];
		$email = $data['email'];
		$fname = $data['fname'];
		$lname = $data['lname'];
		$user_code = $data['user_code'];
		$phone = $data['phone'];
		$pwd = password_hash($data['pwd'],PASSWORD_DEFAULT);
		missing_fields([$pwd, $phone, $username, $fname, $lname, $user_type, $user_code]);
		if(isset($_GET['register'])){
			if(!user_exists($username)){
				missing_fields([$pwd, $phone, $username, $fname, $lname, $user_type, $user_code]);
				 $q = "insert into user set username=:username, user_type=:user_type, email=:email,fname=:fname, lname=:lname, user_code=:user_code,phone=:phone, pwd=:pwd";
				$p = [
					":username"=>$username,
					":user_type"=>$user_type,
					":email"=>$email,
					":fname"=>$fname,
					":lname"=>$lname,
					":user_code"=>$user_code,
					":pwd"=>$pwd,
					":phone"=>$phone
				];
				// $query = "insert into user set username=$username, user_type=$user_type, email=$email, phone=$phone, fname=$fname, lname=$lname, user_code=$user_code, pwd=$pwd";
				make_query($q, $p);
				$msg["status"] = 1;
				// $msg['token'] = create_token();
				$msg["message"] = "User registered successfully";
			}else{
				$msg["status"] = 0;
				$msg["message"] = "User already exists";
			}
			
		}else if(isset($_GET['login'])){
			if(user_exists($username)){
				$user = make_query("select * from user where username=:usr or phone=:usr or email=:usr",[':usr'=>$username]);
				$user = $user->fetch(PDO::FETCH_ASSOC);
				$msg['user'] = $user;
				if(password_verify($pwd,$user['pwd'])){
					$msg["status"] = 1;
					$msg["message"] = "Login was successful...";
				}else{
					$msg["status"] = 0;
					$msg["message"] = "Wrong credentials try again...";
				}
			}else{
				$msg["status"] = 0;
				$msg["message"] = "User does not exist...";
			}
		}else{
			$msg["status"] = 1;
			$msg["message"] = "User logged out successfully...";
		}
		break;
	case "GET":
		$users = make_query("select * from user");
		$u = [];
		foreach($users->fetchAll(PDO::FETCH_ASSOC) as $us){
			array_push($u, $us);
		}
		$msg['users'] = $u;
		break;
	default:
		// delete_token($_SERVER['X_AUTH']);

		$msg["message"]="Method not allowed"; 
		$msg["status"]=0;
		$msg['session'] = $_SERVER;
		break;
}

echo json_encode($msg);