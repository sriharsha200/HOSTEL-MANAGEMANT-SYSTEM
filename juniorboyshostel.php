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
    <h1>JUNIOR BOYS HOSTEL ROOM STATUS</h1>
	<div class="container">
		<table>
            <tr>
              <th>First Floor</th>
              <th>Second Floor</th>
              <th>Third Floor</th>
              <th>Fouth Floor</th>
           </tr>
           <?php 
             include("connect.php");
             if(isset($_POST['submit'])){
               header("Location:roomallotment.php");
             }


             $room=101;$no_rooms=13;$count=1;
             $p1="dot";$p2="dot1";
             while($count<=$no_rooms){
              echo "<tr>";
             for($i=0;$i<4;$i++){
              $query="SELECT * FROM `reg_details` WHERE `room`=($room+$i*100) AND `gender`='male'";  
              $result=mysqli_query($conn,$query);  
              $rows=mysqli_num_rows($result);
               if($rows==0){
                   $p1='dot';$p2='dot';$p3='dot';$p4='dot';
               }
               if($rows==1){
                 $p1='dot';$p2='dot1';$p3='dot';$p4='dot';
               }
               if($rows==2){
                 $p1='dot';$p2='dot1';$p3='dot1';$p4='dot';
              }
               if($rows==3){
                 $p1='dot1';$p2='dot1';$p3='dot1';$p4='dot';
              }
              if($rows==4){
                 $p1='dot1';$p2='dot1';$p3='dot1';$p4='dot1';
               }
              $s1='<td>'.($room+$i*100).'<div class="dots"><span class='.$p1.'></span><span class='.$p2.'></span><span class='.$p3.'></span><span class='.$p4.'></span></div></td>';
              echo $s1;
            }
              echo '</tr>';
              $room=$room+1;
              $count+=1;
              } 
          ?>
		</table>

	</div><br>
	<div class="foot"><span class="dot"></span> Empty beds <span class="dot1"></span> Filled beds</div>
  <br>
  <br>
  <form action="juniorboyshostel.php" method="post">
  <div style="text-align:center">
                <input id="btn" name="submit" type="submit" value="Continue"/>
            </div>
  </form>
</body>
</html>