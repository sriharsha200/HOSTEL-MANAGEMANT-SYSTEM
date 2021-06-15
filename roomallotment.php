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
$rollno=$_SESSION["regno"];
$gender=$_SESSION["gender"];
$year=$_SESSION["year"];
function search($regno){
    include('connect.php');
    $tabel="none";
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
$tabel=search($rollno);
if(isset($_POST["submit"])){
    $roomno=$_POST["roomno"];
    $query="SELECT *FROM `$tabel` WHERE `gender`='$gender' AND `room`=$roomno";
    $result=mysqli_query($conn,$query);
    $rows=mysqli_num_rows($result);
    if($gender=='female' and $year==1){
        if(($roomno>=101 and $roomno<=106) or ($roomno>=201 and $roomno<=206) or ($roomno>=301 and $roomno<=306) or ($roomno>=401 and $roomno<=406)){
        $temp=(int)($roomno /10);
        $temp=(int)($temp/10);
        if($temp==1){
            $availability=2;
        }
        else{
            $availability=4;
        }
            if($availability > $rows){  
            $query="UPDATE `reg_details` SET `room`=$roomno WHERE `regno`='$rollno'"; 
            $result=mysqli_query($conn,$query); 
            $_SESSION['reg']=$rollno; 
            $_SESSION['roomno']=$roomno; 
            $_SESSION['temp']=true; 
            header('Location: adminmiddle.php'); 
        }
        else{
            $_SESSION['reg']=$rollno;
            $_SESSION['temp']=true;
            header('Location: juniorgirlshostel.php');
        }
      }
      else{
        echo "<div class='insert'> Please enter the valid room number </div>"; 
      }
    }
    if($gender=='female' and $year!=1){
        if(($roomno>=101 and $roomno<=115) or ($roomno>=201 and $roomno<=215) or ($roomno>=301 and $roomno<=315) or ($roomno>=401 and $roomno<=415)){   
        $availability=3;
        if($availability > $rows){
            $query="UPDATE `$tabel` SET `room`=$roomno WHERE `regno`='$rollno'";
            $result=mysqli_query($conn,$query);
            $_SESSION['reg']=$rollno;
            $_SESSION['roomno']=$roomno;
            $_SESSION['temp']=true;
            header('Location: adminmiddle.php');
        }
        else{
            $_SESSION['reg']=$rollno;
            $_SESSION['temp']=true;
            header('Location: seniorgirlshostel.php');
        }
    }
    else{
        echo "<div class='insert'> Please enter the valid room number </div>"; 
      }
    }
    if($gender=='male' and $year<=2){  
        if(($roomno>=101 and $roomno<=113) or ($roomno>=201 and $roomno<=213) or ($roomno>=301 and $roomno<=313) or ($roomno>=401 and $roomno<=413)){         
            $availability=4;
        if($availability> $rows){
            $query="UPDATE `$tabel` SET `room`=$roomno WHERE `regno`='$rollno'";
            $result=mysqli_query($conn,$query);
            $_SESSION['reg']=$rollno;
            $_SESSION['roomno']=$roomno;
            $_SESSION['temp']=true;
            header('Location: adminmiddle.php');
        }
        else{
            $_SESSION['reg']=$rollno;
            $_SESSION['temp']=true;
            header('Location: juniorboyshostel.php');
        }
    }
    else{
        echo "<div class='insert'> Please enter the valid room number </div>"; 
      }
    }
    if($gender=='male' and $year>2){
        if(($roomno>=101 and $roomno<=122) or ($roomno>=201 and $roomno<=222) or ($roomno>=301 and $roomno<=322) or ($roomno>=401 and $roomno<=422)){   
            $availability=3;
        if($availability > $rows){
            $query="UPDATE `$tabel` SET `room`=$roomno WHERE `regno`='$rollno'";
            $result=mysqli_query($conn,$query);
            $_SESSION['reg']=$rollno;
            $_SESSION['roomno']=$roomno;
            $_SESSION['temp']=true;
            header('Location: adminmiddle.php');
        }
        else{
            $_SESSION['reg']=$rollno;
            $_SESSION['temp']=true;
            header('Location: seniorboyshostel.php');  
        }
    }
    else{
        echo "<div class='insert'> Please enter the valid room number </div>"; 
      }
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
       <form action="roomallotment.php" method="POST">
        <h1>Allot a Room!</h1>
        <lable class="lable">Room No:</lable> <input type="number" name="roomno" class="inp" placeholder="Room no" ><button type="submit" name="submit" class="roomstat">Allocate</button><br>
        
    </form>
</div>
</div>
</body>
</html>