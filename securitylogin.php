<?php
 if(isset($_POST["submit"])){
    include("connect.php");
     $username=$_POST['username'];
     $password=$_POST['password'];
     $query="SELECT * FROM `security_details` WHERE `username`='$username' AND `password`='$password'";
     $result=mysqli_query($conn,$query);
     $num=mysqli_num_rows($result);
if($num==1){
    header("Location:securityoutstat.php");
}
else{
    echo "<div class='insert1'>
    <strong>check your credentials</strong>
    </div>";
}
 }

?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HOSTEL MANAGEMENT SYSTEM</title>
        <link rel="stylesheet" href="css/adminlogin.css" >
        <link rel="shortcut icon" href="./images/anitslogo2.png" type="image/x-icon"> 
        
    </head>
    <body>
    <div class="header">
    <nav>
        
            <div>
                <a href = "home.php" class ="logo"><img src="images/anitslogo2.png" alt="can't load the logo"></a>
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
    <div class="login-box">
    <img src="images/avatar.png" class="avatar">
        <h1>Security Login</h1>
            <form action="securitylogin.php" method="POST">
            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <input type="submit" name="submit" value="Login"></a>  
            </form>
        
        
        </div>
    
    </body>
</html>