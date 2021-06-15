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
if(isset($_POST['submit'])){
    $regno=$_SESSION['rollno'];
    $outdate=$_POST['outdate'];
    $outtime=$_POST['outtime'];
    $indate=$_POST['indate'];
    $intime=$_POST['intime'];
    $place=$_POST['place'];
    $reason=$_POST['reason'];
    $date=date('y/m/d');
    $status='pending';
	
    include("connect.php");
		$error=0;
$dyear=(int)($date[0].$date[1]);
$oyear=(int)($outdate[2].$outdate[3]);
$dmonth=(int)($date[3].$date[4]);
$omonth=(int)($outdate[5].$outdate[6]);
$dday=(int)($date[6].$date[7]);
$oday=(int)($outdate[8].$outdate[9]);

if($dyear<=$oyear)
{
	if($dyear==$oyear and $dmonth<=$omonth){
		if($dmonth==$omonth and $dday<=$oday){
$error='';}
else{
	echo "<div class='insert'>
    <strong>Please</strong>Check your outdate
   </div>";
   $error=1;
}
	}
else{
	echo "<div class='insert'>
    <strong>Please</strong>Check your outdate
   </div>";
   $error=1;
	
	
}}else{
	echo "<div class='insert'>
    <strong>Please</strong>Check your outdate
   </div>";
   $error=1;
	
}


$iyear=(int)($indate[2].$indate[3]);
$imonth=(int)($indate[5].$indate[6]);
$iday=(int)($indate[8].$indate[9]);
if($oyear<=$iyear)
{
	if($dyear==$iyear and $omonth<=$imonth){
		if($omonth==$imonth and $oday<=$iday){
		$error='';}
else{
	echo "<div class='insert'>
    <strong>Please</strong>Check your outdate
   </div>";
   $error=1;
}
	}
else{
	echo "<div class='insert'>
    <strong>Please</strong>Check your outdate
   </div>";
   $error=1;
	
	
}}else{
	echo "<div class='insert'>
    <strong>Please</strong>Check your outdate
   </div>";
   $error=1;
	
}


if(strlen($outdate)==0){
    $_SESSION['oerror']=true;
    $error=1;
}
if(strlen($outtime)==0){
    $_SESSION['ooerror']=true;
    $error=1;
}
if(strlen($indate)==0){
    $_SESSION['ierror']=true;
    $error=1;
}
if(strlen($intime)==0){
    $_SESSION['iierror']=true;
    $error=1;
}
if(strlen($place)==0){
    $_SESSION['perror']=true;
    $error=1;
}
if(strlen($reason)==0){
    $_SESSION['rerror']=true;
    $error=1;
}

   if($error==1){
	    echo "<div class='insert'>
    <strong>Failed </strong>to send outing request</div>";}
   else{	   
    $query="SELECT * FROM `studentout_req` WHERE `status`='pending' AND `rollno`='$regno'";
    $result=mysqli_query($conn,$query);
    $rows=mysqli_num_rows($result);
    if($rows==0){
    $query="INSERT INTO `studentout_req` VALUES('$regno','$outdate','$outtime','$indate','$intime','$place','$reason','$date','$status','')";
    $result=mysqli_query($conn,$query);
    echo "<div class='insert1'>
    <strong>Success </strong>Your outing request has been sent successfully
   </div>";
    }
    else{
    echo "<div class='insert1'>
    <strong>Failed </strong>you have already pending request 
   </div>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Complaint Form </title>
    <link rel="stylesheet" href="css/studentcomplaint.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@500&display=swap" rel="stylesheet">
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
    <div id="form">
        <form action="studentoutreq.php" method="POST">
         <h1>Student Outing Request Form</h1>
          <label id="com">Out Date</label><input type="date"  name="outdate" class="reg"><br>
		   <?php 
           if(isset($_SESSION['oerror'])){
                if($_SESSION['oerror']){
                    echo "<div class='first'>*Outdate cannot be empty</div>";
                    $_SESSION['oerror']=false;
                }
            }
                
            
            ?> 
          <label id="com">Out time</label><input type="time" name="outtime" class="reg" min="09:00" max="18:00"><br>
		   <?php 
           if(isset($_SESSION['ooerror'])){
                if($_SESSION['ooerror']){
                    echo "<div class='first'>*Outtime cannot be empty</div>";
                    $_SESSION['ooerror']=false;
                }
            }
                
            
            ?> 
          <label id="com">In Date</label><input type="date"  name="indate" class="reg"><br>
		  <?php 
           if(isset($_SESSION['ierror'])){
                if($_SESSION['ierror']){
                    echo "<div class='first'>*Indate cannot be empty</div>";
                    $_SESSION['ierror']=false;
                }
            }
                
            
            ?> 
          <label id="com">In time</label><input type="time" name="intime" class="reg" min="09:00" max="18:00"><br>
		  <?php 
           if(isset($_SESSION['iierror'])){
                if($_SESSION['iierror']){
                    echo "<div class='first'>*Intime cannot be empty</div>";
                    $_SESSION['iierror']=false;
                }
            }
                
            
            ?> 
          <label id="com">Place</label><input type="text"  name="place" class="reg"><br>
		  <?php 
           if(isset($_SESSION['perror'])){
                if($_SESSION['perror']){
                    echo "<div class='first'>*Place cannot be empty</div>";
                    $_SESSION['perror']=false;
                }
            }
                
            
            ?> 
            <label id="com">Reason for Outing:</label>
			
            <textarea rows="3" cols="50" id="cbox" name="reason" placeholder="enter your complaint"></textarea><br>
			<?php 
           if(isset($_SESSION['rerror'])){
                if($_SESSION['rerror']){
                    echo "<div class='first'>*Reason cannot be empty</div>";
                    $_SESSION['rerror']=false;
                }
            }
                
            
            ?> 
            <div>  
                <input id="btn" type="submit" name='submit'>  
            </div>
        </form>
    </div>
    </div>
</body>
</html>

