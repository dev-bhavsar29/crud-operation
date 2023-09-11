<?php
$servername = "localhost";
$username ="root";
$pwd = "";
$db = "formsubmit";

$con = mysqli_connect($servername,$username,$pwd,$db);

if($con){
    //echo "connection successful<br>";
}
else
{
    //echo "connection cannot successful<br>";
}
?>