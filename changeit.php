<?php 
    session_start();

    include_once("assets/user_accounts.php");

    if(isset($_SESSION['userid']) && isset($_SESSION['password'])){
        if(isset($_POST['target_property']) && isset($_POST['newValue'])){
            echo"33";
            $user = new User;
            if($user->changeProperty($_SESSION['userid'], $_SESSION['password'], $_SESSION['userid'], $_POST['target_property'], $_POST['newValue'])){
                $_SESSION["errormessage"] = "All changes have been successfully saved.";
                header("Location: dashboard.php");
            }
            else {
                $_SESSION['errormessage'] = "Unknown error occured. Please try again.";
                header("Location: dashboard.php");
            }
        }
        else {
            $_SESSION['errormessage'] = "Unknown error occured. Please try again.";
                header("Location: dashboard.php");
        }
    }
    else {
        $_SESSION['errormessage'] = "Unknown error occured. Please try again.";
                header("Location: dashboard.php");
    }



?>