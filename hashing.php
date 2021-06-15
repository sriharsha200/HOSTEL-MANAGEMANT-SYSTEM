<?php
echo "hehe";
include("connect.php");
$n=0;
$u=318126510001;
echo "hehe";
$p='hms';
while($n!=180){
    $h=password_hash($p, PASSWORD_DEFAULT);
$query="INSERT INTO `student_details` values('$u','$h')";
mysqli_query($conn,$query);
$n+=1;
$u+=1;
}
?>