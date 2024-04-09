<html>

<head>
    <title>Insert Book</title>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    html,
    body {
        background: #6665ee;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
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

    .er {
        width: 26%;
        height: 10%;
        border: 1px;
        border-radius: 05px;
        padding: 8px 15px 8px 15px;
        margin: 10px 0px 15px 0px;
        box-shadow: 1px 1px 2px 1px;
        background-color: red;
        font-size: 22px;
    }
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">

                <center><u>
                        <h2>Add New Book</h2>
                    </u></center>

                <table border='1' class='content-table'>
                    <tr>
                        <td colspan="4">
                            <form method="post">

                                <table>

                                    <tr>
                                        <td>Book ID: </td>
                                        <td>
                                            <input type="number" name="id" placeholder="Enter Book ID">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Book ISBN: </td>

                                        <td>
                                            <input type="text" name="ISBN" placeholder="Enter ISBN For Book">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Title: </td>

                                        <td>
                                            <input type="text" name="title" placeholder="Enter Book Title">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Author: </td>

                                        <td>
                                            <input type="text" name="author" placeholder="Enter Author of the book">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Publisher: </td>

                                        <td>
                                            <input type="text" name="publisher" placeholder="Enter The Publisher">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Year Of Publication: </td>

                                        <td>
                                            <input type="number" name="yearOfPublication"
                                                placeholder="Enter The Eare OF Publication">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Book Copies: </td>

                                        <td>
                                            <input type="number" name="bookCopies"
                                                placeholder="Enter Number of Book Copies">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Categories: </td>

                                        <td>

                                            <input type="text" name="categories"
                                                placeholder="Enter Catagore Of The Book">
                                        </td>
                                    </tr>

                                    <tr>
                                        <br>
                                        <td colspan="2">
                                            <!-- run {add_block} -->
                                            <button> <a href="../index.librarian.php">Back</a>
                                            </button>
                                            <input type="submit" value="Add" name="add">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 style="text-align: center; color: red;">
                                            <?php

//this part will not execute unless the user click on add button {add_block}
            if (isset($_POST['add']))
            {
                $pass = false;
                if(
                    !empty($_POST['id']) && 
                    !empty($_POST['ISBN']) &&
                    !empty($_POST['title']) &&                     
                    !empty($_POST['author']) &&
                    !empty($_POST['publisher']) &&
                    !empty($_POST['yearOfPublication']) &&
                    !empty($_POST['bookCopies']) &&
                    !empty($_POST['categories']))
                {
                    $id = $_POST['id'];
                    $ISBN = $_POST['ISBN'];
                    $title = $_POST['title'];
                    $author = $_POST['author'];
                    $publisher = $_POST['publisher'];
                    $yearOfPublication = $_POST['yearOfPublication'];
                    $bookCopies = $_POST['bookCopies'];
                    $categories = $_POST['categories'];
                    
                    // connection with database
                    $db = new PDO('mysql:host=localhost;dbname=project_library_db;charset=utf8', 'root');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // 1- validation: check if the ISBN are unique
                    $check1 = $db->query("select * from book where ISBN='$ISBN'");
                    //convert to associative array
                    $check1 = $check1->fetchAll();

                     // 2- validation: check if the id are unique              
                    $check2 = $db->query("select * from book where id='$id'");
                    //convert to associative array
                    $check2 = $check2->fetchAll();

                    $message = "";
                    if (count($check1) > 0)
                    { $message = "<b>Failed to add book</b><br>
                                The book is already exist (The ISBN is exist)";  
                    }
                    elseif(count($check2) > 0)
                    {
                        $message = " <b>Failed to add book</b><br>
                                    This ID are taken";
                           
                    }
                    else
                    {
                        // if pass all the validations.. insert the book to the book table
                        $pass = true;
                        $sql = "insert into book(id, ISBN, title, author, publisher, yearOfPublication, bookCopies, categories) 
                        values ('$id','$ISBN',' $title',' $author',' $publisher',' $yearOfPublication',' $bookCopies',' $categories')";
                        $result = $db->query($sql);
                        
                        
                        if($result){
                            $message_pass= "<b style='color:blue';>Book added successfully</b><br>";
                           
                        }
                           
                    }

                }
                else
                {
                    $message = "<b>Failed to add book</b><br>
                                All Fields are Required";
                }

                if($pass == true)
                    echo $message_pass;
                else
                    echo $message;
                   
            }
?>
                                        </td>
                                    </tr>
                                </table>

                            </form>

                        </td>

                    </tr>

                </table>
            </div>
        </div>
    </div>
</body>

</html>