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
  if(isset($_POST['yes'])){
      include("connect.php");
      $query="SELECT *FROM final_years";
      $result=mysqli_query($conn,$query);
      while($row=mysqli_fetch_assoc($result)){
        $regno=$row["regno"];
        $query="DELETE FROM `student_details` WHERE `username`='$regno'";
        $result=mysqli_query($conn,$query);
      }
      $query="TRUNCATE TABLE `final_years`";
      mysqli_query($conn,$query);
      $query="INSERT INTO `final_years` SELECT * FROM `third_years`";
      mysqli_query($conn,$query);

      $query="TRUNCATE TABLE `third_years`";
      mysqli_query($conn,$query);
      $query="INSERT INTO `third_years` SELECT * FROM `second_years`";
      mysqli_query($conn,$query);


      $query="TRUNCATE TABLE `second_years`";
      mysqli_query($conn,$query);
      $query="INSERT INTO `second_years` SELECT * FROM `reg_details`";
      mysqli_query($conn,$query);

      $query="TRUNCATE TABLE `reg_details`";
      mysqli_query($conn,$query);
      header("Location: success.php");   
  }
  if(isset($_POST['no'])){
    header("Location: adminmiddle.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/pop.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/anitslogo2.png" type="image/x-icon"> 
    <title>Document</title>
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

    <div class="popup_center"> 
      <form action="popup.php" method="POST">
        <div class="icon"> 
          <i class="far fa-question-circle fa-3x" id= "ques"></i>
        </div> 
        <div class="title"> 
          Update Academic Year
        </div> 
        <div class="description">
          Once this academic year gets updated the current 4th year details will be lost and 1st,2nd,3rd years details will be updated accordingly
        </div> 
        <div class="dismiss-btn"> 
          <button id="dismiss-popup-btn" onclick="hide()" name="yes"> 
            Yes
          </button>
          <button id="dismiss-popup-btn1" name="no"> 
            No
          </button>
        </div>
     </div> 
    </form> 

    </body>
</html>
