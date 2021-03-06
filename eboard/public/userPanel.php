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

  
  <script src="/eboard/eboard/public/assets/js/del_handler.js"></script>

  
  <link href="/eboard/eboard/public/assets/css/navbar.css" rel="stylesheet" type="text/css">
  <link href="/eboard/eboard/public/assets/css/userStyle.css" rel="stylesheet" type="text/css">

  <script src="/eboard/eboard/public/assets/js/category_fetch.js"></script>

  

</head>

<body>


<?php
  session_start();
  if(!isset($_SESSION["LOGIN"]))
    echo '<script>window.location.href="/eboard/eboard/public/login.html"</script>';

  require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

  $db = new ConnectionFactory();
  $conn = $db -> get_connection();

  $stmt = $conn->prepare("SELECT title, ad_text, link, date_published, username, mail, phone, a.ad_id FROM ad AS a INNER JOIN image AS i ON a.ad_id = i.ad_id AND status = 1 INNER JOIN standard_user AS s ON a.user_id = s.user_id AND s.user_id = " . $_SESSION["LOGIN"]);

  
  $stmt->execute();

  $result = $stmt->get_result();

?>

  <script>

      $(document).ready(function(){

        //fetch();
        addClickListeners();

    });

  </script>

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
            <li><a href="/eboard/eboard/public/post_ad.php">Post an ad</a></li>
            <li><a href="/eboard/eboard/public/about.php">About</a></li>


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
      <div id="myCarousel1" class="carousel slide" data-ride="carousel" >
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel1" data-slide-to="1"></li>
    <li data-target="#myCarousel1" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="/eboard/eboard/public/assets/images/one.jpg" alt="Los Angeles" style ="width:100%; height:300px">
      <div class="carousel-caption">
        <a href = "/eboard/eboard/public/post_ad.php" role="button" class="btn btn-warning btn-lg">Post an ad </a>
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
  <a class="left carousel-control" href="#myCarousel1" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel1" data-slide="next">
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
      <p class = "lead"><span class="glyphicon glyphicon-envelope"></span><b> Email: </b> 
        <?php
          echo $_SESSION["MAIL"];
        ?> 
      </p>
    </div>
    <div class = "col-md-6 col-lg-6 col-sm-12">
      <p class = "lead"><span class="glyphicon glyphicon-phone-alt"></span><b> Phone: </b>
        <?php
          echo $_SESSION["PHONE"];
        ?> 
      </p>
    </div>
     <div class = "col-md-6 col-lg-6 col-sm-12" style = "padding-top: 3px;">
      <button class = "btn btn-primary" data-toggle="collapse" data-target="#demo">Change password</button>
      <div id="demo" class="collapse " style = "padding-top: 20px;">
      <form action = "/eboard/eboard/public/userPanel.php" method = "post" id="pwForm">
        <div class="form-group">
          <input type = "hidden" value = <?php echo '"'.$_SESSION["LOGIN"].'"'?> name= "user_id">
          <label for="oldpw" id="oldpwLabel">Old password:</label>
          <input type="password" class="form-control" id="oldpw" placeholder="Old password" name = "oldpw" required>
        </div>
        <div class="form-group">
          <label for="inputPassword">New password:</label>
          <input type="password" class="form-control" id="inputPassword" placeholder="New password" name="inputPassword" required>
        </div>
        <div class="form-group">
          <label for="repeatPassword">Repeat password:</label>
          <input type="password" class="form-control" id="repeatPassword" placeholder="Repeat password" name = "repeatPassword" required>
        </div>
        <button type = "button" class = "btn btn-warning" id = "change_button">Change</button>
  
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
    <a href = "/eboard/eboard/public/post_ad.php" role="button" class="btn btn-warning">Post an ad </a>
  </h1>
  <hr>
  <br>

  <!--  Div to be fetched with the ads -->

  <div class="row" id ="personal_ads">

    <?php while($res = mysqli_fetch_row($result)) { 
      $gallery = $conn->prepare("SELECT link FROM image_gallery WHERE ad_id = ?" );
      $gallery->bind_param('s', $res[7]);


      $gallery->execute();
      $resultGallery = $gallery->get_result();
      $images = '';
      if ($resultGallery -> num_rows != 0) {
        $hasGallery = "true";
        while($myimage = mysqli_fetch_row($resultGallery)) {
          $images = $images . " " . $myimage[0];
          }
        $images = trim($images);
      }
      else
        $hasGallery = "false";

    ?>

        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          
            <div class="card-body">
              <div id = "card-image" style="background-image: url( <?php echo $res[2]; ?> )">

              </div>
              <h4 class="card-title">
                <?php echo '<a href="javascript:fillModal( \'' . $res[0] . '\', \'' . $res[1] . '\', \'' . $res[2] . '\', \'' .$res[3] . '\', \''  . $res[4] . '\', \'' . $res[5] . '\', \'' . $res[6] .  '\',\''. $images. '\', \''. $hasGallery.'\')">' .   $res[0] . '</a>'; ?> 
              </h4>
              <p class="card-text"> <?php $newdesc = str_replace("\\'", "'", $res[1]);echo $newdesc;  ?> </p>
              <?php
               echo '<button type="button" class="btn btn-warning" id="details_button" onclick = "fillModal( \'' . $res[0] . '\', \'' . $res[1] . '\', \'' . $res[2] . '\', \'' .$res[3] . '\', \''  . $res[4] . '\', \'' . $res[5] . '\', \'' . $res[6] .  '\',\''. $images. '\', \''. $hasGallery.'\')">Details</button>' ;
                echo '<button type="button" class="btn btn-danger" id="delete_button" onclick="del(' . $res[7] . ')">Delete</button>';
              ?>
              
            </div>
          
        </div>

      <?php } ?>
        

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
              <li class = "bottomLI"><a href="#"><span class="glyphicon glyphicon-briefcase"></span> Jobs</a></li>
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

  <!-- Modal experiments -->
  <div class="modal fade" id="adModal" tabindex="-1" role="dialog" aria-labelledby="adModal" aria-hidden="true" style = "padding-top: 60px; padding-bottom: 60px">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="adTitle"></h2>
      </div>
      <div class="modal-body" id = "adBody">

        <div id = "modalContainer">
          <div id = "modalImage">
            
          </div>
          <br>
          <p class = "lead" id = "adDescription">
          </p>
          <br>
          <h3>Contacts</h3>
          <hr>
          <div id = "contactsPanel">
          </div>
          <br>


        </div>
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  <script src="/eboard/eboard/public/assets/js/input_check.js"></script>
  <script src="/eboard/eboard/public/assets/js/fill_modal.js"></script>

  <script src="/eboard/eboard/public/assets/js/change_pw.js"></script>




  


</body>

</html>


