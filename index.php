<?php 
    
    session_start();

    include_once("assets/user_accounts.php");
    include_once("assets/propertyconfig.php");
    include_once("assets/newsconfig.php");





    $property = new Property;
    $towns = $property -> getTown();
    $number_of_town = count($towns);
    $news = new News;
    $user = new User;

    echo "<!doctype html>
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
        $message = $_SESSION['errormessage'];
        echo"<div align='center'>
        <div class='alert alert-secondary' role='alert'>
        $message
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
                        <div id='nav' class='col-7'>
                            <nav>
                                <ul>
                                    <li><a href='index.php'>Home</a></li>
                                    <li><a href='#'>For rent</a></li>
                                    <li><a href='#'>Buy</a></li> 
                                    <li><a href='#'>Sell</a></li>
                                    <li><a href='#'>About Us</a></li>  
                                    <li><a href='#'>Contact Us</a></li>     
                                </ul>
                            </nav>
                        </div>
                        <!-- NavBar end -->
                        <!-- Sreach div -->";
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
            <!-- Jumbo header div -->
            <div id='jumbo-header'>
                <div class='container'>
                    <div id='search'>
                    <form action='view.php' method='post'>
                    <select class='dropdown' name='location'>";
                        for($i=0; $i<$number_of_town; $i++){
                            $value = $towns[$i];
                        echo"<option value='$value'>$value</option>";
                        }
                    echo"
                    </select>
                    <select name='type_of_building'>
                        <option value='house'>House</option>
                        <option value='flat'>Flat</option>
                        <option value='land'>Free Land</option>
                    </select>
                    <select name='type'>
                        <option value='rent'>Rent</option>
                        <option value='buy'>Buy</option>
                    </select>
                        
                          <br>
                          <br>
                          <h3>Begining Price:</h3>
                          <div class='input-group mb-3'>
                            <div class='input-group-prepend'>
                              <span style='font-size: 1.5rem;' class='input-group-text'>$</span>
                            </div>
                            <input name='begining_price' style='font-size: 1.5rem' type='text' class='form-control' aria-label='Amount (to the nearest dollar)'>
                          </div>
                          <h3>End Price:</h3>
                          <div class='input-group mb-3'>
                            <div class='input-group-prepend'>
                              <span style='font-size: 1.5rem;' class='input-group-text'>$</span>
                            </div>
                            <input name='end_price' style='font-size: 1.5rem;' type='text' class='form-control' aria-label='Amount (to the nearest dollar)'>
                          </div>
                          <div align='right'>
                            <button style='font-size:1.5rem' type='submit' class='btn btn-warning'>Search <i class='fas fa-search'></i></button>
                          </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- Jumbo header div end -->
        </div>
        <!-- Site header end -->
        <!-- Main Content section -->
        <div id='main-content'>
            <div class='content-container' style='width: 80%; margin: auto;'>
    
                <div class='row'>
                    <div class='col-9'>
                        <div id='info_tag'>
                            <h3>News Feed</h3>
                        </div>
                        <!-- Breaking News -->
                        ";
                        $news -> displayBreaking();
                        echo"
                              <!-- Other news -->
                            ";
                            $news -> display(4, "*");
                            echo"
    
                    </div>
                    <div id='side-bar' class='col-3'>
                            <div id='info_tag'>
                                    <h3>Latest added <i class='fas fa-clock'></i> :</h3>
                                </div>";
                                    $property -> displayExtinct(3);
                                echo"
                                 <div align='center'>
                                    <button type='button' style='font-size:1.5rem; width: 100%;' class='btn btn-primary btn-lg'>VIEW ALL</button><br><br>
                                 </div>
                            
                            <div id='info_tag'>
                                    <h3>Top agents <i class='fas fa-address-card'></i> :</h3>
                                </div>
                                    ";
                                $user -> randomUsers(2);
                                    echo"
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
    </html>"





?>