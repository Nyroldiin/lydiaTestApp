<?php

$pdo = null;
function get_db()
{   
    $db_host= "";                 	// Adresse de la base de données (exemple : sql.mondomaine.fr)
    $db_port = "";
    $db_user = "";                             	// Username (pour la base de données)
    $db_pass = "";                            	// Password (pour la base de données)
    $db = ""; 

    global $pdo;

    if ($pdo != null) return $pdo;
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_PERSISTENT => true
    );
    $pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db", $db_user, $db_pass, $options);

    return $pdo;
}

