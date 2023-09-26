<script type="text/javascript" src="/assets/js/jquery.multiple-upload.js"></script>

<?php if($_COOKIE['user_type']==1){
    include_once "_admin.php";
}else{
    include_once "_driver.php";
}
?>
<script type="text/javascript" src="/assets/js/main.js?version=<?php echo md5(rand(100, 9999));?>"></script>