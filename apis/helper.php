<?php
// error_reporting(~E_WARNING, ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
include_once file_exists("../connections.php")?"../connections.php":"connections.php";


function make_query($q, $p=[]){
    global $conn;
	try{
        $t = $conn->prepare($q);
        $t->execute($p);
    }catch(\PDOException $e){
        $err["message"] = $e->getMessage();
        $err["file"] = $e->getFile();
        $err["line"] = $e->getLine();
        $err["code"] = $e->getCode();
        write_2_file("../error.txt", json_encode($err));
        die(json_encode(['error'=>$err]));
    }
    
    return $t;
}
// function make_query($query){}
function write_2_file($file, $txt){
    $file ="../logs/".$file;
    $myfile = fopen($file, "a") or die("Unable to open file!");
    
    fwrite($myfile, date('d-m-Y H:i:s').">>>".$txt."\n");
    fclose($myfile);
}
function create_token($user){
    $token = md5($user.str_shuffle( date('m/d/Y h:i:s a', time())));
    $r = make_query("select * from user_token where user_id=:id",$user);
    // if($r->rowCount()>0){
    make_query("delete from user_token where user_id=:ui",[':ui'=>$user]);
    // }
    make_query("insert into user_token set user_id=:u, token=:i",[':u'=>$user,':i'=>$token]);

    return $token;
}

function check_token($token){

}

function check_user($user){

}

function delete_token(){
	$t = $_SERVER['HTTP_AUTH'];
    make_query("delete from user_token where token=:t",[':t'=>$t]);
}

function me_or_admin(){
    $r = get_token_from_id();
    
    $check = make_query("select * from user where id=:id",[':id'=>$r]);
    if($check->rowCount()>0){
        // die(json_encode($check->fetch(PDO::FETCH_ASSOC)));
        $v = $check->fetch(PDO::FETCH_ASSOC);
        // die(json_encode(['r'=>$r, 'user_id'=>$v['id'],'t'=>$v['user_type'], 'user_'=>intval($v['id'])==intval($r)]));
        if(intval($v['id'])===intval($r) || $v['user_type']==='1'){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function user_exists($user){
	$x = make_query("select * from user where username=:u or phone=:u or email=:u", [':u'=>$user]);
	if($x->rowCount()>0){
		$f = true;
	}else{
		$f = false;
	}
	return $f;
}

function is_logged(){}

function missing_fields($r=[]){
    foreach($r as $p){
        // echo $p;
        if($p==='' || $p===null){
            die(json_encode(['status'=>0, 'message'=>'Some fields are missing!']));
        }
    }
}

function ad_images($id){
    $img = make_query("select * from ad_img where ad_id=:id",[":id"=>$id]);
    $imgs = [];
    foreach($img->fetchAll(PDO::FETCH_ASSOC) as $t){
        array_push($imgs, $t);
    }
    return $imgs;
}

function get_token_from_id(){

    if(isset($_SERVER['HTTP_AUTH'])){
        $t = $_SERVER['HTTP_AUTH'];
        $f = make_query("select * from user_token where token=:t", [':t'=>$t]);
        if($f->rowCount()>0){
            $user_id = $f->fetch(PDO::FETCH_ASSOC);
            return $user_id['user_id'];
        }else{
            die(json_encode(["status"=>0,"message"=>"Authorization token is expired!"]));
        }
    }else{
        die(json_encode(["status"=>0,"message"=>"Authorization error!"]));
    }
}

function get_id_from_token($token){
    $f = make_query("select * from user_token where token=:t", [':t'=>$token]);
    if($f->rowCount()>0){
        $user_id = $f->fetch(PDO::FETCH_ASSOC);
        return $user_id['user_id'];
    }else{
        die(json_encode(["status"=>0,"message"=>"Authorization token is expired!"]));
    }
}