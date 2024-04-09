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

            //check for username with password entered by user in the 'users' table
            $sql = "select * from users where username = :username and password = :password limit 1";
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

    function register($user_information)
    {
        //getting parameter passed by the call($username, $password, $confirm_password)
        extract($user_information);

        $register_statues = [
            "statues"   =>  true,
            "message"   =>  "",
        ];


        //validation(1): fill information
        //check if user enter valid information for register
        //trim() remove white spaces from string
        //so if trim($var_name) == "", so the user not enter anything
        if (trim($id) == "" 
        || trim($full_name) == ""
        || trim($email) == ""
        || trim($phone_number) == ""
        || trim($username) == "" 
        || trim($password) == "" 
        || trim($confirm_password) == "" 
        )
        {
            //set statues of register to false(not done) and message to inform user to enter information for regiteration

            $register_statues = [
                "statues"   =>  false,
                "message"   =>  "please fill the form",
            ];

            return $register_statues;
        }

        //validation(2): same passwords
        //check password and confirm password are the same
        if ($password != $confirm_password)
        {

            //set statues of register to false and message to inform user that he/she entered different passwords

            $register_statues = [
                "statues"   =>  false,
                "message"   =>  "passwords not match",
            ];

            return $register_statues;
        }

        //validation(3): character of password must be at least 8 characters..
        if (strlen($password) < 8)
        {

            $register_statues = [
                "statues"   =>  false,
                "message"   =>  "Your Password Must Contain At Least 8 Characters!",
            ];

            return $register_statues;
        }

        //validation(4): character of username must be at least 8 characters..
        if (strlen($username) < 8)
        {

            $register_statues = [
                "statues"   =>  false,
                "message"   =>  "The username Must Contain At Least 8 Characters!",
            ];

            return $register_statues;
        }

        //user pass validation(1) and (2) and (3) and (4)
        try
        {

            //make connection
            require('connection.php');

            //validation(5): username not exist before
            //check if the username is not exist
            $sql = "select * from users where username = :username";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":username", $username);
            $stmt->execute();
            $user = $stmt->fetch();

            //validation(6):  check if the email is not exist
            $sql1 = "select * from users where email = :email";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindValue(":email", $email);
            $stmt1->execute();
            $user1 = $stmt1->fetch();

             //validation(7):  check if the id is not exist
             $sql2 = "select * from users where id = :id";
             $stmt2 = $db->prepare($sql2);
             $stmt2->bindValue(":id", $id);
             $stmt2->execute();
             $user2 = $stmt2->fetch();

            //if there is fetch, so the username is exist and user not pass validation(3)
            if ($user != null)
            {

                //set statues of register to false and message to inform user that the entered username is already exist
                $register_statues['statues'] = false;
                $register_statues['message'] = "Username already exist";

            } 
            elseif($user1 != null)
            {
                $register_statues['statues'] = false;
                $register_statues['message'] = "An account is already registered with this email";
            }
            elseif($user2 != null)
            {
                $register_statues['statues'] = false;
                $register_statues['message'] = "An account is already registered with this id"; 
            }
            //username not exist, so user pass validation(3) and the registeration proccess should be done
            else
            {

                //register user by inserting new row to the 'users' table
                $sql = "insert into users(id, fullName, email, phoneNumber, username, password, photo, address) 
                        values(:id, :full_name, :email, :phone_number, :username, :password, :photo, :address)";

                $stmt = $db->prepare($sql);

                $stmt->bindValue(":id", $id);
                $stmt->bindValue(":full_name", $full_name);
                $stmt->bindValue(":email", $email);
                $stmt->bindValue(":phone_number", $phone_number);
                $stmt->bindValue(":username", $username);
                //md5() function for hashing the password
                $stmt->bindValue(":password", md5($password));
                $stmt->bindValue(":photo", $photo);
                $stmt->bindValue(":address", $address);

                $result = $stmt->execute();

                //if there is row inserted, so user registred successfully
                if ($result > 0)
                {

                    //set statues of register to true
                    $register_statues = [
                        "statues"   =>  true,
                        "message"   =>  "registred successfully",
                    ];
                }
                else 
                {
                    //maybe some error occur in the middle, so not registeration is done.
                    $register_statues = [
                        "statues"   =>  false,
                        "message"   =>  "something error",
                    ];
                }
            }

        }
        catch(PDOException $ex) {
            echo "Connection Error occured!";  //user friendly message
            die ($ex->getMessage());
        }
    
        return $register_statues;

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