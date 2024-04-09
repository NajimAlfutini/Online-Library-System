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
    <title>Delete Book</title>

    <style>
    body {
        background-color: #6665ee;
    }

    input {
        width: 30%;
        height: 5%;
        border: 1px;
        border-radius: 05px;
        padding: 8px 15px 8px 15px;
        margin: 10px 0px 15px 0px;
        box-shadow: 1px 1px 2px 1px;
    }

    .a {
        width: 10%;
        height: 10%;
    }

    button {
        width: 10%;
        height: 10%;
        border: 1px;
        border-radius: 05px;
        padding: 8px 15px 8px 15px;
        margin: 10px 0px 15px 0px;
        box-shadow: 1px 1px 2px 1px;
    }

    * {
        font-family: sans-serif;
    }

    #blue {
        width: 50%;
        height: 10%;
        border: 1px;
        border-radius: 05px;
        padding: 8px 15px 8px 15px;
        margin: 10px 0px 15px 0px;
        box-shadow: 1px 1px 2px 1px;
        background-color: blue;
        font-size: 20px;
    }

    #red {
        width: 50%;
        height: 10%;
        border: 1px;
        border-radius: 05px;
        padding: 8px 15px 8px 15px;
        margin: 10px 0px 15px 0px;
        box-shadow: 1px 1px 2px 1px;
        background-color: red;
        font-size: 20px;
    }
    </style>
</head>

<body>

    <?php

require("../registration/connection.php");

//this part will not execute unless the user click on delete button 
if(isset($_POST['delete']))
{
//check if the input empty
if(!empty($_POST['id'])){

    $id = $_POST['id'];

    // 1- validation: check if the book is exist in database
    $check1 = $db->query("select * from book where id='$id'");
    $check1 = $check1->fetchAll();

    // 1- validation: check if the book are borrow by a member, if yes he cannot delete it
    $check2 = $db->query("select * from borrow where bookID='$id'");
    $check2 = $check2->fetchAll();
    
    if(count($check2) > 0){
        echo "<div id='red'>";
        echo "<b>This book cannot be deleted because it was borrowed</b>";
        echo "</div>";
    }
    if(count($check1) > 0){
        // if pass all the validations.. delete the book from the book table
        $query = "DELETE FROM `book` WHERE id='$id'";
        $result = mysqli_query($connect, $query);
    
        if($result){
            echo "<div id='blue'>";
            echo "<b>Book Deleted Successfully</b>";
            echo "</div>";
        }
    }else{
        echo "<div id='red'>";
        echo "<b>There No Book With This ID</b>";
        echo "</div>";
    }
}
else{
    echo "<div id='red'>";
    echo "<b>No Input.. Please Inter Book ID</b>";
    echo "</div>";
}
}
    
?>
    <center>
        <h1>Delete Book: </h1>
        <form action="" method="POST">
            <h3>Enter The Book ID you want to Delete:</h3>
            <input type="number" name="id" placeholder="Enter book id"><br>
            <button><a class="a" href="display_books.php">Back</a></button>
            <input class="a" type="submit" name="delete" value="DELETE BOOK">
        </form>
    </center>

</body>