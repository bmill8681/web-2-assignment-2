<?php 
    // define('DBHOST', 'localhost');
    // define('DBNAME', 'travel');
    // define('DBUSER', 'root');
    // define('DBPASS', '');
    // define('DBCONNECTION',"mysql:host=" . DBHOST . ";dbname=" . DBNAME .";charset=utf8mb4;");
    define('DBCONNECTION', getenv('MYSQL_DSN') );
    define('DBUSER', getenv('MYSQL_USER') );
    define('DBPASS', getenv('MYSQL_PASSWORD') ); 
?>

  