<?php 

    session_start();

    include_once("assets/user_accounts.php");
    include_once("assets/messageconfig.php");

        


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
        <link href='css/index-layout.css' rel='stylesheet' type='text/css'>
    
         <!-- Google Fonts -->
         <link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet'>
        <!-- Font Awesome -->
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css' integrity='sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp' crossorigin='anonymous'>
    
        
         <title>Real Estate | Index</title>
      </head>
      <body>";
      if(isset($_SESSION['errormessage'])){
        $messagee = $_SESSION['errormessage'];
        echo"<div align='center'>
        <div class='alert alert-secondary' role='alert'>
        $messagee
      </div>
        </div>";
        unset($_SESSION['errormessage']);
    }
      echo"
        <!-- Site header -->
        <div id='header'>
            <div class='content-container' style='width: 80%; margin: auto;'>
                <div id='navBar'>
                    <div class='row'>
                        <!-- Site logo -->
                        <div id='site-logo' class='col-2'>
                            <h1>Real<br>Estate</h1>
                        </div>
                        <!-- Site logo end -->
                        <!-- NavBar div -->
                        <div id='nav' class='col-6'>
                            <nav>
                                <ul>
                                    <li><a href='#'>Home</a></li>
                                    <li><a href='#'>For rent</a></li>
                                    <li><a href='#'>Buy</a></li> 
                                    <li><a href='#'>Sell</a></li>
                                    <li><a href='#'>About Us</a></li>  
                                    <li><a href='#'>Contact Us</a></li>     
                                </ul>
                            </nav>
                        </div>
                        <!-- NavBar end -->
                        <!-- Search div -->";
                        if(!isset($_SESSION['userid']) && !isset($_SESSION['password'])){
                        echo"
                        <div class='col-3' style='padding-top: 0.9rem; padding-left: 15rem;'>
                            <a href='login.php'><button style='font-size: 1.5rem; color: white;' class='btn btn-warning my-2 my-sm-0' type='submit'>Log In</button></a>
                            <a href='register.php'><button style='font-size: 1.5rem' class='btn btn-success my-2 my-sm-0' type='submit'>Register</button></a>
                        </div>
                        ";
                        }
                        else {
                            $user = new User;
                            $firstName = $user -> getfName($_SESSION['userid']);
                            echo"
                        <div class='col-3' style='padding-top: 0.9rem; padding-left: 15rem;'>
                            <a href='dashboard.php'><button style='font-size: 1.5rem; color: white;' class='btn btn-warning my-2 my-sm-0' type='submit'>Hi, $firstName</button></a>
                            <a href='logout.php'><button style='font-size: 1.5rem' class='btn btn-success my-2 my-sm-0' type='submit'>Sign Out</button></a>
                        </div>
                        ";
                        }
                        echo"
                        <!-- Search div end -->
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Site header end -->
        <br><br><br><br>
        <!-- Main Content section -->
        <div id='main-content'>
            <div class='content-container' style='width: 80%; margin: auto;'>
    
                <div class='row'>
                    <div class='col-9'>
                        <div id='info_tag'>
                            <h3>Contact Us</h3>
                        </div>
                        <form action='contactUsP.php' method='post'>";
                        if(isset($_GET['targetId'])){
                            $id = $_GET['targetId'];
                            echo"<input type='hidden' name='userGiven' value='True'>
                            <input type='hidden' name='reciverId' value ='$id'";
                        }
                        else {
                            echo"<input type='hidden' name='userGiven' value='False'>";
                        }
                        echo"
                        <div class='row'>
                            <div class='col-6'>
                                    <div class='input-group'>
                                            <div class='input-group-prepend'>
                                              <span style='font-size: 1.5rem;' class='input-group-text' >First and last name</span>
                                            </div>
                                            <input  name='firstName' style='font-size: 1.5rem;' type='text' class='form-control'>
                                            <input name='lastName' style='font-size: 1.5rem;' type='text' class='form-control'>
                                          </div>
                                          <br><br>
                                          <div class='input-group'>
                                                <div class='input-group-prepend'>
                                                  <span style='font-size: 1.5rem;' class='input-group-text'>E-mail</span>
                                                </div>
                                                <input name='email' style='font-size: 1.5rem;' type='text' class='form-control'>
                                                
                                              </div>
                                              <br><br>
                                              <div class='input-group'>
                                                    <div class='input-group-prepend'>
                                                      <span style='font-size: 1.5rem;' class='input-group-text'>Subject</span>
                                                    </div>
                                                    <input name='subject' style='font-size: 1.5rem;' type='text' class='form-control'>
                                                    
                                                  </div>
                                                  <br><br>
                                                </div>
                                                <div class='col-6'>
                                                  <div class='input-group'>
                                                        <div class='input-group-prepend'>
                                                          <span style='font-size: 1.5rem;' class='input-group-text'>Text</span>
                                                        </div>
                                                        <textarea name='content' style='font-size: 1.5rem; height: 9rem' class='form-control' aria-label='With textarea'></textarea>
                                                      </div>
                                                      <br><br>
                                                      <button type='submit' style='font-size:1.5rem; width: 100%;' class='btn btn-primary btn-lg'>SEND</button>
                                                      </div><br><br>
                                                      <div class='mapouter'><div class='gmap_canvas'><iframe width='100%' height='500' id='gmap_canvas' src='https://maps.google.com/maps?q=Sarajevo&t=&z=13&ie=UTF8&iwloc=&output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'></iframe></div><a href='https://www.pureblack.de'></a><style>.mapouter{overflow:hidden;height:500px;width:100%;}.gmap_canvas {background:none!important;height:500px;width:100%;}</style></div>
                                                    <br><br>
                                                    <br><br>
                        </div>
                        </form>
                        
                    <div id='side-bar' class='col-3'>
                            <div id='info_tag'>
                                    <h3>Latest added <i class='fas fa-clock'></i> :</h3>
                                </div>
                                <div class='market-box'>
                                    <img src='css/img/Colleyville-real-estate.jpeg'>
                                    <br>
                                    <br>
                                    <button type='button' class='btn btn-secondary' >House</button>
                                    <button type='button' class='btn btn-info'>Price: 500$</button>
                                    <button type='button' class='btn btn-primary'>Rent</button>
                                    <button type='button' class='btn btn-success'>MORE INFORMATION</button>
                                 </div>
                                 <div class='market-box'>
                                    <img src='css/img/Colleyville-real-estate.jpeg'>
                                    <br>
                                    <br>
                                    <button type='button' class='btn btn-secondary' >House</button>
                                    <button type='button' class='btn btn-info'>Price: 500$</button>
                                    <button type='button' class='btn btn-primary'>Rent</button>
                                    <button type='button' class='btn btn-success'>MORE INFORMATION</button>
                                 </div>
                                 <div class='market-box'>
                                    <img src='css/img/Colleyville-real-estate.jpeg'>
                                    <br>
                                    <br>
                                    <button type='button' class='btn btn-secondary' >House</button>
                                    <button type='button' class='btn btn-info'>Price: 500$</button>
                                    <button type='button' class='btn btn-primary'>Rent</button>
                                    <button type='button' class='btn btn-success'>MORE INFORMATION</button>
                                 </div>
                                 <div align='center'>
                                    <button type='button' style='font-size:1.5rem; width: 100%;' class='btn btn-primary btn-lg'>VIEW ALL</button><br><br>
                                 </div>
                            
                            <div id='info_tag'>
                                    <h3>Top agents <i class='fas fa-address-card'></i> :</h3>
                                </div>
                                    <div class='agents-box'>
                                        <img src='css/img/images.png'><br><br>
                                        <h3 style='text-align: center;'>Samuel Imagino</h3><br><br>
                                        <button type='button' style='font-size:1.5rem; width: 100%;' class='btn btn-primary btn-lg'>CONTACT ME</button>
                                    </div>
                                    <br><br>
                                    <div class='agents-box'>
                                        <img src='css/img/images.png'><br><br>
                                        <h3 style='text-align: center;'>Samuel Imagino</h3><br><br>
                                        <button type='button' style='font-size:1.5rem; width: 100%;' class='btn btn-primary btn-lg'>CONTACT ME</button>
                                    </div><br><br>
                                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main  content section end -->
        <!-- Footer -->
        <br><br><br><br>
        <div id='footer'>
            <div class='content-container' style='width: 80%; margin:auto;'>
                <div class='row'>
                    <div class='col-3'>
                        <h3>Social media</h3>
                        <i class='fab fa-facebook-square fa-3x'></i>
                        <i class='fab fa-twitter-square fa-3x'></i>
                        <i class='fab fa-instagram fa-3x'></i>
                    </div>
                    <div class='col-3'>
                        <h3>Contact Information:</h3>
                        <h4><b>Adress:</b> <i>Dzemala Bijedica 130, Sarajevo, Bosnia and Herzegovina</i></h4>
                    </div>
                    <div class='col-3'>
                        <h4><b>E-mail: </b><i>real.estates@custommail.com</i></h4>
                        <h4><b>Tel/Fax: </b><i>039265458965</i></h4>
                    </div>
                    <div class='col-3'>
                        <button type='button' style='font-size:1.5rem; width: 100%;' class='btn btn-primary btn-lg'>CONTACT US</button><br><br>
                        <button type='button' style='font-size:1.5rem; width: 100%;' class='btn btn-primary btn-lg'>LOG IN</button>
                    </div>
                </div>
                <br><br>
                <h4>All rights reserved. Designed and <i class='fas fa-code'></i> with <i style='color: red;' class='fas fa-heart'></i> by Pixeltron.</h4>
            </div>
        </div>
    
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
      </body>
    </html>
    ";



?>