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
    $insert=false;
$regno = $_POST["regno"];
if($regno!=''){
$email = $_POST["email"];
$branch = $_POST["branch"];
$address = $_POST["address"];
$sphoneno = $_POST["sphoneno"];
$pphoneno = $_POST["pphoneno"];
$roomno = $_POST["roomno"];
if(isset($_POST['mess'])){
    $mess = $_POST["mess"];
}

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

if($email!=''){
	$query="UPDATE `$table` SET email='$email' WHERE regno='$regno'";
	mysqli_query($conn,$query);
    $insert=true;
} 
if($branch!=''){
	$query="UPDATE `$table` SET branch='$branch' WHERE regno='$regno'";
	mysqli_query($conn,$query);
    $insert=true;
} 
if($address!=''){
	$query="UPDATE `$table` SET address='$address' WHERE regno='$regno'";
	mysqli_query($conn,$query);
    $insert=true;
} 
if($sphoneno!=''){
	$query="UPDATE `$table` SET phone_number=$sphoneno WHERE regno='$regno'";
	mysqli_query($conn,$query);
    $insert=true;
} 
if($pphoneno!=''){
	$query="UPDATE `$table` SET pphone_number=$pphoneno WHERE regno='$regno'";
	mysqli_query($conn,$query);
    $insert=true;
} 
if($roomno!=''){
	$query="UPDATE `$table` SET room=$roomno WHERE regno='$regno'";
	mysqli_query($conn,$query);
    $insert=true;
} 
if(isset($_POST['mess'])){
if($mess!=''){
	$query="UPDATE `$table` SET Mess='$mess' WHERE regno='$regno'";
	mysqli_query($conn,$query);
    $insert=true;
}
} 
}
else{
    echo "<div class='insert'>
    <strong>Failed! </strong>the reg no $regno not found
    </div>";
}
}
if($insert==true){
echo "<div class='insert'>
    <strong>Success </strong>details of $regno updated successfully
    </div>";
}
}

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student updation </title>
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
       <form action="adminupdate.php" method="POST">
        
        <h1>Update!</h1>
		<br><br>
		    <label class="label">Registration No:</label>  <input type="text" class="inp"  name="regno"  placeholder="Registration no">
            <label class="label">Email ID:</label>  <input type="text"  class="inp"  name="email"  placeholder="EmailId">
            <label class="label">Branch:</label> 
            <select class="drop" name="branch" placeholder="Branch">  
                <option value="">Branch</option>  
                <option value="CSE">CSE</option>  
                <option value="CSM">CSM</option>   
                <option value="CSD">CSD</option>   
                <option value="ECE">ECE</option>   
                <option value="EEE">EEE</option>   
                <option value="CIV">CIV</option>   
                <option value="CHE">CHE</option>   
                <option value="MECH">MECH</option>   
            </select>  
             
            
            <label class="label"class="lable">Residential Address:</lable><textarea rows="3" class="inp" placeholder="Address" cols="50" name="address"></textarea><br>
            <label class="label">Student PhoneNo:</label><input type="tel" placeholder="Student PhoneNo" name="sphoneno" class="inp" pattern="^\d{10}$" /><br>
            
            <label class="label">Parent/Guardian PhoneNo:</label><input type="tel" placeholder="Parent/Guardian PhoneNo:" name="pphoneno" class="inp"  pattern="^\d{10}$" ><br>
            <label class="label">Room No:</label> <input type="number" name="roomno" class="inp" placeholder="Room no" ><br>

            <p>Mess:</p>
            <input type="radio" id="Veg" name="mess" value="Veg" >
            <label for="Veg">Veg</label>
            <input type="radio" id="Non-Veg" name="mess" value="Non-Veg">
            <label for="Non-Veg">Non-Veg</label><br>
            <div style="text-align:center">
                <input id="btn" name="submit" type="submit">
            </div>
         </form>
   </div>
</body>
</html>
