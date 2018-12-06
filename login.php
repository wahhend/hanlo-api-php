<?php
	session_start();
	include "config.php";
	header('Content-Type:application/json;charset=utf-8');

	if(isset($_POST)){
        $username = $_POST["username"];
        $password = $_POST["password"];
        
		$query = "SELECT * FROM Users WHERE username = '$username' and password = '$password'";
		$result = mysqli_query($koneksi,$query);
		$row = mysqli_fetch_assoc($result);
		$count = mysqli_num_rows($result);
			
		if($count == 1) {
			$_SESSION['login'] = true;
			$_SESSION['username'] = $username;
		  	$_SESSION['displayName'] = $row["displayName"];
			$_SESSION['id'] = $row["id"];
			
			echo json_encode(array(
				"id" => $row["id"],
				"username" => $row["username"],
				"displayName" => $row["displayName"],
			));
		} else if(count == 0) {
			echo json_encode(array("messaege" => "Username and password mismatch"));
		}
	}
	else{
		echo json_encode(array("message" => "Login failed"));
	}
?>