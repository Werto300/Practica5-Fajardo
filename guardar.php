<?php

//require_once('include/util.php');
$token = $_POST['token'];
$con = mysqli_connect("localhost", "root", "",);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = "insert into tokens(Token) values('$token')";
mysqli_query($con,$sql);
mysqli_close($con);
echo "successful"
?>