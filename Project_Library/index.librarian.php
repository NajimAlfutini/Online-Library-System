<?php
  require('registration/userController_librarian.php');
  //check if the user logged in or not
  if (is_login() == false)
  {
    //redirect to login page
    header('location: registration/login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home Pgage 'Librarian'</title>
    <link rel="stylesheet" href="style/style_index_li.css">

</head>

<body>

    <button type="button"><a href="librarian/my_account_li.php">My Account</a></button>
    <button type="button"><a href="registration/logout.php">Logout</a></button>


    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <div style='vertical-align:middle; display:inline;'>
                    <h1 style='text-align:center;'>Library Management System</h1>
                </div>
            </div>
        </div>
    </div>


    <div id="allTheThings">
        <div class="container">

            <a href="librarian/insert_book.php">
                <input type="button" value="Insert New Book Record" />
            </a><br /><br />

            <a href="librarian/display_books.php">
                <input type="button" value="Display Available Books" />
            </a><br /><br />

            <a href="librarian/delete_book.php">
                <input type="button" value="Delete Book" />
            </a><br /><br />

            <a href="librarian/update_book.php">
                <input type="button" value="Update Book" />
            </a><br /><br />

            <a href="member/view_all_member.php">
                <input type="button" value="View All The Member Details" />
            </a>
            <br /><br /><br />

            <a href="librarian/search_member.php">
                <input type="button" value="Search For Member" />
            </a> <br><br>

            <a href="librarian/search_book_li.php">
                <input type="button" value="Search For Book" />
            </a> <br><br>

        </div>
    </div>
</body>

</html>