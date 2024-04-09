<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Members Information</title>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    html,
    body {
        background: #6665ee;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        position: 400px 400px;

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
    echo "<h2>All Member Detailes: </h2>";
    
   $table = $db->query("select * from users ");

   echo "<table border=1 class='content-table'";
   echo "<tr>
   <th>Photo</th>
   <th>ID</th>
   <th>FullName</th>
   <th>Email</th>
   <th>PhoneNumber</th>
   <th>Username</th>
   <th>password</th>
   <th>Address</th>
   </tr>";
   foreach ($table as $st) {
       echo "<tr>";
       if(!empty($st['photo'])){
        echo "<td> <img src='../images/$st[6]' width='70' height='70'> </td>";    
    }
    else{
        echo "<td> <img src='../images/default.jpg' width='70' height='70'> </td>";    
    }
       echo "<td> $st[id]         </td>";
       echo "<td> $st[fullName]   </td>";
       echo "<td> $st[email]      </td>";
       echo "<td> $st[phoneNumber]</td>";
       echo "<td> $st[username]   </td>";
       echo "<td> *****  </td>";
       echo "<td> $st[address]    </td>";
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