<html>

<?php

        require('userController.php');

        // check if user already login, redirect it to index page (no need to register when already login)
        if (is_login())
        {
            header("location: ../index.php");
        }

        //this part will not execute unless the user click on register button {register_block}
        if (isset($_POST['register']))
        {

            extract($_POST);

            //set parameter to be passed to register function 
            //we create an array to pass it to function because usually in register forms we have a lot of information, so the function parameter will large, we can simply pass all the parameters using associative array, then extract them in the function           
            $user_information = array(
                "id"                    =>  $id,
                "full_name"             =>  $full_name,
                "email"                 =>  $email,
                "phone_number"          =>  $phone_number,            
                "username"              =>  $username,
                "password"              =>  $password,
                "confirm_password"      =>  $confirm_password,
                "photo"                 =>  $photo,
                "address"               =>  $address
            );

            //call the register function
            $register_statues = register($user_information);

            //registered successfully
            if ($register_statues['statues'] == true)
            {
                //redirect to login page, so user login in to the website
                header('location: login_member.php');
                
                //make the user login, directly call login function with the new user data
                login($user_information['username'], $user_information['password']);
            }

        }

    ?>

<head>
    <title>Register Form</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">

                <form method="post">

                    <table width="100%" cellpadding="3" style="text-align: ; ">

                        <tr>
                            <td colspan=2 style="text-align: center;">
                                <h1>Register</h1>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2>Please fill the following form:
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>ID: </label>
                            </td>
                            <td>
                                <input type=" text" name="id" placeholder="please enter your id">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Full Name: </label>
                            </td>
                            <td>
                                <input type="text" name="full_name" placeholder="please enter your name">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email: </label>
                            </td>
                            <td>
                                <input type="email" name="email" placeholder="please enter your email">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Phone Number: </label>
                            </td>
                            <td>
                                <input type="text" name="phone_number" placeholder="please enter your number">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Username: </label>
                            </td>
                            <td>
                                <input type=" text" name="username" placeholder="please enter username">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Password: </label>
                            </td>
                            <td>
                                <input type="password" name="password" placeholder="please enter password">

                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Confirm Password: </label>
                            </td>
                            <td>
                                <input type="password" name="confirm_password" placeholder="please confirm password">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Photo"optional":</label>
                            </td>
                            <td>
                                <input type="file" name="photo"  placeholder="please uplode your photo">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Address"optional": </label>
                            </td>
                            <td>
                                <input type=" text" name="address" placeholder="please enter your address">
                            </td>
                        </tr>

                        <?php

                if (isset($register_statues))
                {
                    //if something error, show user the message returned by register function
                    if ($register_statues['statues'] == false)
                    {
            ?>

                        <tr>
                            <td colspan=2 style="text-align: center; color: red;">
                                <?php echo $register_statues['message']; ?>
                            </td>
                        </tr>

                        <?php
                     }
                }

            ?>

                        <tr>
                            <td>
                                <br>
                                <!-- run {register_block} -->
                                <input type="submit" value="register" name="register">
                                <input type="reset" value="Clear" />
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                Already a member? <a href=" login_member.php">Login here</a>
                            </td>

                        </tr>

                    </table>

                </form>
            </div>
        </div>

    </div>



</body>

</html>