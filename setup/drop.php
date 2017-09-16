<?php

     $dbhost = 'localhost:3306';
     $dbuser = 'root';
     $dbpass = '';
     $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

     if(! $conn ){
         echo "<div id='div1'>Connected failure<br></div>";
     }

     echo "<div id='div1'>1.Connected successfully<br></div>";
     $sql = "DROP DATABASE IF EXISTS services_hero";

     if (mysqli_query($conn, $sql)) {
         echo "<div id='div1'>2.Successfully drop and recreate database 'services_hero'<br></div>";
     } else {
         echo "<div id='div1'>\"Error: \" . mysqli_error($conn)<br></div>";
     }

?>