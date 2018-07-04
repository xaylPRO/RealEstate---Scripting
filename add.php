<?php 
    session_start();

    include_once("assets/propertyconfig.php");

    if(isset($_SESSION['userid']) && isset($_SESSION['password'])){
        echo "<!doctype html>
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
                <div id='admin_maincontent' class='col-10'>
                        <div class='row'>
                                
                            <form action='add.php' method='post' enctype='multipart/form-data'>
                                <div style='float: left;' class='col-7'>
                                        <div id='info_tag'>
                                                <h4>Add new property</h4>
                                        </div>
                                    <p class='property_label'>Title</p><br>
                                    <input class='property_input' type='text' name='title'><br>
                                    <p class='property_label'>Country</p><br>
                                    <select class='property_input' name='country'>
                                            <option value='volvo'>Bosnia and Herzegovina</option>
                                            <option value='saab'>Serbia</option>
                                            <option value='mercedes'>Croatia</option>
                                            <option value='audi'>Montenegro</option>
                                     </select><br><br>
                                    <p class='property_label'>Or, add new country</p>
                                    <input class='property_input'  type='text' name='new_country'><br>
                                    <p class='property_label'>Town</p><br>
                                    <input class='property_input' type='text' name='town'><br>
                                    <p class='property_label'>Adress</p><br>
                                    <input class='property_input' type='text' name='location'><br>
                                    <p class='property_label'>Price</p><br>
                                    <input class='property_input' type='text' name='price' placeholder='$$'><br>
                                    <p class='property_label'>Size</p><br>
                                    <input class='property_input' type='text' name='size' placeholder='m2'><br>
                                    <p class='property_label'>Type of property:</p><br>
                                    <input class='property_input' type='text' name='type_of_building' placeholder='House/Apartmant/Land...'><br>
                                    <input type='radio' name='type' value='Sell'> Sell<br>
                                    <input type='radio' name='type' value='Rent'> Rent<br>
                                    <p class='property_label'>Accessories(seperate with ';')</p><br>
                                    <input class='property_input' type='text' name='accessories' placeholder='...2 bathrroms;internet;balcony;'><br>
        
                                </div>
                                <div style='float: left;' class='col-5'>
                                        <br><br><br><br>
                                        <p class='property_label'>Description</p><br>
                                        <textarea name='description' style='height:10rem;' class='property_input'></textarea>
                                        <p class='property_label'>Title Image:</p><br>
                                        <input class='property_input' type='file' name='titleImage' id='titleImage' accept='image/*'>
                                        <p class='property_label'>Gallery(Up to 5 Images):</p><br>
                                        <input class='property_input' type='file' name='picOne' id='picOne' accept='image/*'>
                                        <input class='property_input' type='file' name='picTwo' id='picTwo' accept='image/*'>
                                        <input class='property_input' type='file' name='picThree' id='picThree' accept='image/*'>
                                        <input class='property_input' type='file' name='picFour' id='picFour' accept='image/*'>
                                        <input class='property_input' type='file' name='picFive' id='picFive' accept='image/*'>
                                        <input class='property_input' type='hidden' name='addProperty' value='true'><br><br>
                                        <button type='submit' class='btn btn-success'>Add <i class='fas fa-plus'></i></button>
                                </div>
                            </form>
                        </div>
                <!-- Admin maincontent end -->
            </div>
        
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
            <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
          </body>
        </html>";
        if(isset($_POST['addProperty']) && $_POST['addProperty'] == true){
            #Picture upload: 
            $index = ['titleImage', 'picOne', 'picTwo', 'picThree', 'picFour', 'picFive'];
            $counter = 0;
            $gallery;
            while($counter <= 5){
                $name = $index[$counter];
                $target_dir = "propertyIMG/";
                $target_file = $target_dir . basename($_FILES[$name]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                
                move_uploaded_file($_FILES[$name]["tmp_name"], $target_file);



                if($counter == 0) $titleImage = 'propertyIMG/'.basename($_FILES[$name]["name"]);
                else $gallery .= "propertyIMG/".basename($_FILES[$name]["name"]).";";

                $counter ++;
            }
            
            # Creating database record:
            $property = new Property;
            try{
                $property -> addProperty($_SESSION['userid'], $_SESSION['password'], $_POST['title'], $_POST['country'], $_POST['town'], $_POST['location'], $_POST['type'], $_POST['type_of_building'],  $_POST['price'], $_POST['size'], $_POST['accessories'], $_POST['description'], $titleImage, $gallery);
            }
            catch(Exception $error){
                $_SESSION['errormessage'] = $error -> getMessage();
                header("Location: dashboard.php");
            }
        }
    }
    else { 
        $_SESSION['errormessage'] = "You have to be logged in for any future actions.";
        header("Location: login.php");
    }



?>