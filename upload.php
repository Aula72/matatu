<?php
    include_once "apis/helper.php";
    $user_id = get_id_from_token($_COOKIE['user_key']);
    $type = isset($_GET['type'])?$_GET['type']:'';
    $currentDirectory = getcwd();
    $uploadDirectory = "/uploads/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png', 'mp4','mp3','mkv','mov','m4a' ]; // These will be the only file extensions allowed 

    $fileName = $_FILES['the_file']['name'];
    $fileSize = $_FILES['the_file']['size'];
    $fileTmpName  = $_FILES['the_file']['tmp_name'];
    $fileType = $_FILES['the_file']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    // die(json_encode(['name'=>$fileName, 'size'=>$fileSize, 'type'=>$fileType, 'extension'=>$fileExtension, "user_id"=>$user_id]));
    $normalText = $fileName;
    $fileName = md5($fileName.rand(1000,9999)).'.'.$fileExtension;

    if($type=='user_video'){
      // $user_id = 1;
      $video_name = $normalText;
      $video_url = "/uploads/user-videos/$fileName";
      die(json_encode(['name'=>$fileName, 'size'=>$fileSize, 'type'=>$fileType, 'extension'=>$fileExtension, "user_id"=>$user_id,"name"=>$video_name, "url"=>$video_url]));
      make_query("insert into videos set user_id=:user_id, video_name=:v, video_url=:url",[':user_id'=>$user_id, ':v'=>$video_name, ":url"=>$video_url]);
      $uploadDirectory .= 'user-videos/';
    }else if($type=='user_audio'){
      $uploadDirectory .= 'user-audios/';
    }else if($type=='ad_photo'){
      make_query("insert into ad_img set ad_id=:id, uri=:uri",[':id'=>$id, 'uri'=>$fileName]);
      $uploadDirectory .= 'ad-photos/';
    }else{
      $uploadDirectory .= 'avatars/';
    }

    
    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
    // $uploadPath = $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
      }

      if ($fileSize > 400000000) {
        $errors[] = "File exceeds maximum size (400MB)";
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
          $msg['status'] =1;
          $msg['message'] ="The file " . basename($fileName) . " has been uploaded";
        } else {
          $msg['message']= "An error occurred. Please contact the administrator.";
          $msg['status'] =0;
        }
      } else {
        foreach ($errors as $error) {
          $msg['message']= $error . "These are the errors" . "\n";
          $msg['status'] =0;
        }
      }

    }

    if($msg['status']){
      header("location: upload.php?type=$type");
    }
?>