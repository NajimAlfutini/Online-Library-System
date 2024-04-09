<?php 
// connect to database
$host="127.0.0.1";
$user="root";
$password="";
$database="project_library_db";
$connect= mysqli_connect($host, $user, $password, $database);
if(mysqli_connect_errno()){
    die("cannot connect to database field:".mysqli_connect_error());
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="style/style_newpass.css">

</head>

<body>

    <?php
        require("registration/connection.php");
        session_start();

//this part will not execute unless the user click on submit button 
if(isset($_POST['change']))
{
// check if there a empty file in the form 
if(!empty($_POST['current']) &&
   !empty($_POST['new']) &&
   !empty($_POST['new_con']))
{
    $current = $_POST['current'];
    $current_md5 = md5($current);   // encrypt the current password to compare it with the passwords in the database
    $new = $_POST['new'];
    $new_md5 = md5($new);           // if pass all the validations. insert to the database the new password after encrypting it
    $new_con = $_POST['new_con'];

    $id = $_SESSION['user']['userid'];  // id for the user from the SESSION

     // validation 1: check the current password for the user if it's right 
    $check1= $db->query("select * from librarian where password='$current_md5' and id ='$id'");
    $check1 = $check1->fetchAll();

    if(count($check1) > 0){
        // validation 2: check if the new password and the confirmed the new password is a match
        if($new == $new_con){
        // if pass all the validations.. update the password for the user
        $query = "update librarian set password='$new_md5' where id='$id' and password='$current_md5'";
        $result = mysqli_query($connect, $query);
    
        if($result){
            echo "<div id=blue><b>Password Updated Successfully</b></div>";
        }
    }else{
        echo "<div id=red><b>The new password are not match</b></div>";
    }
    
    }
    else{
        echo "<h2>The Current Password is wrong</h2>";
    }
}
else{
    echo "<h2>Please fill all fields</h2>";
}
}
    
?>
    <center>
        <h1>Change Password </h1>
        <!-- this form will accept the current and new password -->
        <form action="" method="POST">
            <h3>Enter The Current password: </h3>
            <input type="text" name="current" placeholder="Enter current password"><br>
            <input type="text" name="new" placeholder="Enter new password"><br>
            <input type="text" name="new_con" placeholder="Confirm new password"><br>
            <button><a class="a" href="index.librarian.php">Back</a></button>
            <input class="a" type="submit" name="change" value="Submit">
        </form>

    </center>

</body>