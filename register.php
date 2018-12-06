<?php
    session_start();
    include "config.php";
    header('Content-Type:application/json;charset=utf-8');

	if(isset($_POST)){
        $username = $_POST["username"];
        $displayName = $_POST["displayName"];
        $password = $_POST["password"];

        $query = "SELECT * FROM Users WHERE username = '$username'";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);

        if($count == 0){
            $sql = "INSERT INTO Users(username, displayName, password) 
            VALUES('$username', '$displayName', '$password')";
            $create = mysqli_query($koneksi, $sql);

            if($create){
                $query = "SELECT * FROM Users WHERE username = '$username' AND password = '$password'";
                $result = mysqli_query($koneksi, $query);
                $row = mysqli_fetch_assoc($result);
                $count = mysqli_num_rows($result);
                    
                if($count == 1) {
                    $_SESSION['login'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['displayName'] = $row["displayName"];                
                    $_SESSION['id'] = $row["id"];
                    setcookie($_COOKIE['Name'], $_COOKIE['Value']);
                    echo json_encode(array(
                        "id" => $row["id"],
                        "username" => $row["username"],
                        "displayName" => $row["displayName"],
                    ));
                    // echo json_encode($create);
                }
            }
            else{
                echo json_encode(array("message" => mysqli_error($koneksi)));
            }
        } else {
            echo json_encode(array("message" => "Username already exist"));
        }
    }
    mysqli_close($koneksi);
?>