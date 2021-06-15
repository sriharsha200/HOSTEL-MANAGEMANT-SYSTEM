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
function search($complaint){
      $tabel="";
      include('connect.php');
      $query="SELECT * FROM `accept_complaints` WHERE `Complaintid`=$complaint";
      $result=mysqli_query($conn,$query);
      $norows=mysqli_num_rows($result);
      if($norows>0){
          $tabel='accept_complaints';
      }
      if($norows==0){
        $query="SELECT * FROM `reject_complaints` WHERE `Complaintid`=$complaint";
        $result=mysqli_query($conn,$query);
        $norows=mysqli_num_rows($result);
        if($norows>0){
            $tabel='reject_complaints';
        }
      }
      if($norows==0){
        $query="SELECT * FROM `solved_complaints` WHERE `Complaintid`=$complaint";
        $result=mysqli_query($conn,$query);
        $norows=mysqli_num_rows($result);
        if($norows>0){
            $tabel='solved_complaints';
        }
      }
      if($norows==0){
        $query="SELECT * FROM `student_complaints` WHERE `Complaintid`=$complaint";
        $result=mysqli_query($conn,$query);
        $norows=mysqli_num_rows($result);
        if($norows>0){
            $tabel='student_complaints';
        }
      }
      return $tabel;
}
include('connect.php');
$rollno=$_SESSION['rollno'];
$dates=array();
$id=array();
$query="SELECT * FROM `accept_complaints` WHERE `rollno`='$rollno'";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)){
    $dates[]=$row['Accept_date'];
    $id[]=$row['Complaintid'];
}
$query="SELECT * FROM `reject_complaints` WHERE `rollno`='$rollno'";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)){
    $dates[]=$row['Reject_date'];
    $id[]=$row['Complaintid'];
}
$query="SELECT * FROM `solved_complaints` WHERE `rollno`='$rollno'";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)){
    $dates[]=$row['Solved_date'];
    $id[]=$row['Complaintid'];
}
$query="SELECT * FROM `student_complaints` WHERE `rollno`='$rollno'";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)){
    $dates[]=$row['Date'];
    $id[]=$row['Complaintid'];
}
$dat=array();
$i=0;
foreach($dates as $d){
    $temp=array();
    $temp[]=$d[6].$d[7];
    $temp[]=$d[3].$d[4]; 
    $temp[]=$d[0].$d[1];
    $temp[]=$id[$i];
    $dat[]=$temp;
    $i=$i+1;
}
sort($dat);
$c=count($dates);
if($c==0){
  echo "<div class='norows'>No Complaints Posted Yet</div>";
}
else{
$sdate=array();
for($i=$c-1;$i>=0;$i--){ 
    $sdate[]=$dat[$i][2].'/'.$dat[$i][1].'/'.$dat[$i][0]." ".$dat[$i][3];
}
$fn=1;
for ($i=0; $i < count($sdate); $i++) { 
       $temp=$sdate[$i];
       $complaintid=(int)substr($temp,9,14);
       $tabel=search($complaintid);
       $div='myDIV'.strval($fn);  
       echo "<div class=tb>
      <table>
      <tr>
      <th>Complaintid</th>
      <th>Subject</th>
      <th>Date</th>
      <th>Status</th>
      <th>Status date</th>
      <th>reason for current status</th>
      </tr>";
      $query="SELECT * FROM `$tabel` WHERE `Complaintid`=$complaintid";
      $result=mysqli_query($conn,$query);
      $row=mysqli_fetch_assoc($result);
      $subject=$row['Subject'];
      $date=$row['Date'];
      $complaint=$row['Complaint'];
      if($tabel=='accept_complaints'){
        $status='Accepted';
        $statusdate=$row['Accept_date'];
        $reason="Valid complaint";
      }
      if($tabel=='reject_complaints'){
        $status='Rejected';
        $statusdate=$row['Reject_date'];
        $reason="Invalid complaint";
      }
      if($tabel=='solved_complaints'){
        $status='Solved';
        $statusdate=$row['Solved_date'];
        $reason="Thanks for informing us";
      }
      if($tabel=='student_complaints'){
        $status='Pending';
        $statusdate='';
        $reason="Yet to be Seen";
      }
      echo "<tr>
      <td>$complaintid</td>
      <td>$subject</td>
      <td>$date</td>
      <td>$status</td>
      <td>$statusdate</td>
      <td>$reason</td>
      </tr>
      </table>
      <d id='bt'>
        <button class='btn1' onclick='fun($fn)'>Complaint</button>
      <d>
      <div class='cbox' id=$div>
        $complaint
      </div>
    </div>"; 
      $fn+=1;
    }
}
?>
    <script>
    var rows='<?php echo $c ?>';
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
</div>
  </body>
  </html>
