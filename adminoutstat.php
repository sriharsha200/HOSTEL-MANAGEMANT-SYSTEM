<?php
session_start();
function search($regno){
  $tabel="none";
  include('connect.php');
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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HOSTEL MANAGEMENT SYSTEM</title>
        <link rel="stylesheet" href="css/adminoutstat.css" >
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
                        <a href="#facilities">AboutUs</a>
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
        <div class="searching">
        <form action="adminoutstat.php" method="POST">
          <input type="text" placeholder="Search..." name="search">
          <button type="submit" name='submit'>GO</button>
        </form>
        </div>
        <div class=tb>
          <?php
            $search=false;
            include('connect.php');
            if(isset($_POST['submit'])){
              $ser=$_POST['search'];
              if($ser!=''){
              $query="SELECT * FROM `studentout_req` WHERE `rollno`='$ser' ORDER BY `date` DESC";
              $result=mysqli_query($conn,$query);
              $rows=mysqli_num_rows($result);
              if($rows!=0){
              echo "<div class=insert>
                    Outing details of <b>$ser</b>
              </div>";
              $search=true;
              echo "<table>
             <tr>
              <th>Date</th>
              <th>Regno</th>
              <th>Name</th>
              <th>Roomno</th>
              <th>Year</th>
              <th>Out time</th>
              <th>Out Date</th>
              <th>In time</th>
              <th>In Date</th>
              <th>Place</th>
              <th>Student phno</th>
              <th>Parent phno</th>
              <th>Outing Status</th>
           </tr>";
           while($row=mysqli_fetch_assoc($result)){
           $outtime=$row['outtime'];
           $indate=$row['intime'];
           $intime=$row['intime'];
           $place=$row['place'];
           $reason=$row['reason'];
           $outdate=$row['outdate'];
           $regno=$row['rollno'];
           $date=$row['date'];
           $status=$row['status'];
           $table=search($regno);
           $q="SELECT * FROM `$table` WHERE regno='$ser'";
           $res=mysqli_query($conn,$q);
           $r=mysqli_fetch_array($res);
           $name=$r['fname'].' '.$r['lname'];
           $room=$r['room'];
           $year=$r['year'];
           $pno=$r['phone_number'];
           $ppno=$r['pphone_number'];
           echo "<tr>
             <td>$date</td>
             <td>$regno</td>
             <td>$name</td>
             <td>$room</td>
             <td>$year</td>
             <td>$outtime</td>
             <td>$outdate</td>
             <td>$intime</td>
             <td>$indate</td>
             <td>$place</td>
             <td>$pno</td>
             <td>$ppno</td>
             <td>$status</td>
           </tr>";
           }
         echo "</table>";
              }
              else{
                $r=true;
                echo "<div class=insert>
                    Outing details of <b>$ser</b> are not found
              </div>";
              }
            }  
          }
            if(!$search){  
            $query="SELECT * FROM `studentout_req` ORDER BY `date` DESC";
            $result=mysqli_query($conn,$query);
            $rows=mysqli_num_rows($result);
            if($rows!=0){
            echo "<table>
             <tr>
              <th>Date</th>
              <th>Regno</th>
              <th>Name</th>
              <th>Roomno</th>
              <th>Year</th>
              <th>Out time</th>
              <th>Out Date</th>
              <th>In time</th>
              <th>In Date</th>
              <th>Place</th>
              <th>Student phno</th>
              <th>Parent phno</th>
              <th>Outing Status</th>
           </tr>";
           while($row=mysqli_fetch_assoc($result)){
           $outtime=$row['outtime'];
           $indate=$row['intime'];
           $intime=$row['intime'];
           $place=$row['place'];
           $reason=$row['reason'];
           $outdate=$row['outdate'];
           $regno=$row['rollno'];
           $date=$row['date'];
           $status=$row['status'];
           $table=search($regno);
           $q="SELECT * FROM `$table` WHERE regno='$regno'";
           $res=mysqli_query($conn,$q);
           $r=mysqli_fetch_array($res);
           $name=$r['fname'].' '.$r['lname'];
           $room=$r['room'];
           $year=$r['year'];
           $pno=$r['phone_number'];
           $ppno=$r['pphone_number'];
           echo "<tr>
             <td>$date</td>
             <td>$regno</td>
             <td>$name</td>
             <td>$room</td>
             <td>$year</td>
             <td>$outtime</td>
             <td>$outdate</td>
             <td>$intime</td>
             <td>$indate</td>
             <td>$place</td>
             <td>$pno</td>
             <td>$ppno</td>
             <td>$status</td>
           </tr>";
           }
         echo "</table>";
        }
      }
         ?>
        </div>
    </body>
</html>