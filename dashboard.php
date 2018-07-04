<?php 

    session_start();
    include_once("assets/user_accounts.php");

    if(isset($_SESSION['userid']) && isset($_SESSION['password'])){
        $loginUser = new Login;
        if($loginUser->verify($_SESSION['userid'], $_SESSION['password'])) {
            $user = new User;
            $firstName = $user -> getProperty($_SESSION['userid'], $_SESSION['password'], $_SESSION['userid'], 'firstName');
            $lastName = $user -> getProperty($_SESSION['userid'], $_SESSION['password'], $_SESSION['userid'], 'lastName');
            $email = $user -> getProperty($_SESSION['userid'], $_SESSION['password'], $_SESSION['userid'], 'email');
            $profileImage = $user -> getProperty($_SESSION['userid'], $_SESSION['password'], $_SESSION['userid'], 'profileImage');
            $sex = $user -> getProperty($_SESSION['userid'], $_SESSION['password'], $_SESSION['userid'], 'sex');
            $town = $user -> getProperty($_SESSION['userid'], $_SESSION['password'], $_SESSION['userid'], 'town');
            $country = $user -> getProperty($_SESSION['userid'], $_SESSION['password'], $_SESSION['userid'], 'country');
            $status = $user -> getProperty($_SESSION['userid'], $_SESSION['password'], $_SESSION['userid'], 'status');
            
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
    <link href='css/dashboard-layout.css' rel='stylesheet' type='text/css'>

     <!-- Google Fonts -->
     <link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet'>
     <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
     <link href='https://fonts.googleapis.com/css?family=Roboto|Work+Sans' rel='stylesheet'>
     <!-- Font Awesome -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css' integrity='sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp' crossorigin='anonymous'>

    
     <title>Real Estate | Index</title>
  </head>
  <body>";
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
    <div class='row'>
        <!-- Admin navbar start-->
        <div id='admin_navbar' class='col-2'>
            <div id='title'>
                <h3>REAL ESTATE<br><b>Dashboard</b></h3>
            </div>
            <nav>
                <ul>
                    <li><a href='#'><i class='fas fa-user'></i> $firstName $lastName</a></li>
                    <li><a href='#'><i class='fas fa-home'></i> Manage Properties</a></li>
                    <li><a href='#'><i class='fas fa-plus'></i> Add Property</a></li>
                    <li><a href='#'><i class='fas fa-envelope'></i> Messages <i style='color: red;' class='fas fa-circle'></i></a></li>
                    <li><a href='logout.php'><i class='fas fa-power-off'></i> Log Out</a></li>
                </ul>
            </nav>
        </div>
        <!-- Admin navbar end -->
        <!-- Admin maincontent start-->
        <div id='admin_maincontent' class='col-10'>
            <div class='row'>
                <div class='col-2'>
                    <div id='image'>
                        <img src='$profileImage'>
                        <p><a href='change.php?property=profileImage>Change</i> <i class='fas fa-pencil-alt'></i></a></p>
                    </div>
                </div>
                <div class='col-10'>
                    <div id='info_tag'>
                        <h4>Personal Information</h4>
                    </div>
                    <p><b>First name:</b> <a href='change.php?property=firstName'><i>$firstName</i> <i class='fas fa-pencil-alt'></i></a></p>
                    <p><b>Last name:</b> <a href='change.php?property=lastName'><i>$lastName</i> <i class='fas fa-pencil-alt'></i></a></p>
                    <p><b>E-mail:</b> <a href='change.php?property=email'><i>$email</i> <i class='fas fa-pencil-alt'></i></a></p>
                    <p><b>Sex:</b> <a href='change.php?property=sex'><i>$sex</i> <i class='fas fa-pencil-alt'></i></a></p>
                    <p><b>Status:</b> <a href='change.php?property=status'><i>$status</i> <i class='fas fa-pencil-alt'></i></a></p>
                    <p><b>Country:</b> <a href='change.php?property=country'><i>$country</i> <i class='fas fa-pencil-alt'></i></a></p>
                    <p><b>Town:</b> <a href='change.php?property=town'><i>$town</i> <i class='fas fa-pencil-alt'></i></a></p>
                    <div id='info_tag'>
                            <h4>Related Items</h4>
                    </div>
                    <div class='alert alert-primary' role='alert'>
                            Property - ID: 1 - Name: House at the sea | created: 14.06.2018. -> <a href='#'>Preview</a> | <a href='#'>Edit</a> | <a style='color:red;' href='#'>Remove</a>
                          </div>
                    <div class='alert alert-primary' role='alert'>
                            A simple primary alert—check it out!
                    </div>
                </div>
            </div>
        </div>
        <!-- Admin maincontent end -->
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
  </body>
</html>
        ";
    }
    else header("Location: login.php");
}
    else header("Location: login.php");







?>