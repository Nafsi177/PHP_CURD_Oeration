<?php
$db = mysqli_connect("localhost","root","","phpcurd_db");

?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CURD Operation</title>
    </head>
    <body>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label>Name: </label>
            <input type="text" name="name" placeholder="enter your name">
            <br><br>
            <label>Email: </label>
            <input type="email" name="email" placeholder="enter your email">
            <br><br>
            <label>Address: </label>
            <input type="text" name="address" placeholder="enter your address">
            <br><br>
             
            <input type="submit" name="submit" value="submit">
            
        </form>
        <hr>
        <h3> User list  </h3>
        <table style="width: 80%" border="1">
            <tr>
                <th>S#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Operations</th>
            </tr>
            <?php
            $i = 1;
            $qry = "select * from user";
            $run = $db -> query($qry);
            if($run -> num_rows > 0){
                while($row = $run -> fetch_assoc()){
                    $id = $row['user_id'];
                  
            ?>
            
            <tr>
                <td><?php echo $i++; ?> </td>
                <td><?php echo $row['user_name'] ?> </td>
                <td><?php echo $row['user_email'] ?> </td>
                <td><?php echo $row['user_address'] ?> </td>
                <td>
                    <a href="update.php?id=<?php echo $id;?>">Update</a>
                    <a href="delete.php?id=<?php echo $id;?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php 
                }
            }
            ?>
        </table>
        
    </body>
</html>

<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    $qry = "insert into user values(null, '$name','$email','$address')";
    if(mysqli_query($db, $qry)){
        echo '<script>alert("User registration sucessfull")</script>';
        header('location: index.php');
    }
    else{
        echo mysqli_error($db);
    }
}
if(isset($_POST['delete'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    $qry = "DELETE FROM user WHERE user_name='$name' AND user_email='$email' AND user_address='$address'";
    if(mysqli_query($db, $qry)){
        echo '<script>alert("User deleted successfully")</script>';
        header('location: index.php');
    }
    else{
        echo mysqli_error($db);
    }
}


if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    $qry = "UPDATE user SET user_name='$name', user_email='$email', user_address='$address' WHERE user_id=$id";
    if(mysqli_query($db, $qry)){
        echo '<script>alert("User updated successfully")</script>';
        header('location: index.php');
    }
    else{
        echo mysqli_error($db);
    }
}




?>
