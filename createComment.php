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
            $postId = $_POST['postId'];
            $content = $_POST['content'];
            $userId = $_SESSION['id'];
            $now = time() + (7 * 60 * 60);
            $now = date('Y-m-d H:i:s', $now);
    
            $query = "INSERT INTO Comments(content, createdAt, updatedAt, postId, userId) 
            VALUES('$content', '$now', '$now', '$postId', '$userId')";
            $create = mysqli_query($koneksi, $query);

            if($create){
                echo json_encode(array("message" => "Add comment success"));
            } else {
                echo json_encode(array("message" => mysqli_error($koneksi)));
            }
            
        }
    }
?>