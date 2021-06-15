<?php
$conn=mysqli_connect("localhost","root","","HMS");
        if(!$conn){
            die("sorry failed to connect :". mysqli_connect_error());
        }
?>