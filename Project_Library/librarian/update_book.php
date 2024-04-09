<?php 
// 1-connect to db
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
    <title>Update Book Info</title>

    <style>
    body {
        background-color: #6665ee;
    }

    input {
        width: 40%;
        height: 5%;
        border: 1px;
        border-radius: 05px;
        padding: 8px 15px 8px 15px;
        margin: 10px 0px 15px 0px;
        box-shadow: 1px 1px 2px 1px;
    }

    .a {
        width: 20%;
        height: 10%;
    }

    button {
        width: 20%;
        height: 10%;
        border: 1px;
        border-radius: 05px;
        padding: 8px 15px 8px 15px;
        margin: 10px 0px 15px 0px;
        box-shadow: 1px 1px 2px 1px;
    }

    h2 {
        width: 50%;
        height: 10%;
        border: 1px;
        border-radius: 05px;
        padding: 8px 15px 8px 15px;
        margin: 10px 0px 15px 0px;
        box-shadow: 1px 1px 2px 1px;
        background-color: red;
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

    
if(isset($_POST['update']))
{
    if(empty($_POST['id'])){
        echo "<div id=red>
            <b> No Input... Please Enter Book ID
            </b> <br />
            </div> "; 
    }
    else{
    $id = $_POST['id'];
    $ISBN = $_POST['ISBN'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $yearOfPublication = $_POST['yearOfPublication'];
    $bookCopies = $_POST['bookCopies'];
    $categories = $_POST['categories'];

    require("../registration/connection.php");

    // cheak if the id of the book is exitst in the database
    $check1= $db->query("select * from book where id='$id'");
    $check1 = $check1->fetchAll();

    // cheak if the ISBN of the book is exitst in the database
    $check2= $db->query("select * from book where ISBN='$ISBN'");
    $check2 = $check2->fetchAll();

    // cheak if the book are borrow by member
    $check3= $db->query("select * from borrow where bookID='$id'");
    $check3 = $check3->fetchAll();

    $pass1 = false;
    $pass2 = false;
    $pass3 = false;
    
    if(count($check1) > 0){
        $pass1 = true;
    }
    
    if(count($check2) < 1){
        $pass2 = true;
    }

    if(count($check3) == 0){
        $pass3 = true;
    }

    if(!$pass1){
        echo "<h2>There No Book With This ID</h2>";
    }

    if(!$pass3){
        echo "<h2> The book are borrow by a member you cannot update this book now </h2>";
    }

    if($pass1 && !$pass2){
        echo "<div id=red><b>Data Not Updated</b> <br />
        There Is A book With Same ISBN
        </div> ";    
    }

    if($pass1 && $pass2 && $pass3){

        $query = "update book set ISBN='". $ISBN ."' , title='". $title ."' , author='". $author ."' , publisher='". $publisher ."' , yearOfPublication='". $yearOfPublication ."' , bookCopies='". $bookCopies ."' , categories='". $categories ."'  where id=". $id;
        $result = mysqli_query($connect, $query);
    
        if($result){
            echo "<div id=blue><b>Data Updated Successfully</b></div>";
        }
    }

    
}
}
    
?>
    <center>
        <h1>Update The Book Information: </h1>

        <form action="" method="POST">
            <h3>Enter The Book ID you want to Update:</h3>
            <input type="number" name="id" placeholder="Enter book id"><br>
            <input type="text" name="ISBN" placeholder="Enter book ISBN"><br>
            <input type="text" name="title" placeholder="Enter book title"><br>
            <input type="text" name="author" placeholder="Enter book author"><br>
            <input type="text" name="publisher" placeholder="Enter book publisher"><br>
            <input type="number" name="yearOfPublication" placeholder="Enter year of publication"><br>
            <input type="number" name="bookCopies" placeholder="Enter number of copies"><br>
            <input type="text" name="categories" placeholder="Enter book categories"><br>

            <button><a class="a" href="display_books.php">Back</a></button>
            <input class="a" type="submit" name="update" value="UPDATE DATA">

        </form>

    </center>

</body>

</html>