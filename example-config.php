<?php
    $dbhost = "localhost";
    $dbuser = "username";
    $dbpass = "password";
    $dbname = "database";

    $koneksi = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error connection to <b>'.$dbname.'</b>');