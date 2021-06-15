<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header("Location: logout.php");
}
if(isset($_SESSION['loggedin']))
{
    if($_SESSION["time"]<=time()){ 
        header("Location: home.php");
    }
}
if(!isset($_SESSION['loggedin'])){
    header("Location: logout.php");
}
if(isset($_SESSION['loggedin'])){
    if($_SESSION["time"]<=time()){
        header("Location: home.php");
    }
}
if(isset($_POST['submit'])){
$regno = $_POST["regno"];
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
$query="DELETE FROM `student_details` WHERE regno='$regno'";
$result=mysqli_query($conn,$query);
$query="DELETE FROM `$table` WHERE regno='$regno'";
$result=mysqli_query($conn,$query);
if($result){
    echo "<div class='insert'>
    <strong>Success </strong>details of $regno deleted successfully
    </div>";
}
}
else{
    echo "<div class='insert'>
    <strong>Failed </strong>Register number: $regno doesnot found!
    </div>";
}
$query="DELETE FROM `accept_complaints` WHERE `rollno`='$regno'";
$result=mysqli_query($conn,$query);
$query="DELETE FROM `studentout_req` WHERE `rollno`='$regno'";
$result=mysqli_query($conn,$query);
$query="DELETE FROM `reject_complaints` WHERE `rollno`='$regno'";
$result=mysqli_query($conn,$query);
$query="DELETE FROM `student_complaints` WHERE `rollno`='$regno'";
$result=mysqli_query($conn,$query);
$query="DELETE FROM `solved_complaints` WHERE `rollno`='$regno'";
$result=mysqli_query($conn,$query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration </title>
    <link rel="stylesheet" href="css/adminupdation.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@500&display=swap" rel="stylesheet">
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
            <li class="menu">
                <a href="aboutus.php">AboutUs</a>
            </li>
            </ul>
            <ul id="other">
            <li class="profile">
                <a href="#"><img src="images/prof.png"></a>
                <ul>
                    <li><a href="#">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                 </ul>
            </li>
            </ul>
        </div>
    
</nav>
</div>
<div class="total">
   <div id="form">
       <form action="admindelete.php" method="POST">
        
        <h1>Delete!</h1>
		<br><br>
		    <label class="label">Enter RegNo to be Deleted:</label>  <input type="text" class="inp"  name="regno"  placeholder="Registration no">
            <br>
            <div style="text-align:center">
                <input id="btn" name="submit" type="submit"/>
            </div>
         </form>
</div>
</body>
</html>
