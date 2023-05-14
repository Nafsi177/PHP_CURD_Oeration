<?php
$db = mysqli_connect("localhost","root","","phpcurd_db");
if(!$db){
    die('error in db' . mysqli_error($db));
    
}
else{
    $id = $_GET['id'];
    $qry = "select * from user where user_id = $id";
            $run = $db -> query($qry);
            if($run -> num_rows > 0){
                while($row = $run -> fetch_assoc()){
                    $username = $row['user_name'];
                    $useremail = $row['user_email'];
                    $useraddress = $row['user_address'];
                }
            }
    
}



?>

<!doctype html>
<html>
    <head>
        <title>
            Update User
        </title>
    </head>
    <body>
        <form method="POST">
           
            <label>Name: </label>
            <input type="text" name="name" value="<?php echo $username; ?>" >
            <br><br>
            <label>Email: </label>
            <input type="email" name="email" value="<?php echo $useremail; ?>" >
            <br><br>
            <label>Address: </label>
            <input type="text" name="address" value="<?php echo $useraddress; ?> ">
            <br><br>
             
            <input type="submit" name="update" value="update">
            
        </form>
    </body>
</html>
<?php

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    $qry = "update user set user_name='$name',user_email='$email',user_address='$address' where user_id = $id";
    if(mysqli_query($db, $qry)){
        echo '<script>alert("User registration sucessfull")</script>';
        header('location: index.php');
    }
    else{
        echo mysqli_error($db);
    }
}

?>
