<?php 
    session_start();
    include_once("assets/user_accounts.php");

    if(!isset($_SESSION['userid']) && !isset($_SESSION['password'])){
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
    <link href='css/register_layout.css' rel='stylesheet' type='text/css'>

     <!-- Google Fonts -->
     <link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet'>
     <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
     <link href='https://fonts.googleapis.com/css?family=Roboto|Work+Sans' rel='stylesheet'>
     <!-- Font Awesome -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css' integrity='sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp' crossorigin='anonymous'>

    
     <title>Real Estate | Registration</title>
  </head>
  <body>";
  if(isset($_SESSION['errormessage']) || isset($message)){
    $message = $_SESSION['errormessage'];
    echo"<div align='center'>
    <div class='alert alert-secondary' role='alert'>
    $message
  </div>
    </div>";
    unset($_SESSION['errormessage']);
    unset($message);
}
  echo"
      <br><br><br><br>
    <div id='register_form'>
        <div align='center'>
            <h3>REAL ESTATE<br>Registration</h3>
        </div>
        <hr>
        <form action='register.php' method='post'>
            <div class='row'>
                <div class='col-6'>
                    <p class='register_label'>First Name</p><br>
                    <input class='register_input' name='fName' type='text'><br>
                    <p class='register_label'>Last Name</p><br>
                    <input class='register_input' name='lName' type='text'><br>
                    <p class='register_label'>Password</p><br>
                    <input class='register_input' name='password' type='password'><br>
                    <p class='register_label'>Re-enter password</p><br>
                    <input class='register_input' name='passwordConf' type='password'><br>
                    <p class='register_label'>E-mail</p><br>
                    <input class='register_input' name='email' type='email'><br>
                </div>
                <div style='border-left: 0.1rem solid grey' class='col-6'>
                        <p class='register_label'>Registration Key<br>(<i>A unique key given to you by your system or web administrator.</i>)</p><br> 
                        <input class='register_input' name='r_key' type='text'><br>
                        <br>
                        <button type='submit' class='btn btn-success'>Create</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
  </body>
</html>
        ";
        if(isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['password']) && isset($_POST['passwordConf']) && isset($_POST['email']) && isset($_POST['r_key'])) {
            $status_key = False;
            $conn = new Connection;
            $query = mysqli_query($conn->connect(), "SELECT v_key FROM verification_keys WHERE status = 'active'");
            while($row = mysqli_fetch_array($query)){
                if($_POST['r_key'] == $row['v_key']){
                    $status_key = True;
                    $key = $row['v_key'];
                    $change = mysqli_query($conn->connect(), "UPDATE verification_keys SET status = 'expired' WHERE v_key = '$key'");
                    break;
                }
            }
            
            if($status_key == True){
            try {
                $new_user = new CreateAccount($_POST['fName'], $_POST['lName'], $_POST['password'], $_POST['passwordConf'], $_POST['email']);
                if($new_user -> create()){
                    header("Location: login.php");
                }
                else {
                    $_SESSION['errormessage'] = "Unknown error occured. Try again...";
                    header("Location: register.php");
                }
                
            }
            catch (Exception $error){
                $_SESSION['errormessage'] = $error -> getMessage();
                header("Location: register.php");
            }
        }
        else $_SESSION['errormessage'] = "Your verification key may be more not active. If you think that is a mistake, please contact the administration.";
        }
        else {
            $_SESSION['errormessage'] = "All fields are required...";
        }
    }
    else header("Location: dashboard.php");




?>