<?php
$onServer = strpos($_SERVER['HTTP_HOST'], 'cosc360.ok.ubc.ca') !== false;

if ($onServer) {
    // Server settings
    define('DBHOST', 'localhost');
    define('DBNAME', 'yourcwl');
    define('DBUSER', 'yourcwl');
    define('DBPASS', 'yourcwl');
} else {
    // Local dev settings
    define('DBHOST', '127.0.0.1');
    define('DBNAME', 'bookhive_db');
    define('DBUSER', 'root');
    define('DBPASS', '');
}

define('DBCONNSTRING',"mysql:host=". DBHOST. ";dbname=". DBNAME);
?>
