<?php 

    session_start();
    include_once("assets/propertyconfig.php");

    if(isset($_GET['property_id'])){

        $property = new Property;

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
    <link href='css/view-layout.css' rel='stylesheet' type='text/css'>

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
                    <!-- Srach div -->";
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
    <br><br>
    <!-- Main Content section -->
    <div id='main-content'>
        <div class='content-container' style='width: 80%; margin: auto;'>

            <div class='row'>
                <div class='col-9'>
                ";

                $property -> displayById($_GET['property_id']);

                echo"

                </div>
                <div id='side-bar' class='col-3'>
                        <div id='info_tag'>
                                <h3>Filter results <i class='fas fa-filter'></i> :</h3>
                        </div>
                                <div class='dropdown' style='min-width: 100%;'>
                                        <button style='min-width: 100%; font-size: 1.5rem;' class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                          Type
                                        </button>
                                        <div style='font-size: 1.5rem;' class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                          <a class='dropdown-item' href='#'>Action</a>
                                          <a class='dropdown-item' href='#'>Another action</a>
                                          <a class='dropdown-item' href='#'>Something else here</a>
                                        </div>
                                      </div>
                                    <br><br>
                                <div class='dropdown' style='min-width: 100%;'>
                                    <button style='min-width: 100%; font-size: 1.5rem;' class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            Town
                                            </button>
                                            <div style='font-size: 1.5rem;' class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                              <a class='dropdown-item' href='#'>Action</a>
                                              <a class='dropdown-item' href='#'>Another action</a>
                                              <a class='dropdown-item' href='#'>Something else here</a>
                                            </div>
                                          </div>
                                        <br><br>
                                        <div class='dropdown' style='min-width: 100%;'>
                                                <button style='min-width: 100%; font-size: 1.5rem;' class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        Buy/Rent
                                                        </button>
                                                        <div style='font-size: 1.5rem;' class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                          <a class='dropdown-item' href='#'>Action</a>
                                                          <a class='dropdown-item' href='#'>Another action</a>
                                                          <a class='dropdown-item' href='#'>Something else here</a>
                                                        </div>
                                                      </div>
                                                    <br><br>
                                        <div class='row'>
                                            <div class='col-6'>
                                                <h4>Starting price:</h4>
                                                <div class='input-group mb-3'>
                                                        <div class='input-group-prepend'>
                                                          <span style='font-size: 1.5rem;' class='input-group-text'>$</span>
                                                        </div>
                                                        <input style='font-size: 1.5rem' type='text' class='form-control' aria-label='Amount (to the nearest dollar)'>
                                                      </div>
                                            </div>
                                            <div class='col-6'>
                                                <h4>End price:</h4>
                                                <div class='input-group mb-3'>
                                                        <div class='input-group-prepend'>
                                                          <span style='font-size: 1.5rem;' class='input-group-text'>$</span>
                                                        </div>
                                                        <input style='font-size: 1.5rem' type='text' class='form-control' aria-label='Amount (to the nearest dollar)'>
                                                      </div>
                        
                                            </div>
                                        </div>
                                        <div class='row'>
                                                <div class='col-6'>
                                                    <h4>Bathrooms:</h4>
                                                </div>
                                                <div class='col-6'>
                                                          <div class='dropdown' style='min-width: 100%;'>
                                                                <button style='min-width: 100%; font-size: 1.5rem;' class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        0
                                                                        </button>
                                                                        <div style='font-size: 1.5rem;' class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                                          <a class='dropdown-item' href='#'>Action</a>
                                                                          <a class='dropdown-item' href='#'>Another action</a>
                                                                          <a class='dropdown-item' href='#'>Something else here</a>
                                                                        </div>
                                                                      </div>
                                                                    <br><br>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                    <div class='col-6'>
                                                        <h4>Floors:</h4>
                                                    </div>
                                                    <div class='col-6'>
                                                              <div class='dropdown' style='min-width: 100%;'>
                                                                    <button style='min-width: 100%; font-size: 1.5rem;' class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                            0
                                                                            </button>
                                                                            <div style='font-size: 1.5rem;' class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                                              <a class='dropdown-item' href='#'>Action</a>
                                                                              <a class='dropdown-item' href='#'>Another action</a>
                                                                              <a class='dropdown-item' href='#'>Something else here</a>
                                                                            </div>
                                                                          </div>
                                                                        <br><br>
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                        <div class='col-6'>
                                                            <h4>From:</h4>
                                                            <div class='input-group mb-3'>
                                                                    <div class='input-group-prepend'>
                                                                      <span style='font-size: 1.5rem;' class='input-group-text'>m2</span>
                                                                    </div>
                                                                    <input style='font-size: 1.5rem' type='text' class='form-control' aria-label='Amount (to the nearest dollar)'>
                                                                  </div>
                                                        </div>
                                                        <div class='col-6'>
                                                            <h4>To:</h4>
                                                            <div class='input-group mb-3'>
                                                                    <div class='input-group-prepend'>
                                                                      <span style='font-size: 1.5rem;' class='input-group-text'>m2</span>
                                                                    </div>
                                                                    <input style='font-size: 1.5rem' type='text' class='form-control' aria-label='Amount (to the nearest dollar)'>
                                                                  </div>
                                    
                                                        </div>
                                                    </div>
                                                    <button type='button' style='font-size:1.5rem; width: 100%;' class='btn btn-primary btn-lg'>FIND <i class='fas fa-search'></i></button><br><br>
        
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
                } else header("index.php");






?>