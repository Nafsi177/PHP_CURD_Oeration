<?php
$db = mysqli_connect("localhost","root","","phpcurd_db");
if(!$db){
    die('error in db' . mysqli_error($db));
    
}
$id = $_GET['id'];
$qry = "delete from user where user_id = $id";
if(mysqli_query($db, $qry)){
    header('location: index.php');
    
}
else{
    echo mysqli_error($db);
}

?>
