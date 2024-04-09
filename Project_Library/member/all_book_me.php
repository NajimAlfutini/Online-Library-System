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
    echo "<h2>Available Book In The Library: </h2>";
    
   $data = $db->query("select * from book order by ID")->fetchAll();

   if($data)
   {
   echo "<table class='content-table'>";
   echo "<tr>
   <th>ID</th>
   <th>ISBN</th>
   <th>Title</th>
   <th>Author</th>
   <th>Publisher</th>
   <th>Year Of Publication</th>
   <th>Book Copies</th>
   <th>Cataegories</th>
   <th>Return Date</th>
   <th>Borrow</th>     
   </tr>";

   foreach ($data as $row) {
       echo "<tr>";
       echo "<form method=post action='borrow.php'>";
       echo "<td> $row[0]    </td>";    
       echo "<td> $row[1]    </td>";
       echo "<td> $row[2]    </td>";
       echo "<td> $row[3]    </td>";
       echo "<td> $row[4]    </td>";
       echo "<td> $row[5]    </td>";
       echo "<td> $row[6]    </td>";
       echo "<td> $row[7]    </td>";       
       echo "<td> <input type='date' name='return_data'> </td>";
       echo "<td> <input type='submit' name='sb' value='Borrow The Book'> </td>";
       echo "<input type='hidden' name='book_id' value='$row[0]'>";
       echo "<input type='hidden' name='book_title' value='$row[2]'>";
       echo "</form>";
       echo "</tr>";
    }
   echo "</table>";
   echo "</center>";

}
   
?>
                <a href="../index.php">Back</a>
            </div>
        </div>
    </div>

</body>

</html>