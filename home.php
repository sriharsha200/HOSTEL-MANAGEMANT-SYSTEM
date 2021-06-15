<?php
session_start();
if(isset($_SESSION["loggedin"])){
    if($_SESSION["time"]<=time()){ 
        echo "<div class=insert>
        <strong>SESSION EXPIRED</strong>
        </div>";
        session_unset();
        session_destroy();
        }
}
?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HOSTEL MANAGEMENT SYSTEM</title>
	<link rel="stylesheet" href="css/mainstyle.css" >
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
                <li class="logintype">
                    <a href="#">Login</a>
                    <ul>
                        <li><a href="adminlogin.php">Admin Login</a></li>
                        <li><a href="studentlogin.php">Student Login</a></li>
                        <li><a href="securitylogin.php">Security Login</a></li>
                     </ul>
                </li>
                <li class="pics">
                    <a href="gallery.php">Gallery</a>
                </li>
                <li>
                    <a href="#facilities">Facilities</a>
                </li>
                <li>
                  <a href="aboutus.php">AboutUs</a>
              </li>
                </ul>
            </div>
    </nav>
    </div>
    <section id="slider">
      <input type="radio" name="slider" id="s1">
      <input type="radio" name="slider" id="s2">
      <input type="radio" name="slider" id="s3" checked>
      <input type="radio" name="slider" id="s4">
      <input type="radio" name="slider" id="s5">
    
    <label for="s1" id="slide1">
      <img src="images/juniorgym.jfif" height="90%" width="100%" style="box-shadow: 4px 8px 12px black;">
    </label>

    <label for="s2" id="slide2">
      <img src="images/anitsboys.jpg" height="90%" width="100%" style="box-shadow: 4px 8px 12px black;">
    </label>
    
    <label for="s3" id="slide3">
      <img src="images/boysh.jpg" height="90%" width="100%" style="box-shadow: 4px 8px 12px black;">
    </label>
    
    <label for="s4" id="slide4">
      <img src="images/juniorgh.png" height="90%" width="100%" style="box-shadow: 4px 8px 12px black;">
    </label>
    
    <label for="s5" id="slide5">
      <img src="images/images.jfif" height="90%" width="100%" style="box-shadow: 4px 8px 12px black;">
    </label>
    
    
    



    </section>


        <div id="facilities">
            <h1>PREMIUM FACILITIES</h1></div>
    
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/wifi.png">Free wifi</p>
                          </div>
                          <div class="card-back">
                               <p>Unlimited Wifi Connection</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/gym.png">GYM</p>
                          </div>
                          <div class="card-back">
                               <p>Workout Until U get tierd!</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/staff.png">Fun & Educated staff</p>
                          </div>
                          <div class="card-back">
                               <p>Maintaining Friendly Atmosphere Around Us</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/public transport.png">Public Transport</p>
                          </div>
                          <div class="card-back">
                               <p>Go home with excitement rather than facing struggles</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/safety locker.png">Safety Lockers</p>
                          </div>
                          <div class="card-back">
                               <p>Your things can never be owned by others!</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/laundry.png">Laundry Service</p>
                          </div>
                          <div class="card-back">
                               <p>Dressing clean and good also matters a lot</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/security.png">24/7 Security</p>
                          </div>
                          <div class="card-back">
                               <p>Erases Insecurity from your mind</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/playground.png">Playground</p>
                          </div>
                          <div class="card-back">
                               <p>Play as many games as you can and stay healthy</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/bathroom.png">Functional Bathrooms</p>
                          </div>
                          <div class="card-back">
                               <p>Never get a situation to camplain</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/menu.png">Delicious Menu</p>
                          </div>
                          <div class="card-back">
                               <p>Enjoy the tastes of ANITS</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/hygiene.png">Hygiene Enough</p>
                          </div>
                          <div class="card-back">
                               <p>First step maintained in these pandemics</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card">
                        <div class="inner-box">
                          <div class="card-front">
                              <p><img src="images/hospital.png">Hospital Facilities</p>
                          </div>
                          <div class="card-back">
                               <p>Responds in seconds</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          <div class="footer">
            <p><strong>Contact Us on: hostel.anits@gmail.com</strong></p>
          </div>
</body>
</html>