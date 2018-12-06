<?php
    include "config.php";
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json;charset=utf-8');
    session_start();

    // if(!isset($_SESSION['login'])){
    //     echo json_encode(array("message" => "unauthorized"));
    // } else {
        $query = "SELECT Posts.id, Posts.content, Posts.createdAt, Users.displayName
        FROM Posts INNER JOIN Users ON Posts.userId=Users.id";
        $result = mysqli_query($koneksi, $query);
        // $row = mysqli_fetch_assoc($result);
        
        $arr = array();
        while($row = mysqli_fetch_assoc($result)){
            $arr[] = $row;
        }
        echo json_encode($arr);
    // }
?>