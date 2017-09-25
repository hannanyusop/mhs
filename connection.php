<?php
//block form direct access for security purpose to prevent from unauthorized person inject sql connection
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die( header( '404.php' ) );

}
$domain = "mhs.dev";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "services_hero";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error."<br><a href='setup/index.php'>Try setup database?</a> ");
}

