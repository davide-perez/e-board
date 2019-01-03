<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <title>E-Board</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <!-- custom scripts -->
  <script src="/eboard/eboard/public/assets/js/user_fetch.js"></script>

  
  <link href="/eboard/eboard/public/assets/css/navbar.css" rel="stylesheet" type="text/css">
  <link href="/eboard/eboard/public/assets/css/userStyle.css" rel="stylesheet" type="text/css">

  <script src="/eboard/eboard/public/assets/js/category_fetch.js"></script>

  

</head>

<body>

  <script>

      $(document).ready(function(){

        fetch();
        addClickListeners();

    });

  </script>

  <?php
    session_start();
  ?>

  <!-- Main container-->
  <div id="container">

    <!-- HEADER-->
    <div id="header">
    <!-- Categories navbar -->
      <nav class="navbar navbar-default">

      <div class="container-fluid">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>

          </button>

          <div class="navbar-brand">
          <span>
            <img src="/eboard/eboard/public/assets/images/logo.png" height = "50px" alt="">
          </span>
             
          </div>

        </div>

        <div id="navbar" class="navbar-collapse collapse">

          <ul class="nav navbar-nav navbar-left">

            <li><a href="/eboard/eboard/public/homepage.html">E-Board</a></li>
            <li><a href="/eboard/eboard/public/login.html">Login</a></li>
            <li><a href="/eboard/eboard/public/registration.html">Register</a></li>
            <li><a href="#">About</a></li>


          </ul>


          <div class="col-sm-3 col-md-3">

            <form class="navbar-form" role="search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>

            </div>
            
        </div>
        </form>
        </div>



          <ul class="nav navbar-nav navbar-right">
            <li class = "active"><a href="#"><span class="glyphicon glyphicon-user"></span> Hello 
              <?php 
                if (isset($_SESSION["LOGIN"]))
                  echo $_SESSION["USERNAME"];
                else
                  echo "Visitor";
              ?>
            </a></li>
            <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
          </ul>
            
        </div><!--/.nav-collapse -->

      </div><!--/.container-fluid -->
      </nav>
    </div>

    <!-- MIDDLE -->
    <div id="middle" style = "padding-left:50px; padding-right: 50px; padding-top: 20px; height:100%;  
   padding-bottom:50px;">
      <div id="myCarousel" class="carousel slide" data-ride="carousel" >
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="/eboard/eboard/public/assets/images/one.jpg" alt="Los Angeles" style ="width:100%; height:300px">
      <div class="carousel-caption">
        <button type="button" class="btn btn-warning btn-lg">Post an ad</button>
        <h3>Select from several categories</h3>
      </div>
    </div>

    <div class="item">
      <img src="/eboard/eboard/public/assets/images/two.jpg" alt="Chicago" style ="width:100%; height:300px">
      <div class="carousel-caption">
        <a href = "#your_ad" role="button" class="btn btn-primary btn-lg">See your ads</a>
        <h3>Get the list of your posted ads</h3>
      </div>
    </div>

    <div class="item">
      <img src="/eboard/eboard/public/assets/images/three.jpg" alt="New York" style ="width:100%; height:300px">
      <div class="carousel-caption">
        <a href = "/eboard/eboard/server/php/user_logout.php" role="button" class="btn btn-danger btn-lg">Logout</a>
        <h3>We will miss you..</h3>
      </div>
    </div>
    
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    <!-- Finish of carousel, start profile -->
    <br>
      <h1 class="my-4"><span class = "cat-title">Profile</span>
        <small class="cat-text">Your personal content</small>
      </h1>
    <hr>
    <br>

  <div class = "row well">
    <div class = "col-md-6 col-lg-6 col-sm-12">
      <p class = "lead"><span class="glyphicon glyphicon-book"></span><b> Name: </b> 
        <?php
          echo $_SESSION["NAME"] . " " . $_SESSION["SURNAME"];
        ?>
      </p>
    </div>
    <div class = "col-md-6 col-lg-6 col-sm-12">
      <p class = "lead"><span class="glyphicon glyphicon-user"></span><b> Username: </b>
        <?php
          echo $_SESSION["USERNAME"];
        ?> 
      </p>
    </div>
    <div class = "col-md-6 col-lg-6 col-sm-12">
      <p class = "lead"><span class="glyphicon glyphicon-envelope"></span><b> Email:</b> davide.cremo@gmail.com</p>
    </div>
    <div class = "col-md-6 col-lg-6 col-sm-12">
      <p class = "lead"><span class="glyphicon glyphicon-phone-alt"></span><b> Phone:</b> 335 8477989</p>
    </div>
     <div class = "col-md-6 col-lg-6 col-sm-12" style = "padding-top: 3px;">
      <button class = "btn btn-primary" data-toggle="collapse" data-target="#demo">Change password</button>
      <div id="demo" class="collapse " style = "padding-top: 20px;">
      <form>
        <div class="form-group">
          <label for="oldpw">Old password:</label>
          <input type="password" class="form-control" id="oldpw" placeholder="Old password">
        </div>
        <div class="form-group">
          <label for="newpw">New password:</label>
          <input type="password" class="form-control" id="newpw" placeholder="New password">
        </div>
        <div class="form-group">
          <label for="repeatpw">Repeat password:</label>
          <input type="password" class="form-control" id="repeatpw" placeholder="Repeat password">
        </div>
        <button class = "btn btn-warning">Change</button>
  
    </form>
  </div>
    </div>

    <div class = "col-md-6 col-lg-6 col-sm-12" style = "padding-top: 3px;">
      <a href = "/eboard/eboard/server/php/user_logout.php" role="button" class="btn btn-danger">Logout</a>
    </div>
    

  </div>

  <br>
  <h1 class="my-4"><span class = "cat-title"><a name="your_ad" style = "color:black">Your ads</a></span>
    <small class="cat-text">The current ads you have posted</small>
    <button type="button" class="btn btn-warning" id = "floatButton">Post an ad</button>
  </h1>
  <hr>
  <br>

  <!--  Div to be fetched with the ads -->

  <div class="row" id = "personal_ads">
        
  </div>

    </div>
        
        <div id="footer">
          <!-- Categories navbar -->
      <nav class="navbar navbar-default navbar-fixed-bottom">

        <div class="container-fluid">

          <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_2" aria-expanded="false" aria-controls="navbar">

              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>

            </button>

          </div>

          <div id="navbar_2" class="navbar-collapse collapse">

            <form id="catForm" action="adnavigation.php" method="GET">

            <ul class="nav navbar-nav" style = "width:100%">

              <li class = "bottomLI"><a href="/eboard/eboard/public/homepage.html"><span class="glyphicon glyphicon-calendar"></span> Newest</a></li>
              <li class="divider-vertical"></li>
              <li class = "bottomLI"><a href="#"><span class="glyphicon glyphicon-home"></span> For rent</a></li>
              <li class="divider-vertical"></li>
              <li class = "bottomLI"><a href="/eboard/eboard/public/adnavigation.html"><span class="glyphicon glyphicon-briefcase"></span> Jobs</a></li>
              <li class="divider-vertical"></li>
              <li class = "bottomLI"><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Items for sale</a></li>
              <li class="divider-vertical"></li>
              <li class = "bottomLI"><a href="#"><span class="glyphicon glyphicon-globe"></span> Events</a></li>
              <li class="divider-vertical"></li>
              <li class = "bottomLI"><a href="#"><span class="glyphicon glyphicon-book"></span> Lectures</a></li>
              <li class="divider-vertical"></li>
              <li class = "bottomLI"><a href="#"><span class="glyphicon glyphicon-th"></span> Other</a></li>

            </ul>

            </form>

            
          </div><!--/.nav-collapse -->

        </div><!--/.container-fluid -->

      </nav>
        </div>
      </div>

  </div>


  


</body>

</html>


