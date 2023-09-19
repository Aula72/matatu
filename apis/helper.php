<?php

include_once "../connections.php";


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