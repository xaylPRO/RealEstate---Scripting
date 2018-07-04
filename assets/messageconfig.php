<?php 

    include_once("connection.php");
    include_once("user_accounts.php");

    class Message {
        function __construct(){
            $this->conn = new Connection;
            $this->verifyUser = new Login;
            $this->user = new User;
            $this->allowed_users = $this->user->getSuperUsers();
        }

        function displayMessages($userid, $password){
            if($this->verifyUser->verify($userid, $password)){
                $query = mysqli_query($this->conn->connect(), "SELECT * FROM messages WHERE reciverid = '$userid'");
                if($query){
                    while($row = mysqli_fetch_array($query)){
                        $subject = $row['messageSubject'];
                        $status = $row['status'];
                        $id = $row['id'];
                        if($status == 'read'){
                            echo"<a href='viewmessage.php?id=$id'><p>$subject<b></p></a>";
                        }
                        else if($status = 'unread') echo "<a href='viewmessage.php?id=$id'><p>$subject<i style='color: gold'>(new)</i></p></a>";
                    }
                }
                else return False;
            }
            else throw new Exception("You have to be logged in for any future actions. Try again...");
        }

        function create($firstName, $lastName, $email, $subject, $message, $reciverid){
            if(isset($firstName) && isset($lastName) && isset($email) && isset($subject) && isset($message)){
                echo $reciverid;
                $query = mysqli_query($this->conn->connect(), "INSERT INTO messages (firstName, lastName, email, messageSubject, content, reciverid) VALUES ('$firstName', '$lastName', '$email', '$subject', '$message', '$reciverid')");
                if($query) return True;
                else throw new Exception("error: ".mysqli_error($this->conn->connect()));
            }
            else throw new Exception("All fileds are required. Please try again.");
        }

        function delete($targetid, $userid, $password){
            $query = mysqli_query($this->conn->connect(), "SELECT * FROM messages WHERE id = '$targetid'");
            if($this->verifyUser->verify($userid, $password)){
                if($query){
                    $row = mysqli_fetch_array($query);
                    if($row['userid'] == $userid){
                        array_push($this->allowed_users, $userid);
                    }
                    foreach($this->allowed_users as $user){
                        if($userid == $user){
                            $recipentId = $row['userid'];
                            $firstName = $row['firstName'];
                            $lastName = $row['lastName'];
                            $email = $row['email'];
                            $subject = $row['subject'];
                            $message = $row['message'];
                            $moveQuery = mysqli_query($this->conn->connect(), "INSERT INTO deleted userid, deleted_by, firstName, lastName, email, subject, message) VALUES ('$recipentId', '$userid', '$firstName', '$lastName', '$email', '$email', '$subject', '$message')");
                            if($moveQuery){
                                $deleteQuery = mysqli_query($this->conn->connct(), "DELETE FROM messages WHERE id='$targetid'");
                                if($deleteQuery) return TRUE;
                                throw new Exception("Uknown error occured. The server was unable to delete the requested message.");
                            }
                            else throw new Exception("Uknown error occured. The server was unable to delete the requested message.");
                        }
                    }
                    throw new Exception("You're not allowed to delete the requested message.");
                }
                else throw new Exception("Requested message doesn't exists...");
            }
            else throw new Exception("You have to be logged in for any future actions. Please try again...");
        }
        function displayById($id){
            $query = mysqli_query($this->conn->connect(), "SELECT * FROM messages WHERE id = '$id'");
            $row = mysqli_fetch_array($query);
            $subject = $row['messageSubject'];
            $email = $row['email'];
            $content = $row['content'];
            $fName = $row['firstName'];
            $lName = $row['lastName'];
            echo"
                <h3>From: $fName $lName <$email></h3>
                <h4>Subject: $subject</h4>
                <p>$content</p>
            ";
            $alterQuery = mysqli_query($this->conn->connect(), "UPDATE messages SET status ='read' WHERE id ='$id'");
        }

        function ifUnread($userId){
            $query = mysqli_query($this->conn->connect(), "SELECT * FROM messages WHERE reciverid = '$userId'");
            while($row = mysqli_fetch_array($query)){
                if($row['status'] == 'unread'){
                    return True;
                }
            }
            return False;
        }

    }











?>