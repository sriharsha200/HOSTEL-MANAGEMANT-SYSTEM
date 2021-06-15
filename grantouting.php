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
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="css/grantouting.css">
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
  <div class="dbox">
    <div class="dbox2">
      <div class="close">+</div>
      <h1> Reason for Rejection</h1>
      <form action="grantouting.php" method="POST">
            <textarea rows="3" class="inp" placeholder="Enter valid reason" cols="50" name="rejectreason"></textarea><br><br>
            <input type="submit" class="imp" name="submit" value="Submit"></a>  
            </form>
      </form>
    </div>
  </div>
  <div class="total">

    <?php
  if(isset($_POST["submit"])){
    
  }  
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
    if(isset($_SESSION['accept'])){
      $tem=$_SESSION['accept'];
      if($tem==true) {   
        echo "<div class='insert'>
        <strong>Success </strong>Outing request accepted
        </div>";
      $_SESSION['accept']=false;
      }
    }
    if(isset($_SESSION['reject'])){
      $tem=$_SESSION['reject']; 
      if($tem==true) {   
        echo "<div class='insert1'>
        <strong> Outing request rejected </strong>
        </div>";
      $_SESSION['reject']=false;
      }
    }
    $fn=1;
    include("connect.php");
    $query="SELECT * FROM `studentout_req` WHERE `status`='pending' ORDER BY `outdate` ASC";
    $res=mysqli_query($conn,$query);
    $norows=mysqli_num_rows($res);
    if($norows==0){
      echo "<div class='norows'>There are no outing request found</div>";
    }
    while($row=mysqli_fetch_assoc($res)){
    $div='myDIV'.strval($fn);
    echo "<div class=tb>
    <table>
      <tr>
      <th>Date</th>
      <th>Reg No</th>
      <th>Name</th>
      <th>Room no</th>
      </tr>";
        $regno=$row['rollno'];
        $date=$row['date'];
        $outdate=$row['outdate'];
        $outtime=$row['outtime'];
        $intime=$row['intime'];
        $indate=$row['indate'];
        $reason=$row['reason'];
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
      </tr>
      </table>
      </div>
      <d id='bt'>
        <button class='btn1' onclick='fun($fn)'>Details</button>
        <form action='grantouting.php' method='POST'>
        <button class='btn'  name='accept' value=$fn>Accept</button>
        <button id='btn2' class='btn2' name='reject' value=$fn>Reject</button>
        </form>
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
          $reg=$row['rollno'];  
          $query="UPDATE `studentout_req` SET `status`='accepted' WHERE `rollno`='$reg' AND `status`='pending'";
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
        $reg=$row['rollno'];  
        $query="UPDATE `studentout_req` SET `status`='reject' WHERE `rollno`='$reg' AND `status`='pending'";
        $res=mysqli_query($conn,$query);
        $_SESSION['reject']=true;
        $_SESSION['accept']=false;
        $_SESSION['rollno']=$reg;
        header("Location: dialoguebox.php");
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
  /*document.getElementById('btn2').addEventListener('click', function(){
    document.querySelector('.dbox').style.display='flex';
  });
  document.querySelector('.close').addEventListener('click',function(){
    document.querySelector('.dbox').style.display='none';
  });*/

    </script>
  </table>
  </div>
  </body>
  </html>