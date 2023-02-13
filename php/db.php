<?php

function connect()
{
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbName = 'appJsPhp_databse';
    $dbPort = 3309;

    $connection =  new mysqli($host, $user, $password, $dbName, $dbPort);
    if ($connection->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error;
        return null;
    }
    // echo "We are connected! \n";
    return $connection;
}
