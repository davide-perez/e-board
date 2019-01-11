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


  <link href="/eboard/eboard/public/assets/css/navbar.css" rel="stylesheet" type="text/css">
  <link href="/eboard/eboard/public/assets/css/aboutStyle.css" rel="stylesheet" type="text/css">


  <script src="/eboard/eboard/public/assets/js/category_fetch.js"></script>

</head>

<body>

  <script>

    $(document).ready(function(){

      addClickListeners();
      $('[data-toggle="tooltip"]').tooltip(); 

    });

  </script>

  <?php session_start();?>


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

            <li><a href="/eboard/eboard/public/homepage.php">E-Board</a></li>
            <?php
              if (isset($_SESSION["LOGIN"])) {
                echo '<li><a href="/eboard/eboard/public/post_ad.php">Post an ad</a></li>';
                }
              else {
                echo '<li><a href="/eboard/eboard/public/login.html">Login</a></li>';
                echo '<li><a href="/eboard/eboard/public/registration.html">Register</a></li>';
              }
                
              
            ?>
            <li class = "active"><a href="#">About</a></li>


          </ul>


          <div class="col-sm-3 col-md-3">

            <form class="navbar-form" role="search" action = "/eboard/eboard/public/ad_search.php" method = "post">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>

            </div>
            
        </div>
        </form>
        </div>



          <ul class="nav navbar-nav navbar-right">
            <?php 
                if (isset($_SESSION["LOGIN"])) {
                  echo '<li><a href="/eboard/eboard/public/userPanel.php"><span class="glyphicon glyphicon-user"></span>';
                  echo " Hello " .$_SESSION["USERNAME"];
                }
                else {
                  echo '<li class = "disabled"><a href="#" data-toggle="tooltip" data-placement="bottom" title="You must login to see your profile and post an ad!"><span class="glyphicon glyphicon-user"></span>';
                  echo " Hello Visitor";
                }
            ?> 
            </a></li>
            <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
          </ul>
            
        </div><!--/.nav-collapse -->

      </div><!--/.container-fluid -->
      </nav>
    </div>

    <!-- MIDDLE -->
    <div id="middle">
      <div class = "row">
        <!-- Cremo -->
        <div class = "col-md-6 col-lg-6 col-sm-12" style ="text-align: center">
          <h1>Davide Cremonini</h1>
          <br>
          <div class = "photoPanel cremo">
          </div>
          <button class = "btn btn-link btn-lg" data-toggle="collapse" data-target="#descrCremo"><span class="glyphicon glyphicon-menu-down"></span></button>
          <div id="descrCremo" class = "collapse" style = "text-align:justify;">
            <p class = "lead">Davide Cremonini is a student of the Faculty of Computer Science and Engineering at the Free University of Bolzano. He is a web developer whose competences include PHP, HTML, Javascript, CSS and AJAX.  
            </p>
            <p class = "lead"><span class="glyphicon glyphicon-envelope"></span> dcremonini@unibz.it</p>

          </div>
        </div>

        <!-- Perez-->
         <div class = "col-md-6 col-sm-12 col-lg-6" style = "text-align:center">
          <h1>Davide Perez</h1>
          <br>
          <div class = "photoPanel perez">
          </div>
          <button class = "btn btn-link btn-lg" data-toggle="collapse" data-target="#descrPerez"><span class="glyphicon glyphicon-menu-down"></span></button>
          <div id="descrPerez" class = "collapse" style = "text-align:justify;">
            <p class = "lead">Davide Perez is a student of the Faculty of Computer Science and Engineering at the Free University of Bolzano. He is a software developer whose competences include PHP, HTML, Javascript, CSS and ATHOS.  </p>
            <p class = "lead"><span class="glyphicon glyphicon-envelope"></span> dperez@unibz.it</p>
          </div>
        </div>
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

              <li class = "bottomLI"><a href="/eboard/eboard/public/homepage.php"><span class="glyphicon glyphicon-calendar"></span> Newest</a></li>
              <li class="divider-vertical"></li>
              <li class = "bottomLI"><a href="#"><span class="glyphicon glyphicon-home"></span> For rent</a></li>
              <li class="divider-vertical"></li>
              <li class = "bottomLI"><a href="/eboard/eboard/public/adnavigation.php"><span class="glyphicon glyphicon-briefcase"></span> Jobs</a></li>
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