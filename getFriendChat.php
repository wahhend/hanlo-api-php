<?php
    include "config.php";
    // header("Access-Control-Allow-Origin:".$_SERVER['HTTP_ORIGIN']);
    header('Content-Type:application/json;charset=utf-8');
    header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS');
	header('Access-Control-Allow-Headers', 'Content-Type, Authorization, Content-Length, X-Requested-With');
	header('Access-Control-Allow-Credentials:true');
    session_start();

    if(!isset($_SESSION['login'])){
        echo json_encode(array("message" => "unauthorized"));
    } else {
        if(isset($_POST['id'])){
            $userId = $_SESSION['id'];
            $friendId = $_POST['id'];

            $query = "SELECT Messages.id, Messages.from, Messages.to, Messages.content, Messages.createdAt, Messages.updatedAt,
            Users.username, Users.displayName FROM Messages JOIN Users ON Messages.from=Users.id 
            WHERE (`from` = '$userId' AND `to` = '$friendId') OR (`from` = '$friendId' AND `to` = '$userId')";

            $result = mysqli_query($koneksi, $query);
            $count = mysqli_num_rows($result);

            if($count > 0){
                $arr = array();
                while($row = mysqli_fetch_assoc($result)){
                    $arr[] = $row;
                }
                echo json_encode($arr);
            } else {
                echo json_encode(array("message" => "no messages"));
            }
            
        }
    }
?>