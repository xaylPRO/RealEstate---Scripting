<?php 
    include_once("connection.php");
    include_once("user_accounts.php");

    class News{

        function __construct(){
            $this->conn = new Connection;
        }

        function display($range, $category){
            if($range == 0 && $category == "*"){
                $query = mysqli_query($this->conn->connect(), "SELECT * FROM news ORDER by id DESC");
                while($row = mysqli_fetch_array($query)){
                    print_r($row);
                }
            }
            else if($range !=0 && $category == "*"){
                $query = mysqli_query($this->conn->connect(), "SELECT * FROM news ORDER by id DESC");
                $counter = 0;
                while($counter < $range){
                    $row = mysqli_fetch_array($query);
                    $titleImage = $row['titleImage'];
                    $title = $row['title'];
                    $content = $row['content'];
                    $timestamp = $row['timestamp'];
                    $id = $row['id'];
                    echo"
                    <div class='news_box'>
                            <div class='row'>
                                <div class='col-4'>
                                    <img src='css/img/Colleyville-real-estate.jpeg'>
                                </div>
                                <div class='col-8'>
                                    <h3>$title</h3>
                                    <p>$content</p>
                                    <p style='font-size: 1.5rem; float: right;' class='card-text'><small class='text-muted'>Added: $timestamp</small></p>
                                </div>
                            </div>
                        </div>";
                    $counter ++;
                }
            }
            else if($range != 0 && $category != "*"){
                $query = mysqli_query($this->conn->connect(), "SELECT * FROM news WHERE category ='$category' ORDER by id DESC");
                $counter = 0;
                while($counter<$range){
                    $row = mysqli_fetch_array($query);
                    print_r($row);
                    $counter ++;
                }
            }

        }

        function add($writerId, $title, $titleImage, $content, $category){
            $users = new User;
            $allowed_users = array();
            $allowed_users = $users -> getSuperUsers();
            foreach($allowed_users as $user){
                if($user == $writerId){
                    $query = mysqli_query($this->conn->connect(), "INSERT INTO news (writerId, title, titleImage, content, category) VALUES ('$writerId', '$title', '$titleImage', '$content', '$category')");
                    if($query) return True;
                    else throw new Exception("We were unable to post your article. Try again.");
                }
            }
            throw new Exception("You're not allowed to make following actions...");
        }

        function delete($currentUserId, $targetArticleId){
            $users = new User;
            $allowed_users = array();
            $allowed_users = $users -> getSuperUsers();
            foreach($allowed_users as $user){
                if($user == $currentUserId){
                    $query = mysqli_query($this->conn->connet(), "DELETE FROM news WHERE id = '$targetArticleId'");
                    if($query) return True;
                    else throw new Exception("We were unable to delete your article. Try again.");
                }
            }
            throw new Exception("You're not allowed to make following actions...");
        }

        function edit($currentUserId, $property, $value, $targetArticleId){
            $users = new User;
            $allowed_users = array();
            $allowed_users = $users -> getSuperUsers();
            foreach($allowed_users as $user){
                if($currentUserId == $user){
                    $query = mysqli_query($this->conn->connect(), "UPDATE news SET $property = $value WHERE id = '$targetId'");
                    if($query) return True;
                    else throw new Exception("We were unable to edit target article. Try again.");
                }
            }
            throw new Exception("You're not allowed to make following actions...");
        }

        function displayBreaking(){
            $query = mysqli_query($this->conn->connect(), "SELECT * FROM news ORDER BY id DESC");
            $row = mysqli_fetch_array($query);
            $titleImage = $row['titleImage'];
                    $title = $row['title'];
                    $content = $row['content'];
                    $timestamp = $row['timestamp'];
                    $id = $row['id'];
                    echo"
                    <div class='card mb-3'>
                                <img style='max-height: 30rem' class='card-img-top' src='css/img/Colleyville-real-estate.jpeg' alt='Card image cap'>
                                <div class='card-body'>
                                  <h5 style='font-size: 1.5rem;' class='card-title'>$title</h5>
                                  <p style='font-size: 1.5rem;' class='card-text'>$content</p>
                                  <p style='font-size: 1.5rem;' class='card-text'><small class='text-muted'>Added: $timestamp</small></p>
                                </div>
                              </div>";
            
        }
    }


    $article = new News;
    try{
        $article->add("1", "Sometitle", "link", "some content", "some category");
    }
    catch(Exception $error){
        echo $error ->getMessage();
    }






?>