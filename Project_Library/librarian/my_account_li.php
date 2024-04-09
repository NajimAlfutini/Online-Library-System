<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    html,
    body {
        background: #6665ee;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        position: 0px 0px;

    }

    .container .form {
        background: #fff;
        padding: 30px 35px;
        border-radius: 5px;
        margin: 15px 300px 15px 300px;
        box-shadow: 0 5px 10px 0 rgba(64, 76, 186, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    * {
        font-family: sans-serif;
        /* Change your font family */
    }

    .content-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        min-width: 400px;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .content-table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    .content-table th,
    .content-table td {
        padding: 12px 15px;
    }

    .content-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .content-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .content-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    .content-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">

                <?php
    require("../registration/connection.php");

    echo "<center>";
    echo "<h2>My Account Detailes: </h2>";
    
    session_start();
    $id = $_SESSION['user']['userid'];

    $table = $db->query("select * from librarian where id=$id");

    echo "<table border=1 class='content-table'";

    foreach ($table as $st) {
    echo "<tr><th>ID</th>";
    echo "<td> $st[id] </td>";
    echo "</tr>";

    echo "<tr><th>Username</th>";
    echo "<td> $st[username] </td>";
    echo "</tr>";

    echo "<tr><th>Password</th>";
    echo "<td><a href=../change_pass_li.php>Change</a> </td>";
    echo "</tr>";

}
   echo "</table>";
   echo "</center>";

   
?>

                <a href="../index.librarian.php">Back</a>

            </div>
        </div>
    </div>

</body>

</html>