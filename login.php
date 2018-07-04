<?php 
    session_start();
    include_once("assets/user_accounts.php");

    if(empty($_SESSION['user_id']) && empty($_SESSION['password'])){
        echo"
        <!doctype html>
<html lang='en'>
  <head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' integrity='sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB' crossorigin='anonymous'>
    
    <!-- Custom CSS -->
    <link href='css/login_layout.css' rel='stylesheet' type='text/css'>

     <!-- Google Fonts -->
     <link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet'>
     <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
     <link href='https://fonts.googleapis.com/css?family=Roboto|Work+Sans' rel='stylesheet'>
     <!-- Font Awesome -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css' integrity='sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp' crossorigin='anonymous'>

    
     <title>Real Estate | Log In</title>
  </head>
  <body>
  ";
        if(isset($_SESSION['errormessage'])){
            $message = $_SESSION['errormessage'];
            echo"<div align='center'>
            <div class='alert alert-secondary' role='alert'>
            $message
          </div>
            </div>";
            unset($_SESSION['errormessage']);
        }
  echo"
      <br><br><br><br>
    <div id='login_form'>
        <div align='center'>
            <h3>REAL ESTATE<br>Log In</h3>
        </div>
        <hr>
        <form action='login.php' method='post'>
            <p class='login_label'>User ID</p><br>
            <input class='login_input' type='text' name='userid'><br>
            <p class='login_label'>Password</p><br>
            <input class='login_input' type='password' name='password'><br>
            <br>
            <button type='submit' class='btn btn-success'>Log In</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
  </body>
</html>";
    if(!empty($_POST['userid']) && !empty($_POST['password'])){
        $user = new Login;
        try {
            if($user -> verify($_POST['userid'], $_POST['password'])){
                $_SESSION['userid'] = $_POST['userid'];
                $_SESSION['password'] = $_POST['password'];
                header("Location: dashboard.php");
            }
            else { 
                $_SESSION['errormessage'] = "False user Id or password. Try again.";
                header("Location: login.php");
            }
        }
        catch(Exception $error) {
            $_SESSION['errormessage'] = $error -> getMessage();
            header("Location: login.php");
        }
    }
    }
    else header("Location: dashboard.php");









?>