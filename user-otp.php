<?php
session_start();
$otp=$_SESSION["otp"];

if(isset($_POST["check"])){
	
	$eotp=$_POST["otp"];
	if($otp==$eotp){
		header("LOCATION: new-password.php");
		
	}
	else{
        echo "<div class='insert'>
        <strong>You are not registered yet!</strong>
        </div>";
    }	
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/studentstyle.css">
    <link rel="shortcut icon" href="./images/anitslogo2.png" type="image/x-icon"> 

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="user-otp.php" method="POST" autocomplete="off">
				    <h4 id="h4">An OTP is sent successfully to ur college mail id <?php echo $_SESSION['email']; ?></h4>
                    <h2 class="text-center">Code Verification</h2>
                   
                    <div class="form-group">
                        <input class="form-control" name="otp" type="number"  placeholder="Enter verification code" >
                    </div>
                    <div class="form-group">
                        <input class="form-control button" name="check" type="submit"  value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>