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

  <!-- custom scripts 
  <script src="/eboard/eboard/public/assets/js/user_fetch.js"></script>-->

  
  <link href="/eboard/eboard/public/assets/css/navbar.css" rel="stylesheet" type="text/css">
  <link href="/eboard/eboard/public/assets/css/postStyle.css" rel="stylesheet" type="text/css">

  <script src="/eboard/eboard/public/assets/js/category_fetch.js"></script>

  

</head>

<body>

  <script>

      $(document).ready(function(){
        
        
        addClickListeners();
        

    });

  </script>

  <?php session_start(); ?>

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
            <li class = "active"><a href="">Post an ad</a></li>
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
            <li><a href="/eboard/eboard/public/userPanel.php"><span class="glyphicon glyphicon-user"></span> Hello 
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

    <div class="jumbotron">
        <h1><span class="glyphicon glyphicon-pushpin"></span> Post your ad</h1> 
        <p>Write your personal ad. Select the category, add images and insert all the information you want! Every ad needs to be accepted before being posted on the board. Please do not include sensitive information, offensive or off-topic contents.</p> 
    </div>

    <!-- MIDDLE -->
    <div id="middle">

    <form id="ad-submit" action="/eboard/eboard/server/php/ad_insertion.php" method="POST" enctype="multipart/form-data">

    <div class = "well">
    <div class = "row">
      <div class = "col-md-6 col-sm-12 col-lg-6">
      <h3> <span class="glyphicon glyphicon-list-alt"></span> What is your advertisment about? </h3>
      <div class="form-group col-lg-8 col-md-8">
        <label for="category">Select category:</label>
        <select class="form-control" id="category" name= "category">
          <option>For rent</option>
          <option>Jobs</option>
          <option>Items for sale</option>
          <option>Events</option>
          <option>Lectures</option>
          <option>Other</option>
        </select>
      </div>
    </div>


    <div class = "col-md-6 col-sm-12 col-lg-6">
      <h3> <span class="glyphicon glyphicon-edit"></span> What is the title of your ad? </h3>
      <div class="form-group col-lg-8 col-md-8">
        <label for="title">Write title:</label>
        <input type="text" class="form-control" id="title" name = "title" placeholder="Title" required>
      </div>
    </div>
  </div> <!-- end row -->

    <hr>
    <div class = "row">
    <div class = "col-md-12 col-lg-12 col-sm-12">
    <h3> <span class="glyphicon glyphicon-list"></span> Advertisment description </h3>
    <div class="form-group">
      <label for="description">Advertisement text (<span id = "character_num">5000</span> chars available):</label>

      <textarea class="form-control" rows="5" id="description" name = "description" required></textarea>
    </div>
  </div>
</div>

    <hr>

    
    
    
    <div class = "row">

<!-- Upload image -->
    <div class="col-md-6 col-lg-6 col-sm-12">
      <h3> <span class="glyphicon glyphicon-picture"></span> Add a cover image (optional) </h3>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" id="imgToUpload" name="imgToUpload">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
        <img id='img-upload'/>
    </div>
  </div>

    <div class = "col-md-6 col-sm-12 col-lg-6">
      <h3> <span class="glyphicon glyphicon-picture"></span> Create a gallery of images (optional) </h3>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" id="imgToUpload2" name="imgToUpload2" multiple>
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
        <img id='img-upload2'/>
    </div>

    </div>
  </div>
   <hr>

<!-- -->
  
  <div class = "row">
  <div class = "col-md-6 col-lg-6 col-sm-12">
    <h3> <span class="glyphicon glyphicon-envelope"></span> Email contact:  
      <?php 
        echo $_SESSION["MAIL"];
      ?>
    </h3>
  </div>
  <div class = "col-md-6 col-lg-6 col-sm-12">

    <h3> <span class="glyphicon glyphicon-phone"></span> Phone contact:  
      <?php 
        echo $_SESSION["PHONE"];
      ?>
    </h3>
  </div>
    
    
  </div>




  </div> <!-- well div-->

  <br>
  <div style = "text-align: center;">
  <button type="submit" name="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-download-alt"></span> Post ad </button>
</div>
  </form>


      
      

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

  <script src="/eboard/eboard/public/assets/js/post_check.js"></script>
  <script src="/eboard/eboard/public/assets/js/upload_image.js"></script>
  




  


</body>

</html>


