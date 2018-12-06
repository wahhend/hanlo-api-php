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

            $query = "SELECT Comments.id, Comments.content, Comments.createdAt,
            Users.username, Users.displayName FROM Comments INNER JOIN Users 
            ON Comments.userId = Users.id WHERE postId = '$postId'";
            $result = mysqli_query($koneksi, $query);
            $comments = [];
            while($comment = mysqli_fetch_assoc($result)){
                $comments[] = $comment;
            }
            echo json_encode($comments);
        }
    }
?>