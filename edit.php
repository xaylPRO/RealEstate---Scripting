<?php 


    session_start();

    include_once("assets/propertyconfig.php");

    if(isset($_SESSION['userid']) && isset($_SESSION['password'])){
        if(isset($_GET['id'])){
            $propertyId = $_GET['id'];
            $property = new Property;
            $title = $property -> get($propertyId, 'title');
            $country = $property -> get($propertyId, 'country');
            $town = $property -> get($propertyId, 'town');
            $location = $property -> get($propertyId, 'location');
            $type = $property -> get($propertyId, 'type');
            $type_of_building = $property -> get($propertyId, 'type_of_building');
            $price = $property -> get($propertyId, 'price');
            $size = $property -> get($propertyId, 'size');
            $accessories = $property -> get($propertyId, 'accessories');
            $description = $property -> get($propertyId, 'description');
            $titleImage = $property -> get($propertyId, 'titleImage');
            $gallery = $property -> get($propertyId, 'gallery');
            $properties = ['username', 'password', 'title', 'country', 'town', 'location', 'type', 'type_of_building', 'price', 'size', 'accessories', 'description', 'titleImage', 'gallery'];
            if(isset($_POST['edit']) && $_POST['edit'] == True){
                for($i=0; $i<12; $i++){
                    if(isset($_POST[$properties[$i]])){
                        $property -> editProperty($_SESSION['userid'], $_SESSION['password'], $propertyId, $properties[$i], $_POST[$properties[$i]]);
                        header("Location: manage.php");
                    }
                }
            }
            
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
        
            
             <title>Real Estate | Edit</title>
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
                                
                            <form  action='edit.php?id=$propertyId' method='post'>
                                <div style='float: left;' class='col-7'>
                                        <div id='info_tag'>
                                                <h4>Edit selected property</h4>
                                        </div>
                                    <p class='property_label'>Title</p><br>
                                    <input class='property_input' type='text' name='title' value='$title'><br>
                                    <p class='property_label'>Country</p><br>
                                    <select class='property_input' name='country'>
                                            <option value='$country'>$country</option>
                                            <option value='saab'>Serbia</option>
                                            <option value='mercedes'>Croatia</option>
                                            <option value='audi'>Montenegro</option>
                                     </select><br><br>
                                    <p class='property_label'>Or, add new country</p>
                                    <input class='property_input'  type='text' name='new_country'><br>
                                    <p class='property_label'>Town</p><br>
                                    <input class='property_input' type='text' name='town' value='$town'><br>
                                    <p class='property_label'>Adress</p><br>
                                    <input class='property_input' type='text' name='location' value='$location'><br>
                                    <p class='property_label'>Price</p><br>
                                    <input class='property_input' type='text' name='price' placeholder='$$' value='$price'><br>
                                    <p class='property_label'>Size</p><br>
                                    <input class='property_input' type='text' name='size' placeholder='m2' value='$size'><br>
                                    <p class='property_label'>Type of property:</p><br>
                                    <input class='property_input' type='text' name='type_of_building' placeholder='House/Apartmant/Land...' value='$type_of_building'><br>";
                                    
                                    if($type == 'Sell')echo"
                                    <input type='radio' name='type' value='Sell' checked> Sell<br>
                                    <input type='radio' name='type' value='Rent'> Rent<br>
                                    ";
                                    else if($type == 'Rent')echo"
                                    <input type='radio' name='type' value='Sell'> Sell<br>
                                    <input type='radio' name='type' value='Rent' checked> Rent<br>
                                    ";
                                    echo"
                                    <p class='property_label'>Accessories(seperate with ';')</p><br>
                                    <input class='property_input' type='text' name='accessories' placeholder='...2 bathrroms;internet;balcony;' value='$accessories'><br>
        
                                </div>
                                <div style='float: left;' class='col-5'>
                                        <br><br><br><br>
                                        <p class='property_label'>Description</p><br>
                                        <textarea style='height:10rem;' class='property_input'>$description</textarea>
                                        <p class='property_label'>Title Image:</p><br>
                                        <input class='property_input' type='file' name='titleImage' accept='image/*'>
                                        <p class='property_label'>Gallery(Up to 5 Images):</p><br>
                                        <input class='property_input' type='file' name='picOne' accept='image/*'><br><br>
                                        <input class='property_input' type='file' name='picTwo' accept='image/*'><br><br>
                                        <input class='property_input' type='file' name='picThree' accept='image/*'><br><br>
                                        <input class='property_input' type='file' name='picFour' accept='image/*'><br><br>
                                        <input class='property_input' type='file' name='picFive' accept='image/*'><br><br>
                                        <input class='property_input' type='hidden' name='edit' value='true'><br><br>
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
        </html>
        ";
    }
    else {
        $_SESSION['errormessage'] = "Property with target ID doesn't exists. Try again...";
        header("Location: manage.php");
    }
}





?>