<?php
session_start();
if(isset($_SESSION["slogin"]))
{
    if($_SESSION["stime"]<=time()){ 
    header("Location: home.php");
    }
    else{
        header("Location: studentmiddle.php");
    }
}
if(isset($_SESSION["pass"]) and $_SESSION["pass"]==true){
    echo "<div class='insert'>
    <strong>Password reset successful</strong>
    </div>";
    $_SESSION["pass"]=false;
}

function search($regno){
    $tabel="none";
    include('connect.php');
    $query="SELECT * FROM `reg_details` WHERE  `regno`='$regno'";
    $result=mysqli_query($conn,$query);
    $norows=mysqli_num_rows($result);
    if($norows>0){
        $tabel='reg_details';
    }
    if($norows==0){
      $query="SELECT * FROM `second_years` WHERE  `regno`='$regno'";
      $result=mysqli_query($conn,$query);
      $norows=mysqli_num_rows($result);
      if($norows>0){
          $tabel='second_years';
      }
    }
    if($norows==0){
      $query="SELECT * FROM `third_years` WHERE  `regno`='$regno'";
      $result=mysqli_query($conn,$query);
      $norows=mysqli_num_rows($result);
      if($norows>0){
          $tabel='third_years';
      }
    }
    if($norows==0){
      $query="SELECT * FROM `final_years` WHERE  `regno`='$regno'";
      $result=mysqli_query($conn,$query);
      $norows=mysqli_num_rows($result);
      if($norows>0){
          $tabel='final_years';
      }
    }
    return $tabel;
}
if (isset($_POST["submit"])){  
    include("connect.php");
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query="SELECT *FROM `student_details` WHERE `username`='$username'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);
    $passwordhash=$row['password'];
    $rows=0;
    if(password_verify($password,$passwordhash)){
        $rows=1;
    }

if($rows==1){
    $table=search($username);
    $query="SELECT * FROM `$table` WHERE `regno`='$username'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);
    $_SESSION["img"]=$row['image'];
    $_SESSION["rollno"]=$username;
    $_SESSION['slogin']=true;
    $_SESSION["stime"]=time()+1000;
    header("Location:studentmiddle.php");
}
else{
    echo "<div class='insert'>
    <strong>Error!</strong> Please check your credentials
    </div>";
}  
}  
if(isset($_POST["changepassword"])){  
    header("Location:change-password.php");  
}  
?>  
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HOSTEL MANAGEMENT SYSTEM</title>
        <link rel="stylesheet" href="css/studentlogin.css" >
        <link rel="shortcut icon" href="./images/anitslogo2.png" type="image/x-icon"> 
    </head>
    <body>
    <div class="header"> 
    <nav>        
            <div>
                <a href = "home.php" class ="logo"><img src="images/anitslogo2.png" alt="can't load the logo" ></a>
                <div id="divid">
                <h1>Hostel Management</h1></div>
                <ul id="navigation">
                <li class="selected">
                    <a href="home.php">Home</a>
                </li>
                
                <li class="pics">
                    <a href="gallery.php">Gallery</a>
                </li>
            
                <li>
                  <a href="aboutus.php">AboutUs</a>
              </li>
                </ul>
            </div>
        
    </nav>
    </div>
    <div class="total">
    <div class="login-box">
    <img src="images/avatar.png" class="avatar">
        <h1>Student Login</h1>
            
            <form action="studentlogin.php" method="POST">
            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <input type="submit" name="submit" value="Login"></a>
             <input type="submit" name="changepassword" value="Change Password">  
            </form> 
        </div>
    </div>
    </body>
</html>
