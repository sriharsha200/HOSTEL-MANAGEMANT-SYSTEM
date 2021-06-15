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
      <link rel="stylesheet" href="css/admincompstat.css">
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
  <div class="total">
    <?php
    
    if(isset($_SESSION['accept'])){
      $tem=$_SESSION['accept'];
      $cmp=$_SESSION['complaintid'];
      if($tem==true) {   
        echo "<div class='insert'>
        <strong>Success </strong>Complaint id $cmp Accepted
        </div>";
      $_SESSION['accept']=false;
      }
    }
    if(isset($_SESSION['reject'])){
      $tem=$_SESSION['reject']; 
      $cmp=$_SESSION['complaintid']; 
      if($tem==true) {   
        echo "<div class='insert'>
        <strong>Complaint id $cmp </strong>rejected
        </div>";
      $_SESSION['reject']=false;
      }
    }
    $fn=1;
    include("connect.php");
    $query="SELECT * FROM `student_complaints`";
    $res=mysqli_query($conn,$query);
    $norows=mysqli_num_rows($res);
    if($norows==0){
      echo "<div class='norows'>There are no Complaints found recently</div>";
    }
    while($row=mysqli_fetch_assoc($res)){
    $div='myDIV'.strval($fn);
    echo "<div class=tb>
    <table>
      <tr>
      <th>Rollno</th>
      <th>Complaintid</th>
      <th>Roomno</th>
      <th>Subject</th>
      <th>Date</th>
      </tr>";
        $regno=$row['Rollno'];
        $complaintid=$row['Complaintid'];
        $subject=$row['Subject'];
        $date=$row['Date'];
        $complaint=$row['Complaint'];
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
           $query="SELECT *FROM `$table` WHERE `regno`='$regno'";
           $result=mysqli_query($conn,$query);
           $row=mysqli_fetch_assoc($result);
           $roomno=$row["room"];
        }


      echo "<tr>
      <td>$regno</td>
      <td>$complaintid</td>
      <td>$roomno</td>
      <td>$subject</td>
      <td>$date</td>
      </tr>
      </table>
      <d id='bt'>
        <button class='btn1' onclick='fun($fn)'>Complaint</button>
        <form action='admincompstat.php' method='POST'>
        <button class='btn'  name='accept' value=$fn>Accept</button>
        <button class='btn2' name='reject' value=$fn>Reject</button>
        </form>
      <d>
      <div class='cbox' id=$div>
        $complaint
      </div>
    </div>"; 
      $fn+=1;
    }
    ?>
    <?php
      include("connect.php");
      if(isset($_POST['accept'])){
        $rvalue=1;
        $val=$_POST['accept'];
    $query="SELECT * FROM `Student_complaints`";
    $result=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($result)){
        if($rvalue==$val){
          $id=$row['Complaintid'];
          $query="SELECT * FROM `student_complaints` WHERE `Complaintid`=$id";
          $res=mysqli_query($conn,$query);
          $rowr=mysqli_fetch_assoc($res);
          $no=$rowr['Rollno'];
          $cid=$rowr['Complaintid'];
          $sub=$rowr['Subject'];
          $com=$rowr['Complaint'];
          $date=$rowr['Date'];
          $rdate=date('d/m/y');
          $query="INSERT INTO `accept_complaints` values($no,$cid,'$sub','$com','$date','$rdate')";
          mysqli_query($conn,$query); 
          $query="DELETE FROM `student_complaints` WHERE `complaintid`=$id";
          mysqli_query($conn,$query);
          session_start();
          $_SESSION['accept']=true;
          $_SESSION['reject']=false;
          $_SESSION['rollno']=$row['Rollno'];
          $_SESSION['complaintid']=$row['Complaintid'];
          header("Location: admincompstat.php");
        }
        $rvalue=$rvalue+1;
    }
      }
      if(isset($_POST['reject'])){
        $rvalue=1;
        $val=$_POST['reject'];
        $conn=mysqli_connect("localhost","root","","HMS");
        $query="SELECT * FROM `student_complaints`";
        $result=mysqli_query($conn,$query);
      while($row=mysqli_fetch_assoc($result)){
      if($rvalue==$val){
        $id=$row['Complaintid'];
        $query="SELECT * FROM `student_complaints` WHERE `Complaintid`=$id";
        $res=mysqli_query($conn,$query);
        $rowr=mysqli_fetch_assoc($res);
        $no=$rowr['Rollno'];
        $cid=$rowr['Complaintid'];
        $sub=$rowr['Subject'];
        $com=$rowr['Complaint'];
        $date=$rowr['Date'];
        $rdate=date('d/m/y');
        $query="INSERT INTO `reject_complaints` values($no,$cid,'$sub','$com','$date','$rdate')";
        $res=mysqli_query($conn,$query);      
        $qu="DELETE FROM `Student_complaints` WHERE `Complaintid`=$id";
        mysqli_query($conn,$qu);
        session_start();
        $_SESSION['reject']=true;
        $_SESSION['accept']=false;
        $_SESSION['rollno']=$row['Rollno'];
        $_SESSION['complaintid']=$row['Complaintid'];
        echo $rowr." ".$no;
        header("Location: admincompstat.php");
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
