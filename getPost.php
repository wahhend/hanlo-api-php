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
            $postId = $_POST['id'];

            $query = "SELECT Users.username, Users.displayName 
            FROM Posts JOIN Users ON Posts.userId = Users.id WHERE id = '$postId'";
            $result = mysqli_query($koneksi, $query);
            $count = mysqli_num_rows($result);
            if($count == 1){
                $post = mysqli_fetch_assoc($result);
                echo json_encode($post);
                return;
            }

            echo json_encode(array("message" => "Post not found"));
            return;
        }
        echo json_encode(array("message" => "Need post id"));
    }
?>