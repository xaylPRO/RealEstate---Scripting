<?php 
    session_start();
    include_once("assets/messageconfig.php");


    $message = new Message;

    if($_POST['userGiven'] == True){
        $reciverId = $_POST['reciverId'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $content = $_POST['content'];

        try{
            $message -> create($firstName, $lastName, $email, $subject, $content, $reciverId);
            $_SESSION['errormessage'] = "Your message has been sent.";
        }
        catch(Exception $e){
            $_SESSION['errormessage'] = $e->getMessage();
        }
        header("Location: contactUs.php");   
    }
    else if($_POST['userGiven'] == False){
        $reciverId = "ALL";
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $content = $_POST['content'];

        try{
            $message -> create($firstName, $lastName, $email, $subject, $content, $reciverId);
            echo $reciverId;
            $_SESSION['errormessage'] = "Your message has been sent.";
        }
        catch(Exception $e){
            $_SESSION['errormessage'] = $e->getMessage();
        }
        header("Location: contactUs.php");   
    }






?>