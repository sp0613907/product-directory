<?php
    $dsn = 'mysql:host=localhost;dbname=directory';
    $username = 'root';
    $password = null;

    try{
        $db = new PDO($dsn, $username, $password);
    }catch(PDOEception $e){
        $error_message = $e->getMessage();
        include('db_error.php');
        exit();
    }

    function getOne($query, array $binds = [], $conn){
        $statement = $conn->prepare($query);
        foreach($binds as $key => $value){
            $statement->bindValue($key, $value);
        }
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
?>