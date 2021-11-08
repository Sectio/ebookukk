<?php 
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'ukk';

    $link = mysqli_connect($server,$username,$password,$db);

    if(!$link){
        die('Database connection error '.mysqli_connect_error());
    }
?>