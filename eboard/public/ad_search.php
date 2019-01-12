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
  <link href="/eboard/eboard/public/assets/css/adnavigationStyle.css" rel="stylesheet" type="text/css">

  <script src="/eboard/eboard/public/assets/js/category_fetch.js"></script>



</head>

<body>

<?php
    session_start();

	require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

		$db = new ConnectionFactory();
		$conn = $db -> get_connection();

    $searched = $_POST["srch-term"];

    $stmt = $conn->prepare("SELECT title, ad_text, link, date_published, username, mail, phone, a.ad_id FROM ad AS a INNER JOIN image AS i ON a.ad_id = i.ad_id AND status = 1 INNER JOIN standard_user AS s ON a.user_id = s.user_id WHERE ad_text LIKE '%" . $searched . "%' OR title LIKE '%" .$searched."%'" );

    $stmt->execute();

    $result = $stmt->get_result();
?>

  <script>

      $(document).ready(function(){

        addClickListeners();
        $('[data-toggle="tooltip"]').tooltip(); 

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

            <li class="active"><a href="">E-Board</a></li>
            <?php
              if (isset($_SESSION["LOGIN"])) {
                echo '<li><a href="/eboard/eboard/public/post_ad.php">Post an ad</a></li>';
                }
              else {
                echo '<li><a href="/eboard/eboard/public/login.html">Login</a></li>';
                echo '<li><a href="/eboard/eboard/public/registration.html">Register</a></li>';
              }
                
              
            ?>
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
    <div id="middle" style = "height:100%; padding-bottom: 50px;">
      

     <!-- Page Content -->
    <div class="container">
      <br>
      <h1 class="my-4"><span id="cat-title">Results</span>
        <small id="cat-text">Ads that contain your searched text</small>
      </h1>
      <br>
      <br>

      <div class="row">

      	<?php while($res = mysqli_fetch_row($result)) {
          $gallery = $conn->prepare("SELECT link FROM imageGallery WHERE ad_id = ?" );
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
              <p class="card-text"> <?php echo $res[1]; ?> </p>
              <?php
               echo '<button type="button" class="btn btn-warning" id="details_button" onclick = "fillModal( \'' . $res[0] . '\', \'' . $res[1] . '\', \'' . $res[2] . '\', \'' .$res[3] . '\', \''  . $res[4] . '\', \'' . $res[5] . '\', \'' . $res[6] .  '\',\''. $images. '\', \''. $hasGallery.'\')">Details</button>' ;
              ?>
            </div>
          
        </div>

    	<?php } ?>

      </div>

      <!-- Pagination -->
      <div style = "text-align: center">
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </div>

    </div>
    <!-- /.container -->

    </div>
    <!-- /.container -->
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

<script src="/eboard/eboard/public/assets/js/fill_modal.js"></script>

</body>

</html>