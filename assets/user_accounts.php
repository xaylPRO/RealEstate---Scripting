<?php

        include_once("connection.php");
        ini_set('max_execution_time', 300);

        class Login{

            function __construct(){
                $this->conn = new Connection;
            }

            function verify($userid, $password){
                $query = mysqli_query($this->conn->connect(), "SELECT id, pass FROM users WHERE id = '$userid' and pass = '$password'");
                $row = mysqli_fetch_array($query);
                if(!empty($row)){
                    if($row['id'] == $userid && $row['pass'] == $password) return True;
                    else throw new Exception("False user ID or password. Try again.");
                }
                else {
                    return False;
                }
            }
        }

        class CreateAccount {

            function __construct($fifrstName, $lastName, $password, $passwordConfirm, $email){
                $this->conn = new Connection;
                $this->fName = $fifrstName;
                $this->lName = $lastName;
                $this->password = $password;
                $this->passwordConfirm = $passwordConfirm;
                $this->email = $email;
            }

            function usernameExists(){
                $query = mysqli_query($this->conn->connect(), "SELECT username FROM users");
                $usernames = array();
                while($row = mysqli_fetch_array($query)) array_push($usernames, $row['username']);
                if(!empty($usernames)){
                    foreach($usernames as $username){
                        if($this->username == $username){
                            return True;
                        }

                    }
                }
                return False;
            }

            function emailExists(){
                $query = mysqli_query($this->conn->connect(), "SELECT email FROM users");
                $emails = array();
                while($row = mysqli_fetch_array($query)) array_push($emails, $row['email']);
                if(!empty($emails)){
                    foreach($emails as $email){
                        
                        if($this->email == $email) return True;
                    }
                }
                return False;
            }

            function create(){
                if(!empty($this->fName) && !empty($this->lName) && !empty($this->password) && !empty($this->passwordConfirm) && !empty($this->email)){
                    if($this->password == $this->passwordConfirm){
                        $validation = new CreateAccount($this->fName, $this->lName, $this->password, $this->passwordConfirm, $this->email);
                        if(!$validation->emailExists()){
                            $fName = $this->fName;
                            $lName = $this->lName;
                            $password = $this->password;
                            $email = $this->email;
                            $query = mysqli_query($this->conn->connect(), "INSERT INTO users (firstName, lastName, pass, email) VALUES ('$fName', '$lName', '$password', '$email')");
                            if($query)  return True;
                            else return False;
                        }
                        else throw new Exception("E-mail alredy in use.");
                    }
                    else throw new Exception("Passwords doesn't match. Try again.");
                }
                else throw new Exception("All fields are required. Try again.");
            }
        }

        class User{

            function __construct(){
                $this->conn = new Connection;
                $this->existing_keys = array();

                $query = mysqli_query($this->conn->connect(), "SELECT * FROM verification_keys");
                while($row = mysqli_fetch_array($query)){
                    array_push($this->existing_keys, $row['v_key']);
                }
            }

            function ifExists($value){
                foreach($this->existing_keys as $key){
                    if($key == $value) return False;
                }
                return True;

            }

            function generateKey(){
                $key = "";
                    for($i = 0; $i<4; $i++){
                        $a = rand(0,9);
                        $a = strval($a);
                        $key .= $a;
                    }
                return $key;
            }

            function addKeys(){
                $counter = 0;
                $to_add = array();
                $key = $this->generateKey();
                while(!$this->ifExists($key)){
                    echo $key;
                    $key = $this->generateKey();
                    
                }
                $query = mysqli_query($this->conn->connect(), "INSERT INTO verification_keys (v_key) VALUES ('$key')");
                if($query) return True;
                else throw new Exception("The server was unable to generate a new key. Try again.");
            }

            function getfName($userId){
                $query = mysqli_query($this->conn->connect(), "SELECT firstName FROM users WHERE id = '$userId'");
                
                if($query){
                    $row = mysqli_fetch_array($query);
                    $firstName = $row['firstName'];
                    return $firstName;
                }
                else throw new Exception("User doesn't exists.");
            }

            function getSuperUsers(){
                $query = mysqli_query($this->conn->connect(), "SELECT id FROM users WHERE status = 'admin'");
                $admin_users = array();
                if($query){
                    while($row = mysqli_fetch_array($query)){
                        array_push($admin_users, $row['id']);
                    }
                    return $admin_users;
                }
                else throw new Exception("No admin users.");
            }

            function getProperty($userId, $password, $target_id, $property){
                $login = new Login;
                $current_user_id = $userId;
                $allowedUsers = $this->getSuperUsers();
                $properties = ["firstName", "lastName", "email", "town", "profileImage", "sex", "country", "status"];
                if($current_user_id == $target_id) array_push($allowedUsers, $current_user_id);
                foreach($properties as $p){
                    if($p == $property){
                        $query = mysqli_query($this->conn->connect(), "SELECT $property FROM users WHERE id = '$target_id'");
                        if($query){
                            $row = mysqli_fetch_array($query);
                            return $row[$property];
                        }
                        else throw new Exception("No results about requested property.");
                    }
                }
                throw new Exception("Property doesn't exists or you are not allowed to see requested property.");
            }

            function changeProperty($userid, $password, $target_id, $property, $value){
                $allowedUsers = array();
                $allowedUsers = $this->getSuperUsers();
                $login = new Login;
                $state = False;
                $properties = ["firstName", "lastName", "email", "town", "profileImage", "sex", "country", "status"];
                if($login->verify($userid, $password)){
                    if($userid == $target_id) array_push($allowedUsers, $userid);
                    foreach($properties as $p){
                        if($property == $p){
                            $state = True;
                            break;
                        }
                    }
                    foreach($allowedUsers as $id){
                        if($id == $target_id){
                            if($state){
                                $query = mysqli_query($this->conn->connect(), "UPDATE users SET $property = '$value' WHERE id = '$userid'");
                                if($query) return True;
                                else throw new Exception("The server was unable to make requested changes. Try again.");
                            }
                            else throw new Exception("Requeted property doesn't exists or you're not allowed to make any changes.");
                        }
                    }
                    throw new Exception("You are not allowed to make changes to that property.");
                }
                throw new Exception("You have to login first.");

            }

            function numberOfUsers(){
                $query = mysqli_query($this->conn->connect(), "SELECT * FROM users");
                $counter = 0;
                while($row = mysqli_fetch_array($query)){
                    $counter++;
                }
                return $counter;
            }

            function randomUsers($numberOfUsers){
                $query = mysqli_query($this->conn->connect(), "SELECT * FROM users");
                $randomIds = array();
                $counter = 0;
                for($i = 0; $i < $numberOfUsers; $i++){
                    array_push($randomIds, rand(0, $this->numberOfUsers()));
                }
                while($row = mysqli_fetch_array($query)){
                    if($counter < $numberOfUsers){
                        foreach($randomIds as $id){
                            if($row['id'] == $id){
                                $firstName = $row['firstName'];
                                $lastName = $row['lastName'];
                                $id = $row['id'];
                                $profileImage = $row['profileImage'];
                                echo"
                                <div class='agents-box'>
                                        <img src='$profileImage'><br><br>
                                        <h3 style='text-align: center;'>$firstName $lastName</h3><br><br>
                                        <a href='contactUs.php?targetId=$id'><button type='button' style='font-size:1.5rem; width: 100%;' class='btn btn-primary btn-lg'>CONTACT ME</button></a>
                                    </div><br><br>
                                ";
                                $counter ++;
                            }
                        }
                    }
                    else return True;
                }
                return True;
            }

        }

       
       
    
        

        
?>
