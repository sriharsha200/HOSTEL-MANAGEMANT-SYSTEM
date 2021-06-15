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
    echo "<div class='insert'>Please recheck room number having at least one empty bed (Color Green) </div>";
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
	<link rel="stylesheet" href="css/roomstatus.css">
  <link rel="shortcut icon" href="./images/anitslogo2.png" type="image/x-icon"> 
</head>
<body>
    <h1>SENIOR GIRLS HOSTEL ROOM STATUS</h1>
	<div class="container">
		<table>
            <tr>
              <th>First Floor</th>
              <th>Second Floor</th>
              <th>Third Floor</th>
              <th>Fourth Floor</th>
           </tr>
             <?php  
             include("connect.php");
             if(isset($_POST['submit'])){
              header("Location:roomallotment.php");
            }
            
             $room=101;$no_rooms=15;$count=1;
             $p1="dot";$p2="dot1";
             while($count<=$no_rooms){
              echo "<tr>";
             for($i=0;$i<4;$i++){
               $rows=0;
              $query="SELECT * FROM `second_years` WHERE `room`=($room+$i*100) AND `gender`='female'";  
              $result=mysqli_query($conn,$query);  
              $rows+=mysqli_num_rows($result); 
              $query="SELECT * FROM `third_years` WHERE `room`=($room+$i*100) AND `gender`='female'";  
              $result=mysqli_query($conn,$query);  
              $rows+=mysqli_num_rows($result); 
              $query="SELECT * FROM `final_years` WHERE `room`=($room+$i*100) AND `gender`='female'";  
              $result=mysqli_query($conn,$query);  
              $rows+=mysqli_num_rows($result); 
              if($rows==0){
                  $p1='dot';$p2='dot';$p3='dot';
              }
              if($rows==1){
                $p1='dot';$p2='dot1';$p3='dot';
              }
              if($rows==2){
                $p1='dot';$p2='dot1';$p3='dot1';
             }
              if($rows==3){
              $p1='dot1';$p2='dot1';$p3='dot1';
             }
             $s1='<td>'.($room+$i*100).'<div class="dots"><span class='.$p1.'></span><span class='.$p2.'></span><span class='.$p3.'></span></div></td>';
             echo $s1;
             }
             echo '</tr>';
             $room=$room+1;
             $count+=1;
             } 
             ?>
		</table>

	</div>
  <br>
	<div class="foot"><span class="dot"></span> Empty beds <span class="dot1"></span> Filled beds</div>
  <br>
  <br>
  <form action="seniorgirlshostel.php" method="post">
  <div style="text-align:center">
                <input id="btn" name="submit" type="submit"/>
            </div>
  </form>
</body>
</html>