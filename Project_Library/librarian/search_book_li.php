<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Book</title>
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

    #search1 {
        margin: 20px 20px 30px 30px;
        display: inline-block;
    }

    #search2 {
        margin: 20px 20px 30px 30px;
        display: inline-block;

    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">

                <?php

$user="root";
$password = "";
$database= new PDO("mysql:host=localhost; dbname=project_library_db;", $user,$password);                           

echo "<center>";
echo "<div id=search1>";
echo "<form method='GET'>";
echo "<h4>Search By Cataegories: </h4>";
echo "<input type='text' name='search' placeholder='search....'> ";
echo "<button type='submit' name='btn-search'>Search</button> ";
echo "</div>";


echo "<div id=search2>";
echo "<form method='GET'>";
echo "<h4>Search By ID: </h4>";
echo "<input type='text' name='search1' placeholder='search....'> ";
echo "<button type='submit' name='btn-search1'>Search</button> ";
echo "</div>";
echo "</center>";

// the search will display all detail of the book if the user inserts
// the cataegories that belong to the book.
if(isset($_GET['btn-search'])){
$SEARCH = $database->prepare("select * from book where categories like :value");
     
$SEARCH_VALUE = "%".$_GET['search']."%";
$SEARCH->bindParam("value",$SEARCH_VALUE);
$SEARCH->execute();

echo "<center>";
echo "<h3>Result of The Search: </h3>";
echo "<table border=1 class='content-table'>";
echo "<tr>
<th>ID</th>
<th>ISBN</th>
<th>Title</th>
<th>Author</th>
<th>Publisher</th>
<th>Year Of Publication</th>
<th>Book Copies</th>
<th>Cataegories</th>
</tr>";

foreach ($SEARCH as $row) {
    echo "<tr>";
       echo "<td> $row[0]    </td>";    
       echo "<td> $row[1]    </td>";
       echo "<td> $row[2]    </td>";
       echo "<td> $row[3]    </td>";
       echo "<td> $row[4]    </td>";
       echo "<td> $row[5]    </td>";
       echo "<td> $row[6]    </td>";
       echo "<td> $row[7]    </td>";       
       echo "</tr>";
 }
echo "</table>";
echo "</center>";
}

// the search will display all detail of the book if the user inserts
// the ID that belong to the book.
if(isset($_GET['btn-search1'])){
    $SEARCH1 = $database->prepare("select * from book where id like :value");
         
    $SEARCH_VALUE1 = "%".$_GET['search1']."%";
    $SEARCH1->bindParam("value",$SEARCH_VALUE1);
    $SEARCH1->execute();
    
    echo "<center>";
    echo "<h3>Result of The Search: </h3>";
    echo "<table border=1 class='content-table'>";
    echo "<tr>
    <th>ID</th>
    <th>ISBN</th>
    <th>Title</th>
    <th>Author</th>
    <th>Publisher</th>
    <th>Year Of Publication</th>
    <th>Book Copies</th>
    <th>Cataegories</th>
    </tr>";
    
    foreach ($SEARCH1 as $row1) {
        echo "<tr>";
           echo "<td> $row1[0]    </td>";    
           echo "<td> $row1[1]    </td>";
           echo "<td> $row1[2]    </td>";
           echo "<td> $row1[3]    </td>";
           echo "<td> $row1[4]    </td>";
           echo "<td> $row1[5]    </td>";
           echo "<td> $row1[6]    </td>";
           echo "<td> $row1[7]    </td>";       
           echo "</tr>";
     }
    echo "</table>";
    echo "</center>";
}
   
?>
                <a href="../index.librarian.php">Back</a>

            </div>
        </div>
    </div>


</body>

</html>