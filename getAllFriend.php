<?php
    include "config.php";
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json;charset=utf-8');
    session_start();

    if(!isset($_SESSION['login'])){
        echo json_encode(array("message" => "unauthorized"));
    } else {
        $userId = $_SESSION["id"];
        $query = "SELECT  Users.id, Users.username, Users.displayName
        FROM Friends JOIN Users ON Friends.friendId = Users.id WHERE Friends.userId = '$userId'";

        $result = mysqli_query($koneksi, $query);
        
        $arr = array();
        while($row = mysqli_fetch_assoc($result)){
            $arr[] = $row;
        }
        echo json_encode($arr);

    }
?>