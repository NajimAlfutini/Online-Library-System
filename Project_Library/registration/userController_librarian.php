<?php

    session_start();

    //function to check if the user logged in or not
    function is_login()
    {

        //check the session, if ['user'] is setted then user is logged
        //session is setted by login function
        if (isset($_SESSION['user']['logged']))
        {

            return true;

        }

        //user not logged
        return false;

    }

    function login($username, $password)
    {

        //set login_statues to true by default
        $login_statues = true;
        
        try
        {
            //make connection
            require('connection.php');

            //check for username with password entered by user in the 'librarian' table
            $sql = "select * from librarian where username = :username and password = :password limit 1";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":username", $username);
            $stmt->bindValue(":password", md5($password));
            $stmt->execute();
            $user = $stmt->fetch();

            //if the user exist in the table, it is logged in successfully
            if ($user != null)
            {
                //set a session array containig user information
                $_SESSION['user'] = array(

                    "logged"    =>  true,
                    "userid"    =>  $user['id'],
                    "username"  =>  $user['username'],

                );

                //user login_statues is true
                $login_statues = true;
            }
            //if the user is null, not founded in the table so not logged in
            else
            {
                $login_statues = false;
            }

        }
        catch(PDOException $ex) {
            echo "Connection Error occured!";  //user friendly message
            die ($ex->getMessage());
        }

        return $login_statues;//true if logged in, otherwise false
        
    }

    function logout()
    {
        //check if session user is setted, then remove it to make user logged out
        if (isset($_SESSION['user']))
        {
            //remove session user, so he/she logged out
            unset($_SESSION['user']);
            //after logged user out, go to login page so he/she can login again if he/she want
            header('location: login.php');
        }
    }

?>