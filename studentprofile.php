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
$query="SELECT * FROM `reg_details` WHERE `regno`='$regno'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$rows=mysqli_num_rows($result);
if($rows==1){
  $table='reg_details';
}
if($rows==0){
  $query="SELECT * FROM `second_years` WHERE `regno`='$regno'";
  $result=mysqli_query($conn,$query);
  $row=mysqli_fetch_assoc($result);
  $rows=mysqli_num_rows($result);
  if($rows==1){
    $table='second_years';
  }
}
if($rows==0){
  $query="SELECT * FROM `third_years` WHERE `regno`='$regno'";
  $result=mysqli_query($conn,$query);
  $row=mysqli_fetch_assoc($result);
  $rows=mysqli_num_rows($result);
  if($rows==1){
    $table='third_years';
  }
}
if($rows==0){
  $query="SELECT * FROM `final_details` WHERE `regno`='$regno'";
  $result=mysqli_query($conn,$query);
  $row=mysqli_fetch_assoc($result);
  $rows=mysqli_num_rows($result);
  if($rows==1){
    $table='final_details';
  }
}
$studentname=$row['fname'].' '.$row['lname'];
$course=$row['course'];
$year=$row['year'];
$branch=$row['branch'];
$dob=$row['dob'];
$pno=$row['phone_number'];
$ppno=$row['pphone_number'];
$gender=$row['gender'];
$roomno=$row['room'];
$mess=$row['mess'];
if(isset($_POST['upload'])){
	$target="images/".basename($_FILES['image']['name']);
	$image=$_FILES['image']['name'];
	$sql="UPDATE `$table` SET `image`='$image' WHERE `regno`='$regno'";
	mysqli_query($conn,$sql);
  $msg="";
  if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
    $msg="upload sucess";
    }
    else
    { 
      $msg="error uploading file";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Student Profile</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>  
	    <link rel="stylesheet" href="css/studprof.css">
		<link rel="stylesheet" href="css/navbar.css">
    <link rel="shortcut icon" href=<?php echo "./images/$img" ?> type="image/x-icon"> 
</head>
<body>
<div class="header">
<nav>
        
            <div>
                <a href = "home.php" class ="logo"><img src="images/anitslogo2.png" alt="can't load the logo"></a>
                <div id="divid">
                <h2>Hostel Management</h2></div>
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
<header class="ScriptHeader">
    <div class="rt-container">
    	<div class="col-rt-12">
        	<div class="rt-heading">
            	<h2>My Profile</h2>
                </div>
        </div>
    </div>
</header>

<section>
    <div class="rt-container">
          <div class="col-rt-12">
              <div class="Scriptcontent">
              
<!-- Student Profile -->
<div class="student-profile py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent text-center">
          <?php
    
          include("connect.php");
          $sql="SELECT * from `third_years` where regno='$regno'";
          $result=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_array($result)){
            echo "<img class='profile_img' src='images/".$row['image']."'>";
         }
	
?>
          <form action="studentprofile.php" method="POST" enctype="multipart/form-data">
		            <input type="hidden" name="size" vale="1000000">
                <input  type="file" name="image"  alt="student dp">
		          	<input type="submit" name="upload" value="Upload">
                </form>            
            <h3><?php echo $studentname ?></h3>
          </div>
          <div class="card-body">
            <p class="mb-0"><strong class="pr-1">Email ID:</strong><?php echo $studentname ?></p>
            <p class="mb-0"><strong class="pr-1">Regno:</strong><?php echo $regno ?></p>
            <p class="mb-0"><strong class="pr-1">Course:</strong><?php echo $course ?></p>
			<p class="mb-0"><strong class="pr-1">Year:</strong><?php echo $year ?></p>
			<p class="mb-0"><strong class="pr-1">Branch:</strong><?php echo $branch ?></p>
			
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Personal Details</h3>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tr>
                <th width="30%">Name</th>
                <td width="2%">:</td>
                <td><?php echo $studentname ?></td>
              </tr>
			  <tr>
                <th width="30%">DOB</th>
                <td width="2%">:</td>
                <td><?php echo $dob ?></td>
              </tr>
			  <tr>
                <th width="30%">Phone Number</th>
                <td width="2%">:</td>
                <td><?php echo $pno ?></td>
              </tr>
			  <tr>
                <th width="30%">Parent Phone Number</th>
                <td width="2%">:</td>
                <td><?php echo $ppno ?></td>
              </tr>
              <tr>
                <th width="30%">Gender</th>
                <td width="2%">:</td>
                <td><?php echo $gender ?></td>
              </tr>
            </table>
          </div>
        </div>
          <div style="height: 26px"></div>
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Hostel Details</h3>
          </div>
          <div class="card-body pt-0">
		  <table class="table table-bordered">
              <tr>
                <th width="30%">Room No</th>
                <td width="2%">:</td>
                <td><?php 
                if($roomno==0){
                    echo "Room not allocated";
                }
                else{
                  echo $roomno;
                } ?></td>
              </tr>
			  <tr>
                <th width="30%">Mess</th>
                <td width="2%">:</td>
                <td><?php echo $mess ?></td>
              </tr>
			  </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
           
    		</div>
		</div>
    </div>
</section>
     
    </div>

    <!-- Analytics -->

	</body>
</html>
