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
include('connect.php');
function search($regno){
    include('connect.php');
    $tabel="";
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
if(isset($_POST['submit'])){
    $rollno = $_POST["rollno"];
    if($rollno!=''){
$tabel=search($rollno);
$query="select *from `$tabel` WHERE `room`=0 AND `regno`='$rollno'";
$result=mysqli_query($conn,$query);
$rows=mysqli_num_rows($result);
if($rows==1){
    $row=mysqli_fetch_assoc($result);
    $gender=$row["gender"];
    $year=$row["year"];
    $_SESSION["regno"]=$rollno;
    $_SESSION["gender"]=$gender;
    $_SESSION["year"]=$year;
    if($gender=="female" and $year==1){
        header("Location:juniorgirlshostel.php");
    }
    
    else if($gender=="female" and $year!=1){
        header("Location:seniorgirlshostel.php");
    }
    
    if($gender=="male" and $year==1){
        header("Location:juniorboyshostel.php");
    }
    
    if($gender=="male" and $year!=1){   
        header("Location:seniorboyshostel.php");
    }
}
else{
    if($tabel!=""){
    echo "<div class='insert'> For the register number $rollno room was already allocated if you want to change you can update for the the registered roll numbers</div>";
  }
  else{
    echo "<div class='insert'> Register number $rollno was not registered yet</div>";
  }
}
    }
    else{
        echo "<div class='insert'> Please enter the register number $rollno </div>";
      }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration </title>
    <link rel="stylesheet" href="css/regform.css">
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
                    <li><a href="logout.php">Logout</a></li>
                 </ul>
            </li>
            </ul>
        </div>
    
</nav>
</div>
<div class="total">
<div id="form">
       <form action="roomallotbefore.php" method="POST">
        <h1>Allot a Room!</h1>
        <lable class="lable">Roll No:</lable> <input type="text" name="rollno" class="inp" placeholder="Roll no" ><button type="submit" class="roomstat" name="submit">Check Room Status!</button><br>
    </form>
</div>
</div>
</body>
</html>