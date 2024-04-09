<html>

<?php
        require('userController_librarian.php');

        // check if user already login, redirect it to index page
        if (is_login()){
            header("location: ../index_librarian.php");
        }
        
        //this part will not execute unless the user click on login button {login_block}
        if (isset($_POST['login'])){

            extract($_POST);

            //call to the login function in userController
            $login_statues = login($username, $password);

            //if logged successfully, redirect to index.librarian page
            if ($login_statues == true){
                header("location: ../index.librarian.php");
            }
        }
?>

<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form method="post">

                    <table width="100%" cellpadding="6" style="text-align: center; ">

                        <tr>
                            <td>
                                <h1>Login Form "Librarian"</h1>
                                <p>Login with your username and password: </p>
                            </td>
                        </tr>

                        <tr>
                            <div class="form-group">
                                <td>
                                    <input class="form-control" type="text" name="username"
                                        placeholder="please enter username">
                                </td>
                            </div>
                        </tr>

                        <tr>
                            <div class="form-group">

                                <td>
                                    <input class="form-control" type="password" name="password"
                                        placeholder="please enter password">
                                </td>
                            </div>
                        </tr>

                        <?php
            //showing error message
            if (isset($login_statues))
            {
                if ($login_statues == false)
                {
                    ?>
                        <tr>
                            <td style="color: red;">
                                <?php echo "Username or password error!" ?>
                            </td>
                        </tr>
                        <?php
                }
            }

        ?>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <!-- run {login_block} -->
                                    <input class="form-control button" type="submit" value="Login" name="login">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="link login-link text-center">
                                    <br><a href="login.php">Go back</a>
                                </div>
                            </td>
                        </tr>

                    </table>

                </form>

            </div>
        </div>
    </div>

</body>

</html>