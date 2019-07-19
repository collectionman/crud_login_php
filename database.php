<?php

    $server = 'localhost' ;
    $username = 'root' ;
    $password = '' ;
    $database = 'php_login_database' ;

    try {
        $connection = new PDO( "mysql:host=$server;dbname=$database;", $username, $password ) ;
    } catch ( PDOException $error ) {
        die( 'Conection failed: '.$error -> getMessage() ) ;
    }

?>