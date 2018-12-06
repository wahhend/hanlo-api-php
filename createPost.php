<?php
    include "config.php";
    header("Access-Control-Allow-Origin:".$_SERVER['HTTP_ORIGIN']);
    header('Content-Type:application/json;charset=utf-8');
    header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS');
	header('Access-Control-Allow-Headers', 'Content-Type, Authorization, Content-Length, X-Requested-With');
	header('Access-Control-Allow-Credentials:true');
    session_start();

    if(!isset($_SESSION['login'])){
        echo json_encode(array("message" => "unauthorized"));
    } else {
        if(isset($_POST)){
            $content = $_POST["content"];
            $userId = $_SESSION["id"];
            // $now = time() + (7 * 60 * 60);
            $now = date('Y-m-d H:i:s');
    
            $query = "INSERT INTO Posts(content, createdAt, updatedAt, userId) VALUES('$content', '$now', '$now', '$userId')";
            $create = mysqli_query($koneksi, $query);

            if($create){
                echo json_encode(array("message" => "Create post success"));
            } else {
                echo json_encode(array("message" => mysqli_error($koneksi)));
            }
            
        }
    }
?>