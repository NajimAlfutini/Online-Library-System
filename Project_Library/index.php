<?php
  require('registration/userController.php');
  //check if the user logged in or not
  if (is_login() == false)
  {
    //redirect to login page
    header('location: registration/login.php');
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Home Page 'member'</title>
    <link rel="stylesheet" href="style/style_index.css">
</head>

<body>
    <button type="button"><a href="member/my_account_me.php">My Account</a></button>
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

            <a href="member/all_book_me.php">
                <input type="button" value="Display Available Books" />
            </a><br /><br />

            <a href="member/my_book.php">
                <input type="button" value="Display My Book" />
            </a><br /><br />

            <a href="member/search_book.php">
                <input type="button" value="Search For Book" />
            </a><br /><br />

        </div>
    </div>
</body>

</html>