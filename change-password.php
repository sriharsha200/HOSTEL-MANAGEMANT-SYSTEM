<?php
session_start();
if(isset($_POST["submit"])){
    $regno=$_POST["reg"];
    $oldpassword=$_POST["opassword"];
    $newpassword=$_POST["cpassword"];
    $confirmpassword=$_POST["cnpassword"];
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
if($row==1)
{
    $query="SELECT *FROM `student_details` WHERE `username`='$regno'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);
    $passwordhash=$row['password'];
    $rows=0;
    if(password_verify($oldpassword,$passwordhash)){
        $rows=1;
    }
    if($rows==1){
        $number = preg_match('@[0-9]@', $newpassword);
    $uppercase = preg_match('@[A-Z]@', $newpassword);
    $lowercase = preg_match('@[a-z]@', $newpassword);
    $specialChars = preg_match('@[^\w]@', $newpassword);
	if(strlen($newpassword) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
    echo "<div class='insert'>Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.</div>";
    }
        else{
            if($newpassword==$confirmpassword and $newpassword!=''){
        $hash=password_hash($newpassword, PASSWORD_DEFAULT);
        $query="UPDATE `student_details` SET `password`='$hash' WHERE `username`='$regno'";
        $result=mysqli_query($conn,$query);
        $_SESSION["pass"]=true;
        
        header("Location: studentlogin.php");
    }
    else{
        echo "<div class='insert'>
        New password and Confirm password should be same!
        </div>";   
     } 
}
    }
else{
    echo "<div class='insert'>
    Please check your password!
    </div>"; 
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/studentstyle.css">
    <link rel="shortcut icon" href="./images/anitslogo2.png" type="image/x-icon"> 

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="change-password.php" method="POST">
                    <h2 class="text-center">Change Password</h2>
                     <div class="form-group">
                        <input class="form-control" name="reg"  type="number" placeholder="Enter Regno" >
                    </div>
					
                    <div class="form-group">
                        <input class="form-control" name="opassword" type="password"  placeholder="Old password" >
                    </div>
					<div class="form-group">
                        <input class="form-control" name="cpassword" type="password"  placeholder="New password" >
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="cnpassword" type="password"  placeholder="Confirm your password" >
                    </div>
					<a href="forgot-password.php">Forget Password?</a><br><br>
					
                    <div class="form-group">
                    <input type="submit"  name="submit" class="form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>