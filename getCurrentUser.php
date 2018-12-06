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
        $user = new stdClass;
        $user->id = $_SESSION['id'];
        $user->username = $_SESSION['username'];
        $user->displayName = $_SESSION['displayName'];
        
        echo json_encode($user);
    }
?>