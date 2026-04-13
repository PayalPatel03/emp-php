<?php
$conn = new mysqli("localhost","root","","ems_db");
if($conn->connect_error){
 die("Connection Failed");
}
?>