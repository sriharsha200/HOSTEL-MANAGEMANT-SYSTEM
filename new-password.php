<?php
session_start();
include('connect.php');
if(isset($_POST['change-password'])){
    $cpassword=$_POST['cpassword'];
    $password=$_POST['npassword'];
    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    if(strlen($password)==0){
        echo "<div class='insert'>Please enter your password</div>";  
    }
	else if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
    echo "<div class='insert'>Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.</div>";
    }
    else{
    if($password==$cpassword){
        $regno=$_SESSION['regno'];
        $hash=password_hash($cpassword, PASSWORD_DEFAULT);
        $query="UPDATE `student_details` SET `password`='$hash' WHERE `username`='$regno'";
        $result=mysqli_query($conn,$query);
        $_SESSION['cpassword']=true;
        $_SESSION["pass"]=true;
        header('Location:studentlogin.php');
    }
    else{
        echo "<div class='insert'> New password and confirm password should be same</div>";
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
                <form action="new-password.php" method="POST" autocomplete="off">
                    <h2 class="text-center">New Password</h2>
                    
                    <div class="form-group">
                        <input  type="password" name="npassword" placeholder="Create new password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="cpassword" placeholder="Confirm your password" class="form-control" >
                    </div>
                    <div class="form-group">
                        <a href="Student login.php"><input class="form-control button" type="submit" name="change-password" value="Change"></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>