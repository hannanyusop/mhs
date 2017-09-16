<?php

$dbconn = mysqli_connect('localhost','root','');
mysqli_select_db($dbconn,'services_hero');

$file = 'service_hero.sql';

if($fp = file_get_contents($file)) {
    $var_array = explode(';',$fp);
    foreach($var_array as $value) {
        mysqli_query($dbconn,$value.';');
    }
}
echo "<div id='div2'>=======================================<br>3.Successfully import database </div>";
echo "<div id='div3'>Yaayyyyyy!!!!!!!!!!!</div>";
?>
