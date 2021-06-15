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
if(isset($_SESSION['reg'])){
    if($_SESSION['temp']==true){
        $roomn=$_SESSION['roomno'];
        $reg=$_SESSION['reg'];
      echo "<div class='insert'>Room no $roomn is allocated for register number $reg</div>";
      $_SESSION['temp']=false;
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HOSTEL MANAGEMENT SYSTEM</title>
	<link rel="stylesheet" href="css/adminmiddle.css">
    <link rel="stylesheet" href="css/navbar.css">
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
    <h2> Welcome!</h2>
    <div class="rem">
        <li class="choice">
            <a href="regform.php">Register Now!</a>
        </li>
        <li class="choice">
            <a href="roomallotbefore.php">Room Allocation</a>
        </li>
        <li class="choice">
            <a href="popup.php">Academic Updation</a>
        </li>
    </div>
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
                        <a href="admincompstat.php">Check Complaints</a>
                    </li>
                    <li class="selected">
                        <a href="adminacceptcomp.php">Accepted Complaint Status</a>
                    </li>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="inner-box">
                <div class="card-front">
                    <p>UPDATION</p>
                </div>
                <div class="card-back">
                     <li class="selected1">
                        <a href="adminupdate.php">Update</a>
                    </li>
                    <li class="selected1">
                        <a href="admindelete.php">Delete</a>
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
                     <li class="selected1">
                        <a href="grantouting.php">Grant Outing</a>
                    </li>
                    <li class="selected1">
                        <a href="adminoutstat.php">Check Outing status</a>
                    </li>
                </div>
              </div>
            </div>
        </div>
</div>
</div>
</body>
</html>

