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
if(isset($_POST['submit'])){
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$regno = $_POST["regno"];
$course = $_POST["course"];
$branch = $_POST["branch"];
$dob = $_POST["dob"];
$address = $_POST["address"];
$sphoneno = $_POST["sphoneno"];
$fathername = $_POST["fathername"];
$mothername = $_POST["mothername"];
$pphoneno = $_POST["pphoneno"];
if(isset($_POST['gender'])){
    $gender = $_POST["gender"];
}
$year = $_POST["year"];
$room =0;
if(isset($_POST['mess'])){
    $mess = $_POST["mess"];
}
$error=0;
if(strlen($fname)==0){
    $_SESSION['ferror']=true;
    $error=1;
}
else if((preg_match_all('/^[a-zA-Z]+$/', $fname))==0){
    $_SESSION['fmerror']=true;
    $error=1;
}
if(strlen($lname)==0){
    $_SESSION['lerror']=true;
    $error=1;
}
else if((preg_match_all('/^[a-zA-Z]+$/', $lname))==0){
    $_SESSION['lmerror']=true;
    $error=1;
}
if((preg_match('/^[a-zA-Z\d\.]+@[a-zA-Z\d]+\.[a-zA-Z\d\.]{2,}+$/',$email))==0){
    $_SESSION['emailerr']=true;
    $error=1;
}
if((preg_match('/^[\d]{10}$/',$sphoneno))==0){
    $_SESSION['sphonerr']=true;
    $error=1;
}
if((preg_match('/^[\d]{10}$/',$pphoneno))==0){
    $_SESSION['pphonerr']=true;
    $error=1;
}
if(strlen($fathername)==0){
    $_SESSION['fathererror']=true;
    $error=1;
}
else if((preg_match_all('/^[a-zA-Z]+$/', $fathername))==0){
    $_SESSION['fathermerror']=true;
    $error=1;
}
if(strlen($mothername)==0){
    $_SESSION['mothererror']=true;
    $error=1;
}
else if((preg_match_all('/^[a-zA-Z]+$/', $mothername))==0){
    $_SESSION['mothermerror']=true;
    $error=1;
}
if((preg_match_all('/^[0-9]$/',$year))==0){
    $_SESSION['yearerr']=true;
    $error=1;
}

include("connect.php");
if($year==1){
    $table='reg_details';
}
else if($year==2){
    $table='second_years';
}
else if($year==3){
    $table='third_years';
}
else if($year==4){
    $table='final_years';
}
$var=false;

if($error==0){
if(isset($_POST['gender'])){
    if(isset($_POST['mess'])){
        echo $table;
    $query="INSERT INTO `$table` VALUES('$fname','$lname','$email','$regno','$course','$branch','$dob','$address',$sphoneno,'$fathername','$mothername',$pphoneno,'$gender',$year,$room,'$mess','')";
    $result=mysqli_query($conn,$query);
    if($result){
        echo "<div class='insert'>
        <strong>Success </strong>details of $regno inserted successfully
        </div>";
        }
    $query="INSERT INTO `student_details` VALUES('$regno','hms')";
    $result=mysqli_query($conn,$query);
}
}
}
else{
    $var=true;
}
if($var==true){
    echo "<div class='insert'>
    <strong>Failed </strong>to store $regno details
    </div>";
    
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
       <form action="regform.php" method="POST">
        <h1>Register!</h1>
            <label class="label">Firstname:</label><input type="text"  class="inp"  name="fname"  placeholder="First name">
           <?php 
           if(isset($_SESSION['ferror'])){
                if($_SESSION['ferror']){
                    echo "<div class='first'>*Firstname cannot be empty </div>";
                    $_SESSION['ferror']=false;
                }
            }
                if(isset($_SESSION['fmerror'])){
                  if($_SESSION['fmerror']){
                    echo "<div class='first'>*Firstname cannot have integers </div>";
                    $_SESSION['fmerror']=false;
                }
            }
            ?> 
            <label class="label">Lastname:</label><input type="text"  class="inp"  name="lname"  placeholder="Last name">
            <?php 
             if(isset($_SESSION['lerror'])){
                if($_SESSION['lerror']){
                    echo "<div class='first'>*Lastname cannot be empty </div>";
                    $_SESSION['lerror']=false;
                }
            }
                if(isset($_SESSION['lmerror'])){
                  if($_SESSION['lmerror']){
                    echo "<div class='first'>*Lastname cannot have integers </div>";
                    $_SESSION['lmerror']=false;
                }
            }
            ?>
            <lable class="lable">Email ID:</lable>  <input type="text"  class="inp"  name="email"  placeholder="EmailId">
            <?php
            if(isset($_SESSION['emailerr'])){
                  if($_SESSION['emailerr']){
                      if(strlen($email)!=0){

                    echo "<div class='first'>*Invalid email id </div>";
                      }
                      else{
                        echo "<div class='first'>*Email id cannot be empty </div>"; 
                      }
                    $_SESSION['emailerr']=false;
                }
            }
            
            ?>
            <lable class="lable">Registration No:</lable>  <input type="text" class="inp"  name="regno"  placeholder="Registration no">
            <lable class="lable">Course:</lable> 
            <select class="drop" name="course">  
                <option value="Course">Course</option>  
                <option value="Btech">Btech</option>  
                <option value="Mtech">Mtech</option>   
                </select>  
            <lable class="lable">Branch:</lable> 
            <select class="drop" name="branch" placeholder="Branch">  
                <option value="Branch">Branch</option>  
                <option value="CSE">CSE</option>  
                <option value="CSM">CSM</option>   
                <option value="CSD">CSD</option>   
                <option value="ECE">ECE</option>   
                <option value="EEE">EEE</option>   
                <option value="CIV">CIV</option>   
                <option value="CHE">CHE</option>   
                <option value="MECH">MECH</option>   
            </select>  
            <label class="lable">Date Of Birth:</label> <input type="date" class="inp" name="dob" ><br>
            <lable class="lable"class="lable">Residential Address:</lable><textarea rows="3" class="inp" placeholder="" cols="50" name="address"></textarea><br>
            <lable class="lable">Student PhoneNo:</lable><input type="tel" placeholder="Student PhoneNo" name="sphoneno" class="inp"><br>
           <?php
            if(isset($_SESSION['sphonerr'])){
                if($_SESSION['sphonerr']){
                    echo "<div class='first'>*Invalid Phone number </div>";
                    $_SESSION['sphonerr']=false;
                }
            }
            ?>
            <lable class="lable">Father name:</lable><input type="text"  class="inp" placeholder="Father name" name="fathername"  name="fathername" br>
          <?php 
            if(isset($_SESSION['fathererror'])){
                if($_SESSION['fathererror']){
                    echo "<div class='first'>*Fathername cannot be empty </div>";
                    $_SESSION['fathererror']=false;
                }
            }
                if(isset($_SESSION['fathermerror'])){
                  if($_SESSION['fathermerror']){
                    echo "<div class='first'>*Fathername cannot have integers </div>";
                    $_SESSION['fathermerror']=false;
                }
            }
            ?>
            <lable class="lable">Mother name:</lable><input type="text"  class="inp" placeholder="Mother name" name="mothername" br>
       <?php 
                if(isset($_SESSION['mothererror'])){
                if($_SESSION['mothererror']){
                    echo "<div class='first'>*Mothername cannot be empty </div>";
                    $_SESSION['mothererror']=false;
                }
            }
                if(isset($_SESSION['mothermerror'])){
                  if($_SESSION['mothermerror']){
                    echo "<div class='first'>*Mothername cannot have integers </div>";
                    $_SESSION['mothermerror']=false;
                }
            }
            ?>
            <lable class="lable">Parent/Guardian PhoneNo:</lable><input type="tel" placeholder="Parent/Guardian PhoneNo:" name="pphoneno" class="inp"  pattern="^\d{10}$" ><br>
            <?php
            if(isset($_SESSION['pphonerr'])){
                if($_SESSION['pphonerr']){
                    echo "<div class='first'>*Invalid Phone number </div>";
                    $_SESSION['pphonerr']=false;
                }
            }
            ?>
            <lable class="lable">Gender:</lable>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br><br>

            <lable class="lable">Year:</lable> <input type="number" name="year" class="inp" placeholder="Year" ><br>
            <?php
            if(isset($_SESSION['yearerr'])){
                if($_SESSION['yearerr']){
                    echo "<div class='first'>*Invalid Year</div>";
                    $_SESSION['yearerr']=false;
                }
            }
            ?>
            
            <p>Mess:</p>
            <input type="radio" id="Veg" name="mess" value="Veg" >
            <label for="Veg">Veg</label>
            <input type="radio" id="Non-Veg" name="mess" value="Non-Veg">
            <label for="Non-Veg">Non-Veg</label><br>
            <div style="text-align:center">
                <input id="btn" name="submit" type="submit"/>
                
            </div>
         </form>
   </div>
</body>
</html>
