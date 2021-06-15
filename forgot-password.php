<?php
session_start();
if(isset($_POST["number"])){
	$regno=$_POST["reg"];
	$_SESSION['regno']=$regno;
	include("connect.php");
    $query="SELECT *FROM `reg_details` WHERE `regno`='$regno'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_num_rows($result);
if($row==1){
    $table="reg_details";
}

if($row==0)
{
    $query="SELECT *FROM `second_years` WHERE `regno`='$regno'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_num_rows($result); 
    $table="second_years";
}

if($row==0)
{
    $query="SELECT *FROM `third_years` WHERE `regno`='$regno'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_num_rows($result); 
    $table="third_years";
}

if($row==0)
{
    $query="SELECT *FROM `final_years` WHERE `regno`='$regno'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_num_rows($result); 
    $table="final_years";
}
	if($row==1){
	$ch=mysqli_fetch_assoc($result);
	$mail= $ch['email'];
    $_SESSION['email']=$mail;
	$otp=rand(100000,999999);
	session_start();
	$_SESSION["otp"]=$otp;
	$sub="OTP to reset your password ";
	$msg="Your OTP is : $otp";
	echo $msg;
	mail($mail,$sub,$msg);
	header("LOCATION: user-otp.php");		
	}
	else{
        if($regno!=''){
		echo "<div class='insert'>
        <strong>You are not registered yet!</strong>
        </div>";}
        if($regno!=''){
            echo "<div class='insert'>
            <strong>please check your register number!</strong>
            </div>";
        }
        else{
            echo "<div class='insert'>
            <strong>please enter your register number!</strong>
            </div>";
        }
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/studentstyle.css">
    <link rel="shortcut icon" href="./images/anitslogo2.png" type="image/x-icon"> 
</head>
<body>
<div class="fullscreen-bg">
    <video loop muted autoplay poster="img/videoframe.jpg" class="fullscreen-bg__video">
        
        <source src="video.mp4" type="video/mp4">
        
    </video>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your register number </p>
                   
                    <div class="form-group">
                        <input class="form-control"  name="reg" placeholder="Enter your register number" >
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="number" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>