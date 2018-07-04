<?php 

    include_once("connection.php");
    include_once("user_accounts.php");

    class Property{

        function __construct(){
            $this->conn = new Connection;
            $this->allowed_users = array();
            $this->user = new User;
            $this->allowed_users = $this->user->getSuperUsers();
            $this->verifyUser = new Login;
        }

        function addProperty($username, $password, $title, $country, $town, $location, $type, $type_of_building, $price, $size, $accessories, $description, $titleImage, $gallery){
            if($this->verifyUser->verify($username, $password)){
                foreach($this->allowed_users as $temp_user){
                    if($username == $temp_user){
                        $query = mysqli_query($this->conn->connect(), "INSERT INTO properties (title, country, town, location, type, type_of_building, price, size, accessories, description, titleImage, gallery) VALUES ('$title', '$country', '$town', '$location', '$type', '$type_of_building', '$price', '$size', '$accessories', '$description', '$titleImage', '$gallery')");
                        if($query) return True;
                        else throw new Exception("The server was unable to add your property. Try again later.");
                    }
                }
                throw new Exception("You're not allowed to complete any of following actions.");
            }
            else throw new Exception("You have to log into your account.");
        }

        function editProperty($username, $password, $targetId, $property, $value){
            $properties = ['username', 'password', 'title', 'country', 'town', 'location', 'type', 'type_of_building', 'price', 'size', 'accessories', 'description', 'titleImage', 'gallery'];
            if($this->verifyUser->verify($username, $password)){
                foreach($this->allowed_users as $user){
                    if($username == $user){
                        foreach($properties as $temp_property){
                            if($temp_property == $property){
                                $query = mysqli_query($this->conn->connect(), "UPDATE properties SET $property = '$value' WHERE id = '$targetId'");
                                if($query) return True;
                                else throw new Exception("The server was unable to change requested property. Try again later.");
                            }
                        }
                        throw new Exception("Requested property doesn't exists. Try again.");
                    }
                }
                throw new Exception("You're not allowed to complete any of following actions.");
            }
            else throw new Exception("You have to log into your account.");
        }

        function deleteProperty($username, $password, $targetId){
            $properties = ['propertyName', 'price', 'propertylocation', 'adress', 'size', 'description', 'features'];
            if($this->verifyUser->verify($username, $password)){
                foreach($properties as $temp_property){
                    if($property == $temp_property){
                        $query = mysqli_query($this->conn->connect(), "DELETE FROM properties WHERE id = '$targetId'");
                        if($query) return True;
                        else throw new Exception("The server was unable to delete requested item. Try again later.");
                    }
                }
                throw new Exception("Requested property doesn't exists. Try again.");
            }
            else throw new Exception("You have first to log into your account.");
        }

        function get($targetId, $property){
            $properties = ['username', 'password', 'title', 'country', 'town', 'location', 'type', 'type_of_building', 'price', 'size', 'accessories', 'description', 'titleImage', 'gallery'];
            foreach($properties as $p){
                if($p == $property){
                    $query = mysqli_query($this->conn->connect(), "SELECT $property FROM properties WHERE id = '$targetId'");
                    $row = mysqli_fetch_array($query);
                    return $row[$property];
                }
            }
            throw new Exception("Requeted property doesn't exists. Try again...");
        }

        function getTown(){
            $query = mysqli_query($this->conn->connect(), "SELECT DISTINCT town FROM properties");
            $list = array();
            while($row = mysqli_fetch_array($query)){
                array_push($list, $row['town']);
            }
            return $list;
        }

        function displayExtinct($range){
            $query = mysqli_query($this->conn->connect(), "SELECT * FROM properties ORDER BY id DESC");
            for($i=0; $i<$range; $i++){
                $row = mysqli_fetch_array($query);
                $price = $row['price'];
                $type_of_building = $row['type_of_building'];
                $type = $row['type'];
                $id = $row['id'];
                $img = $row['titleImage'];
                echo"
                <div class='market-box'>
                <img src='$img'>
                <br>
                <br>
                <button type='button' class='btn btn-secondary' >$type_of_building</button>
                <button type='button' class='btn btn-info'>Price: $price$</button>
                <button type='button' class='btn btn-primary'>$type</button>
                <button type='button' class='btn btn-success'>MORE INFORMATION</button>
             </div>
                ";
            }
        }

        function display($displayRange, $beginingPrice, $endPrice, $startSize, $endSize, $location, $type_of_building, $type){
            $query = mysqli_query($this->conn->connect(), "SELECT * FROM properties ORDER BY id DESC");
            $candidates = array();


            while($row = mysqli_fetch_array($query)){
                $b_price = $e_price = $s_size = $e_size = $locationValue = $typeOfValue = $typeValue = False;
                if($beginingPrice != "*"){
                    if(floatval($beginingPrice) <= floatval($row['price'])) $b_price = True;
                } else $b_price = True;
                
                if($endPrice != "*"){
                    if(floatval($endPrice) >= floatval($row['price'])) $e_price = True;
                } else $e_price = True;

                if($startSize != "-"){
                    if(floatval($startSize) <= floatval($row['size'])) $s_size = True;
                } else $s_size = True;

                if($endSize != "-"){
                    if(floatval($endSize) >= floatval($row['size'])) $e_size = True;
                } else $e_size = True;

                if($location != "-"){
                    if($location == $row['location']) $locationValue = True;
                } else $locationValue = True;

                if($endPrice != "-"){
                    if(floatval($endPrice) >= floatval($row['price'])) $e_price = True;
                } else $e_price = True;

                if($type_of_building != "-"){
                    if($type_of_building == $row['type_of_building']) $typeOfValue = True;
                } else $typeOfValue = True;

                if($type != "-"){
                    if($type == $row['type']) $typeValue = True;
                } else $typeValue = True;

                if($b_price && $e_price && $s_size && $e_size && $locationValue && $typeOfValue && $typeValue) {
                    array_push($candidates, $row['id']);
                }
            }
            if($displayRange == 0){
                foreach($candidates as $id){
                    $query = mysqli_query($this->conn->connect(), "SELECT * FROM properties WHERE id = '$id'");
                    
                    $price = $row['price'];
                    $type = $row['type'];
                    $type_of_building = $row['type_of_building'];
                    $title = $row['title'];
                    $description = $row['$description'];
                    $titleImage = $row['titleImage'];
                    $timestamp = $row['timestamp'];

                    echo"
                    <div class='news_box'>
                        <div class='row'>
                            <div class='col-4'>
                                <img src='css/img/Colleyville-real-estate.jpeg'>
                            </div>
                            <div class='col-8'>
                                    <button type='button' class='btn btn-secondary' >$type_of_building</button>
                                    <button type='button' class='btn btn-info'>Price: $price$</button>
                                    <button type='button' class='btn btn-primary'>$type</button>
                                    <br>
                                    <h3>$title</h3>
                                <p>$description</p>
                                <p style='font-size: 1.5rem; float: right;' class='card-text'><small class='text-muted'>Added: $timestamp</small></p>
                            </div>
                        </div>
                    </div>";
                }
        }
        else if($displayRange != "0"){
            for($i=0; $i<$displayRange; $i++){
                $id = $candidates[$i];
                $query = mysqli_query($this->conn->connect(), "SELECT * FROM properties WHERE id = '$id'");
                    
                    $price = $row['price'];
                    $type = $row['type'];
                    $type_of_building = $row['type_of_building'];
                    $title = $row['title'];
                    $description = $row['$description'];
                    $titleImage = $row['titleImage'];
                    $timestamp = $row['timestamp'];

                    echo"
                    <div class='news_box'>
                        <div class='row'>
                            <div class='col-4'>
                                <img src='css/img/Colleyville-real-estate.jpeg'>
                            </div>
                            <div class='col-8'>
                                    <button type='button' class='btn btn-secondary' >$type_of_building</button>
                                    <button type='button' class='btn btn-info'>Price: $price$</button>
                                    <button type='button' class='btn btn-primary'>$type</button>
                                    <br>
                                    <h3>$title</h3>
                                <p>$description</p>
                                <p style='font-size: 1.5rem; float: right;' class='card-text'><small class='text-muted'>Added: $timestamp</small></p>
                            </div>
                        </div>
                    </div>";
            }
        }



    }

    function displayById($id){
        $query = mysqli_query($this->conn->connect(), "SELECT * FROM properties WHERE id ='$id'");
        $row = mysqli_fetch_array($query);
        $title = $row['title'];
        $type_of_building = $row['type_of_building'];
        $titleImage = $row['titleImage'];
        $price = $row['price'];
        $type = $row['type'];
        $location = $row['location'];
        $description = $row['description'];
        $accessories = $row['accessories'];
        $extras = explode(";", $accessories);
        echo"
        <div id='info_tag'>
                        <h3>$title</h3>
                    </div>
                    <div class='news_box'>
                        <div class='row'>
                            <div class='col-4'>
                                <img src='$titleImage'>
                            </div>
                            <div class='col-8'>
                                    <button type='button' class='btn btn-secondary' >$type_of_building</button>
                                    <button type='button' class='btn btn-info'>Price: $price$</button>
                                    <button type='button' class='btn btn-primary'>$type</button>
                                    <button type='button' class='btn btn-info'>Location: $location</button>
                                    <br>
                                    <h3>$title</h3>
                                <p>$description</p>
                                <h3>Some extras:</h3>
                                <ul style='list-style-type: none; color: blue;'>";
                                    foreach($extras as $e){
                                        echo"<li><i class='fas fa-angle-double-right'></i>  $e;</li>";
                                    }
                                    echo"
                                </ul>
                                <p style='font-size: 1.5rem; float: right;' class='card-text'><small class='text-muted'>Added: 22.05.2018.</small></p>
                            </div>
                        </div>
                    </div>
        ";
    }
}




?>