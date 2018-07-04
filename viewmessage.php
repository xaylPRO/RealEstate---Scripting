<?php 

    session_start();                    

    include_once("assets/messageconfig.php");

    if(isset($_SESSION['userid']) && isset($_SESSION['password'])){
        if(isset($_GET['id'])){
        $message = new Message;
        
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
          <body>
            <div class='row'>
                <!-- Admin navbar start-->
                <div id='admin_navbar' class='col-2'>
                    <div id='title'>
                        <h3>REAL ESTATE<br><b>Dashboard</b></h3>
                    </div>
                    <nav>
                        <ul>
                            <li><a href='#'><i class='fas fa-user'></i> Samuel Imagino</a></li>
                            <li><a href='#'><i class='fas fa-home'></i> Manage Properties</a></li>
                            <li><a href='#'><i class='fas fa-plus'></i> Add Property</a></li>
                            <li><a href='#'><i class='fas fa-envelope'></i> Messages <i style='color: red;' class='fas fa-circle'></i></a></li>
                            <li><a href='#'><i class='fas fa-power-off'></i> Log Out</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Admin navbar end -->
                <!-- Admin maincontent start-->
                <div id='admin_maincontent' class='col-10'>";
                $message -> displayById($_GET['id']);
                echo"
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
        }else header("Location: dashboard.php");
    }
    else {
        $_SESSION['errormessage'] = "For any future actions you have to be logged in. Try again...";
        header("Location: logins.php");
    }





?>