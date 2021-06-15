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
   if(isset($_SESSION['sub'])){
       if($_SESSION['sub']==true){
         $tempp=$_SESSION['cmpno'];
        echo "<div class='insert1'>
        <strong>Success! </strong>Complaint with id $tempp Accepted
        </div>";
           $_SESSION['sub']=false;
       }
   }
   if(isset($_POST['submit'])){
       session_start();
       $regno=$_SESSION['rollno'];
       $cmpid=rand(111111,999999);
       $subject=$_POST['sub'];
       $complaint=$_POST['comment'];
	   $error=0;
if(strlen($subject)==0){
    $_SESSION['serror']=true;
    $error=1;
}
if(strlen($complaint)==0){
    $_SESSION['cerror']=true;
    $error=1;
}
       $date=date('d/m/y');
       $conn=mysqli_connect("localhost","root","","HMS");
	   if($error==0){
       $query="INSERT INTO `student_complaints` VALUES('$regno',$cmpid,'$subject','$complaint','$date')";
       $result=mysqli_query($conn,$query);
       if($result){
       $_SESSION['sub']=true;
       $_SESSION['cmpno']=$cmpid;
       header('Location: studentcomplaint.php');
       }
	   }
	   else{
    $var=true;
}
if($var==true){
    echo "<div class='insert'>
    <strong>Failed </strong>To give  a complaint
    </div>";
    
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
<nav>
        <div id="header">
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
                    <a href="#facilities">AboutUs</a>
                </li>
                </ul>
                <ul id="other">
                <li class="profile">
                    <a href="#"><img src="images/prof.png"></a>
                    <ul>
                        <li><a href="studentprofile.php">Profile</a></li>
                        <li><a href="#">Logout</a></li>
                     </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="total">
    <div id="form">
        <form action="studentcomplaint.php" method="POST">
         <h1>Student Complaint Form</h1>
          <label id="com">Subject of the complaint:</label><input type="text"  name="sub" class="reg" placeholder="enter the subject"><br>
		  <?php 
           if(isset($_SESSION['serror'])){
                if($_SESSION['serror']){
                    echo "<div class='first'>*Subject cannot be empty</div>";
                    $_SESSION['serror']=false;
                }
            }
                
            
            ?> 
            <label id="com">Complaint:</label> 
            <textarea name="comment" rows="3" cols="50" id="cbox"  placeholder="enter your complaint"></textarea><br>
            <?php 
           if(isset($_SESSION['cerror'])){
                if($_SESSION['cerror']){
                    echo "<div class='first'>*Complaint cannot be empty</div>";
                    $_SESSION['cerror']=false;
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
