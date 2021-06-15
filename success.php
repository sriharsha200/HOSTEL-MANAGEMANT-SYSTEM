<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header("Location: logout.php");
}
if(isset($_SESSION['loggedin']))
{
    if($_SESSION["time"]<=time()){ 
        header("Location: home.php.php");
    }
}
  if(isset($_POST['dismiss'])){
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

   <form action="success.php" method="POST">
    <div class="popup1_center1"> 
        <div class="icon1"> 
            <i class="fa fa-check" aria-hidden="true"></i>
        </div> 
        <div class="title1"> 
          Success
        </div> 
        <div class="description1"> 
            Academic year updated successfully
        </div> 
        <div class="dismiss-btn1"> 
          <button class="dismiss-popup-btn1" name='dismiss'> 
            Dismiss
          </button>
        </div>
      </div>
    </form>

</body>
</html>
