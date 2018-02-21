<?php
    $dsn = 'mysql:host=localhost;dbname=directoryy';
    $username = 'root';
    $password = null;

    try{
        $db = new PDO($dsn, $username, $password);
    }catch(PDOEception $e){
        $error_message = $e->getMessage();
        include('db_error.php');
        exit();
    }
?>