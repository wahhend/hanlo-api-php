<?php
    include "config.php";
    header('Content-Type:application/json;charset=utf-8');
    session_start();

    if(!isset($_SESSION['login'])){
        echo json_encode(array("message" => "unauthorized"));
    } else {
        $userId = $_SESSION["id"];
        $query = "SELECT * FROM Messages WHERE from = '$userId' or to = '$userId'";

        $result = mysqli_query($koneksi, $query);
        
        $arr = array();
        while($row = mysqli_fetch_assoc($result)){
            $arr[] = $row;
        }
        echo json_encode($arr);

    }

?>