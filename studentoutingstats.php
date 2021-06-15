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
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="css/studentcompstat.css">
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
                      <li><a href="logout.php">Logout</a></li>
                  </ul>
              </li>
              </ul>
          </div>
      
  </nav>
  </div>
  <div class="total">
    <?php
    
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
    $fn=1;
    include("connect.php");
    $regno=$_SESSION['rollno'];
    $query="SELECT * FROM `studentout_req` WHERE `rollno`='$regno' ORDER BY `outdate` DESC";
    $res=mysqli_query($conn,$query);
    $norows=mysqli_num_rows($res);
    if($norows==0){
      echo "<div class='norows'>There are no outing request found</div>";
    }
    while($row=mysqli_fetch_assoc($res)){
    $div='myDIV'.strval($fn);
    $rejectstatus=$row["rejectreason"];
    echo "<div class=tb>
    <table>
      <tr>
      <th>Date</th>
      <th>Reg No</th>
      <th>Name</th>
      <th>Room no</th>
      <th>Status</th>";
      if($rejectstatus!=''){
        echo "<th>Reject Status</th>";
      }
      echo "</tr>";
        $regno=$row['rollno'];
        $date=$row['date'];
        $outdate=$row['outdate'];
        $outtime=$row['outtime'];
        $intime=$row['intime'];
        $indate=$row['indate'];
        $reason=$row['reason'];
        $status=$row['status'];
        $place=$row['place'];
        $tab=search($regno);
        $query="SELECT *FROM `$tab` WHERE `regno`='$regno'";
        $result=mysqli_query($conn,$query);
        $r=mysqli_fetch_assoc($result);
        $name=$r['fname'].' '.$r['lname'];
        $roomno=$r['room'];
        $year=$r['year'];
        $studentphno=$r['phone_number'];
        $parentsphno=$r['pphone_number'];
      echo "<tr>
      <td>$date</td>
      <td>$regno</td>
      <td>$name</td>
      <td>$roomno</td>
      <td>$status</td>";
      if($rejectstatus!=''){
        echo "<td>$rejectstatus</td>";
      } 
      echo "</tr>
      </table>
      </div>
      <d id='bt'>
        <button class='btn1' onclick='fun($fn)'>Details</button>
      <d>
      <div class='cbox' id=$div>
      <table>
      <tr>
        <td>Year</td>
        <td>: $year</td>
        <td>Place</td>
        <td>: $place</td>
      </tr>
      <tr>
        <td>Out Date</td>
        <td>: $outdate</td>
        <td>Out Time</td>
        <td>: $outtime</td>
      </tr>
      <tr>
        <td>In Date</td>
        <td>: $indate</td>
        <td>In Time</td>
        <td>: $intime</td>
      </tr>
      <tr>
        <td>Student Phno</td>
        <td>: $studentphno</td>
        <td>Parent Phno</td>
        <td>: $parentsphno</td>
      </tr>
    </table>
    <h4>Reason:</h4><p>$reason</p>
     
    </div>"; 
      $fn+=1;
    }
    ?>
    <?php
      include("connect.php");
      if(isset($_POST['accept'])){
        $rvalue=1;
        $val=$_POST['accept'];
        $query="SELECT * FROM `studentout_req` WHERE `status`='pending' ORDER BY `outdate` ASC";
        $result=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($result)){  
        if($rvalue==$val){
          $reg=$row['regno'];  
          $query="UPDATE `studentout_req` SET `status`='accepted' WHERE `regno`='$reg'";
          $result=mysqli_query($conn,$query);
          $_SESSION['accept']=true;
          $_SESSION['reject']=false;
          $_SESSION['rollno']=$row['Rollno'];
          header("Location: grantouting.php");
        }
        $rvalue=$rvalue+1;
    }
      }
      if(isset($_POST['reject'])){
        $rvalue=1;
        $val=$_POST['reject'];
        $query="SELECT * FROM `studentout_req` WHERE `status`='pending' ORDER BY `outdate` ASC";
        $result=mysqli_query($conn,$query);
      while($row=mysqli_fetch_assoc($result)){
      if($rvalue==$val){
        $reg=$row['regno'];  
        $query="UPDATE `studentout_req` SET `status`='reject' WHERE `regno`='$reg'";
        $res=mysqli_query($conn,$query);
        $_SESSION['reject']=true;
        $_SESSION['accept']=false;
        $_SESSION['rollno']=$row['Rollno'];
        $_SESSION['complaintid']=$row['Complaintid'];
        echo $rowr." ".$no;
        header("Location: grantouting.php");
    }
      $rvalue=$rvalue+1;
  }
      }
    ?>
    <script>
    var rows='<?php echo $norows ?>';
    var ids='';
    for(var i=1;i<=rows;i++){
    ids='myDIV'+i
    var x = document.getElementById(ids);
    x.style.display = "none";
    }
  function fun(ids){ 
    var num=ids;
    var v='<?php echo $fn ?>';
    var id="myDIV"+num;
    console.log(num,id,v);
    var x = document.getElementById(id);
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
    </script>
  </table>
  </div>
  </body>
  </html>
