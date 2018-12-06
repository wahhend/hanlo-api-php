<?php
    include "config.php";
    header('Content-Type:application/json;charset=utf-8');
    session_start();

    if(!isset($_SESSION['login'])){
        echo json_encode(array("error" => "unauthorized"));
    } else {
        if(isset($_POST)){
            $userId = $_SESSION["id"];
            $username = $_POST["username"];
            $query = "SELECT id FROM Users WHERE username = '$username'";
            $result = mysqli_query($koneksi, $query);
            $friendId = mysqli_fetch_assoc($result)['id'];

            if($userId == $friendId){
                echo json_encode(array("message" => "You can't add yourself as friend"));
                return;
            }

            $query = "SELECT * FROM Friends WHERE userId = '$userId' AND friendId = '$friendId'";
            $result = mysqli_query($koneksi, $query);
            $row = mysqli_fetch_assoc($result);
            $count = mysqli_num_rows($result);

            if($count == 0){
                $query = "SELECT * FROM Users WHERE id = '$friendId'";
                $result = mysqli_query($koneksi, $query);
                $row = mysqli_fetch_assoc($result);
                $count = mysqli_num_rows($result);
                
                if($count == 1){
                    $query = "INSERT INTO Friends(userId, friendId) VALUES ('$userId', '$friendId')";
                    $create = mysqli_query($koneksi, $query);
                    
                    if($create){
                        $query = "SELECT * FROM Friends WHERE userId = '$userId' AND friendId = '$friendId'";
                        $result = mysqli_query($koneksi, $query);
                        $row = mysqli_fetch_assoc($result);
                        $count = mysqli_num_rows($result);
                            
                        if($count == 1) {
                            echo json_encode(array("message" => "Succesfull add friend"));
                        }
                        
                    } else {
                        echo json_encode(array("message" => mysqli_error($koneksi)));
                    }
                } else {
                    echo json_encode(array("message" => "No user with that username"));
                }
            }else{
                echo json_encode(array("message" => "User is already your friend"));
            }            
        }
    }
?>