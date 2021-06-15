<?php
session_start();
if(isset($_POST["submit"])){
    include("connect.php");
  $reason=$_POST["rejectreason"];  
  $reg=$_SESSION["rollno"];
  $query="SELECT * FROM `studentout_req` WHERE `status`='reject' AND `rejectreason`='' AND `rollno`='$reg'";
  $result=mysqli_query($conn,$query);
  $row=mysqli_num_rows($result);
  if($row>0){
     $query="UPDATE `studentout_req` SET `rejectreason` ='$reason' WHERE `status`='reject' AND `rejectreason`='' AND `rollno`='$reg'";
     $result=mysqli_query($conn,$query);
     header("Location: grantouting.php");
  }
}
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="css/dialoguebox.css">

      <link rel="shortcut icon" href="./images/anitslogo2.png" type="image/x-icon"> 
  </head>
  <body>
<div class="dbox">
    <div class="dbox2">
      <h1> Reason for Rejection</h1>
      <form action="dialoguebox.php" method="POST">
            <textarea rows="3" class="inp" placeholder="Enter valid reason" cols="50" name="rejectreason"></textarea><br><br>
            <input type="submit" class="imp" name="submit" value="submit"></a>  
            </form>
      </form>
    </div>
  </div>
  </body>
  </html>
  
