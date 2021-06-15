<?php  
session_start();
if(!isset($_SESSION['slogin'])){
    header("Location: logout.php");
}
if(isset($_SESSION['slogin']))
{
    if($_SESSION["stime"]<=time()){ 
        header("Location: home.php");
    }
}
$img=$_SESSION['img'];
$regno=$_SESSION["rollno"];
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
    $query="SELECT *FROM `$table` WHERE `regno`='$regno'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);
    $fname=$row["fname"];
    $lname=$row["lname"];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HOSTEL MANAGEMENT SYSTEM</title>
	<link rel="stylesheet" href="css/studentmiddle.css" >
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="shortcut icon" href=<?php echo "./images/$img" ?> type="image/x-icon"> 
    
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
                    <li><a href="studentprofile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                 </ul>
            </li>
            </ul>
        </div>
    
</nav>
    </div>
    <div class="total">
    <h2> Welcome! <?php echo $fname."  ".$lname ?></h2>
    <div class="container">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="inner-box">
                <div class="card-front">
                    <p>COMPLAINT</p>
                </div>
                <div class="card-back">
                    <li class="selected">
                        <a href="studentcomplaint.php">Post a complaint</a>
                    </li>
                    <li class="selected">
                        <a href="studentcompstat.php">Check Complaint Status</a>
                    </li>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="inner-box">
                <div class="card-front">
                    <p>OUTINGS</p>
                </div>
                <div class="card-back">
                     <li class="selected">
                        <a href="studentoutreq.php">Request for Outing</a>
                    </li>
                    <li class="selected">
                        <a href="studentoutingstats.php">Check Outing status</a>
                    </li>
                </div>
              </div>
            </div>
          </div>
</div>
<div class="scrol">
    <p>RULES AND REGULATIONS</p><br>
    
    <marquee direction="left" onmouseover="this.stop();" onmouseout="this.start();"><li>The Management & Staff will not be responsible for personal belongings.Students must keep the Campus & Rooms clean. Defacing walls, equipment, furniture etc., is strictly prohibited.</li><li>Students must turn off all the electrical equipments & lights before leaving their rooms.Students are not allowed to use electric stoves, heaters etc in rooms except in designated places.</li><li>Food will be served only in the designated Dining Hall(s) and only during the specified timings. Wasting food & water will not be encouraged.</li><li>Visitors are allowed only in Cellar. Visitors are not allowed beyond the visiting area. No outside Guest\Students will be allowed inside the hostel.</li><li>Silence: Strict silence shall be observed in hostel from 11.00 pm to 5.30 am. Care should be taken at all times to ensure that music\loud talking is NOT audible outside the room.</li></marquee>
</div>
    </div>    
</body>
</html>
