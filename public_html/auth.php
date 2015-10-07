<?php
session_start();

if (isset($_GET['page'])){
  if ($_GET['page']=='adduser'){    
    /*** set a form token ***/
    $form_token = md5( uniqid('auth', true) );
    /*** set the session form token ***/
    $_SESSION['form_token'] = $form_token;
  }//register
  elseif ($_GET['page']=='adduser_submit'){

    /*** first check that both the username, password and form token have been sent ***/
    if(!isset( $_POST['username'], $_POST['pass'], $_POST['form_token']))
    {
        $message = 'Please enter a valid username and password';
    }
    /*** check the form token is valid ***/
    elseif( $_POST['form_token'] != $_SESSION['form_token'])
    {
        $message = 'Invalid form submission';
    }
    /*** check the username is the correct length ***/
    elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
    {
        $message = 'Incorrect Length for Username';
    }
    /*** check the password is the correct length ***/
    elseif (strlen( $_POST['pass']) > 20 || strlen($_POST['pass']) < 4)
    {
        $message = 'Incorrect Length for Password';
    }
    /*** check the username has only alpha numeric characters ***/
    elseif (ctype_alnum($_POST['username']) != true)
    {
        /*** if there is no match ***/
        $message = "Username must be alpha numeric";
    }
    /*** check the password has only alpha numeric characters ***/
    elseif (ctype_alnum($_POST['pass']) != true)
    {
            /*** if there is no match ***/
            $message = "Password must be alpha numeric";
    }
    else
    {
        /*** if we are here the data is valid and we can insert it into database ***/
        $phpro_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $phpro_password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
        /*** now we can encrypt the password ***/
        $phpro_password = sha1( $phpro_password );
        try
        {
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("INSERT INTO users (username, pass ) VALUES (:phpro_username, :phpro_password )");

            $stmt->bindParam(':phpro_username', $phpro_username, PDO::PARAM_STR);
            $stmt->bindParam(':phpro_password', $phpro_password, PDO::PARAM_STR, 40);

            $stmt->execute();
            
            unset( $_SESSION['form_token'] );
            /*** if all is done, say thanks ***/
            $message = 'New user added';
        }
        catch(Exception $e)
        {
            /*** check if the username already exists ***/
            if( $e->getCode() == 23000)
            {
                $message = 'Username already exists';
            }
            else
            {
                /*** if we are here, something has gone wrong with the database ***/
                $message = 'We are unable to process your request. Please try again later"';
            }
        }
    }
  } //adduser_submit
  elseif ($_GET['page']=='login_submit'){
      /*** check if the users is already logged in ***/
    if(isset( $_SESSION['user_id'] ))
    {
        $message = 'Users is already logged in';
    }
    /*** check that both the username, password have been submitted ***/
    if(!isset( $_POST['username'], $_POST['pass']))
    {
        $message = 'Please enter a valid username and password';
    }
    /*** check the username is the correct length ***/
    elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
    {
        $message = 'Incorrect Length for Username';
    }
    /*** check the password is the correct length ***/
    elseif (strlen( $_POST['pass']) > 20 || strlen($_POST['pass']) < 4)
    {
        $message = 'Incorrect Length for Password';
    }
    /*** check the username has only alpha numeric characters ***/
    elseif (ctype_alnum($_POST['username']) != true)
    {
        /*** if there is no match ***/
        $message = "Username must be alpha numeric";
    }
    /*** check the password has only alpha numeric characters ***/
    elseif (ctype_alnum($_POST['pass']) != true)
    {
            /*** if there is no match ***/
            $message = "Password must be alpha numeric";
    }
    else
    {
        $phpro_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $phpro_password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
        $phpro_password = sha1( $phpro_password );
        try
        {
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT id, username, pass, is_admin FROM users WHERE username = :phpro_username AND pass = :phpro_password");

            $stmt->bindParam(':phpro_username', $phpro_username, PDO::PARAM_STR);
            $stmt->bindParam(':phpro_password', $phpro_password, PDO::PARAM_STR, 40);

            $stmt->execute();
            
            $user_info = $stmt->fetchAll();
            
            $user_id = $user_info[0][0];
            $user_name = $user_info[0][1];
            $user_admin = $user_info[0][3];
            
            if($user_id == false)
            {
                    $message = 'Login Failed';
                    $message .= $user_id;
            }
            /*** if we do have a result, all is well ***/
            else
            {
                    /*** set the session user_id variable ***/
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['user_admin'] = $user_admin;
                    /*** tell the user we are logged in ***/
                    $message = 'You are now logged in, you will be redirected to the main page shortly';
            }
        }
        catch(Exception $e)
        {
            /*** if we are here, something has gone wrong with the database ***/
            $message = 'We are unable to process your request. Please try again later"';
        }
    }
  }//
  elseif ($_GET['page']=='change_password_submit') {
      /*** check the password is the correct length ***/
    if (strlen( $_POST['pass']) > 20 || strlen($_POST['pass']) < 4)
    {
        $message = 'Incorrect Length for Password';
    }
        /*** check the password is the correct length ***/
    elseif (strlen( $_POST['newpass']) > 20 || strlen($_POST['newpass']) < 4)
    {
        $message = 'Incorrect Length for New Password';
    }
    else {
        $phpro_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $phpro_password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
        $phpro_password_new = filter_var($_POST['newpass'], FILTER_SANITIZE_STRING);
        $phpro_password = sha1( $phpro_password );
        $phpro_password_new = sha1( $phpro_password_new );
        try
        {
            $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbh->prepare("SELECT id, username, pass, is_admin FROM users WHERE username = :phpro_username AND pass = :phpro_password");

            $stmt->bindParam(':phpro_username', $phpro_username, PDO::PARAM_STR);
            $stmt->bindParam(':phpro_password', $phpro_password, PDO::PARAM_STR, 40);

            $stmt->execute();
            
            $user_info = $stmt->fetchAll();
            
            $user_id = $user_info[0][0];
            $user_name = $user_info[0][1];
            $user_admin = $user_info[0][3];
            
            if($user_id == false)
            {
                    $message = 'Login Failed';
                    $message .= $user_id;
            }
            /*** if we do have a result, all is well ***/
            else
            {
                try
                {                  
                    $dbh = new PDO("mysql:host=".$database['host'].";dbname=".$database['name'], $database['user'], $database['pass']);

                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $dbh->prepare("UPDATE users SET pass=:phpro_password WHERE username = :phpro_username AND pass = :phpro_password_old");

                    $stmt->bindParam(':phpro_username', $phpro_username, PDO::PARAM_STR);
                    $stmt->bindParam(':phpro_password_old', $phpro_password, PDO::PARAM_STR, 40);
                    $stmt->bindParam(':phpro_password', $phpro_password_new, PDO::PARAM_STR, 40);

                    $stmt->execute();
                    
                    /*** if all is done, say thanks ***/
                    $message = 'Password changed';
                }
                catch(Exception $e)
                {
                    /*** check if the username already exists ***/
                    if( $e->getCode() == 23000)
                    {
                        $message = 'Username already exists';
                    }
                    else
                    {
                        /*** if we are here, something has gone wrong with the database ***/
                        $message = 'We are unable to process your request. Please try again later"';
                    }
                }
            }
        }
        catch(Exception $e)
        {
            /*** if we are here, something has gone wrong with the database ***/
            $message = 'We are unable to process your request. Please try again later"';
        }
     }
  }
}
?>
