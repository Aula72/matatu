<?php

include_once "../connections.php";

echo DB_USER;
function make_query($q, $p=[]){
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

}

function check_token($token){

}

function check_user($user){

}

function delete_token(){
	
}

function user_exists($user){
	$x = make_query("select * from user where username=:u or phone=:u or email=:u", [':u'=>$user]);
	if($x->rowCount()>0){
		$f = false;
	}else{
		$f = true;
	}
	return $f;
}

function is_logged(){}

function missing_fields($r=[]){
    foreach($r as $p){
        // echo $p;
        if($p==''){
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