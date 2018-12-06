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
            $from = $_SESSION['id'];
            $to = $_POST['id'];
            $content = $_POST['content'];
            
            $query = "INSERT INTO Messages(content, createdAt, updatedAt, `from`, `to`) 
            VALUES('$content', now(), now(), '$from', '$to')";
            $create = mysqli_query($koneksi, $query);

            if($create){
                $query = "SELECT * FROM Messages ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($koneksi, $query);
                $row = mysqli_fetch_assoc($result);
                
                echo json_encode(array(
                    "id" => $row["id"],
                    "content" => $row["content"],
                    "createdAt" => $row["createdAt"],
                    "updatedAt" => $row["updatedAt"],
                    "from" => $row["from"],
                    "to" => $row["to"]
                ));
                // echo json_encode($create);
            }
            else{
                echo json_encode(array("message" => mysqli_error($koneksi)));
            }
        }
    }
?>