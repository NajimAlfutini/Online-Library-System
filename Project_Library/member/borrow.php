<?php
session_start();
 require("../registration/connection.php");
 extract($_POST);

 $id = $_SESSION['user']['userid'];
 $username = $_SESSION['user']['username'];

echo "<center>";
echo "<div class='container'>";
echo "<div class='row'>";  
echo "<div class='col-md-4 offset-md-4 form'>";

$ch =$db->query("select * from book where id='$book_id'");

$check = $db->query("SELECT * FROM `borrow` WHERE bookID='$book_id' and userID='$id' ");
$check = $check->fetchAll();

// check if the user is already borrowed this book or not
if(count($check) > 0){
    echo "<div id=red> 
    <b>You Already Borrowed This Book</b>
    </div>";
}
else{
 foreach($ch as $rs){
    // check if there a copy for this book
    if($rs[6]>0){
    $db->exec("update book set bookCopies = bookCopies-1 where id=$book_id");
    $sql = "INSERT INTO `borrow`(`userID`, `username`, `bookID`, `bookTitle`, `returnDate`)
            VALUES ('$id','$username','$book_id','$book_title','$return_data')";
    $result = $db->query($sql);
    
    echo "<div id=blue> 
    <b>You Borrow The Book Successfully</b>
    </div>";
    }
    else{
    echo "<div id=red>
    <b>Sorry,,, There No Copey For This Book</b>
    </div>";
    }
 }
}
echo "<br><button type='button'><a href='all_book_me.php'>Back to List</a></button>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</center>";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Books Information</title>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    html,
    body {
        background: #6665ee;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        position: 600px 600px;

    }

    .container .form {
        background: #fff;
        padding: 30px 35px;
        border-radius: 5px;
        margin: 50px 10px 10px 10px;
        box-shadow: 0 4px 8px 0 rgba(64, 76, 186, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    * {
        font-family: sans-serif;
        /* Change your font family */
    }

    button {
        width: 44%;
        height: 7%;
        border: 1px;
        border-radius: 05px;
        padding: 8px 15px 8px 15px;
        box-shadow: 1px 1px 2px 1px;
        font-size: 26px;
    }

    a {
        text-decoration: none;
    }

    #blue {
        width: 50%;
        height: 10%;
        border: 1px;
        border-radius: 25px;
        padding: 8px 15px 8px 15px;
        margin: 10px 0px 15px 0px;
        box-shadow: 1px 1px 2px 1px;
        background-color: blue;
        font-size: 28px;
    }

    #red {
        width: 50%;
        height: 10%;
        border: 1px;
        border-radius: 25px;
        padding: 8px 15px 8px 15px;
        margin: 10px 0px 15px 0px;
        box-shadow: 1px 1px 2px 1px;
        background-color: red;
        font-size: 28px;
    }
    </style>
</head>

<body>


</body>

</html>