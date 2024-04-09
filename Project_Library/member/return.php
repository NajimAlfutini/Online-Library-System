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
        border-radius: 05px;
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
        border-radius: 05px;
        padding: 8px 15px 8px 15px;
        margin: 10px 0px 15px 0px;
        box-shadow: 1px 1px 2px 1px;
        background-color: red;
        font-size: 28px;
    }
    </style>
</head>

<body>
    <?php
require("../registration/connection.php");

session_start();
extract($_GET);

$id = $_SESSION['user']['userid'];
 
echo "<center>";
echo "<div class='container'>";
echo "<div class='row'>";  
echo "<div class='col-md-4 offset-md-4 form'>";

$sql1 = $db->query("update book set bookCopies=bookCopies+1 where id='$book_id' ");
$sql2 = $db->query("DELETE FROM `borrow` WHERE bookID='$book_id' and userID='$id'");

if($sql1){
    if($sql2){
    echo "<div id=blue> 
    <b>You Return The Book Successfully</b>
    </div>";
    }
}
else{
    echo "<div id=red> 
    <b>Error Cannot Return The Book</b>
    </div>";
}

echo "<br><button type='button'><a href='my_book.php'>Back to List</a></button>";

echo "</div>";
echo "</div>";
echo "</div>";
echo "</center>";

?>
</body>

</html>