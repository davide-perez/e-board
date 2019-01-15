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

  <script src="/eboard/eboard/public/assets/js/mod.js"></script>
  <script src="/eboard/eboard/public/assets/js/fill_modal.js"></script>
  <link href = "/eboard/eboard/public/assets/css/modstyle.css" rel="stylesheet" type="text/css">
  <link href = "/eboard/eboard/public/assets/css/navbar.css" rel="stylesheet" type="text/css">



</head>

<body>
<?php
    session_start();
    if(!isset($_SESSION["LOGIN_ADMIN"]))
    echo '<script>window.location.href="/eboard/eboard/public/login.html"</script>';

    require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

    /**
    * Given a valid db connection and an integer representing a status number, performs a parametric query
    * on such number and returns a result set.
    */
    function selectWithStatus($conn, $status){

      $stmt = $conn->prepare("SELECT a.ad_id, u.username, u.mail, a.title, a.category, a.date_published, a.status, a.ad_text, i.link FROM ad AS a INNER JOIN standard_user AS u ON a.user_id = u.user_id INNER JOIN image AS i ON a.ad_id = i.ad_id WHERE a.status = ?");
      $stmt->bind_param('i', $status);
      $stmt->execute();

      return $stmt->get_result();
    }


    /**
    * Performs a query against the database and return info about the number of ads' states in form of an associative array.
    */
    function getAdStats($conn){

      $keys = array('approved', 'pending', 'rejected', 'outdated');
      $values = array(0, 0, 0, 0);

      $stmt = $conn -> prepare("SELECT a.status AS 'ad_status', COUNT(a.ad_id) AS 'count' FROM ad AS a GROUP BY status");
      $stmt -> execute();

      $result = $stmt -> get_result();

      while($res = mysqli_fetch_row($result)){

        //arrays are 0-indexed, while ads' states get from 1 to 4
        $values[$res[0] - 1] = $res[1];

      }

      return array_combine($keys, $values);

    }



    function getUserStats($conn){
      $stmt = $conn -> prepare("SELECT count(*) FROM standard_user");
      $stmt -> execute();
      $result = $stmt -> get_result();
      $num = 0;
      while($res = mysqli_fetch_row($result)){
        $num = $res[0];
      }

      return $num;
    }


    $db = new ConnectionFactory();
    $conn = $db -> get_connection();
    $adstats = getAdStats($conn);
    $userstats = getUserStats($conn);

?>


<script>

  $(document).ready( _ => { setTabsCounter(); } );

</script>


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


          </ul>


         



          <ul class="nav navbar-nav navbar-right">
            <li class = "active"><a href="#"><span class="glyphicon glyphicon-user"></span> Hello, admin!
            </a></li>
            <li><a href="/eboard/eboard/server/php/user_logout.php"><span class="glyphicon glyphicon-share"></span> Logout</a></li>
          </ul>
            
        </div><!--/.nav-collapse -->

      </div><!--/.container-fluid -->
      </nav>
    </div>

<div id="middle" class="container">

  <div class="jumbotron">
      <h1><span class="glyphicon glyphicon-pushpin"></span> E-Board stats</h1> 
      <p>There are currently <?php echo $adstats["approved"] ?> ads approved and online.<br>
       There are <?php echo $adstats["pending"] ?> ads that are waiting for your approval.<br>
       <?php echo $adstats["outdated"] ?> ads have expired and are now eligible for permanent deletion.<br>
       You rejected <?php echo $adstats["rejected"] ?> ads that are now eligible for permanent deletion.<br><br>
       <?php echo $userstats ?> users are subscribed to this website.
      </p> 
  </div>


  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#approved-ads">Approved(<span id="approved-count"></span>)</a></li>
    <li><a data-toggle="tab" href="#pending-ads">Pending(<span id="pending-count"></span>)</a></li>
    <li><a data-toggle="tab" href="#outdated-ads">Outdated(<span id="outdated-count"></span>)</a></li>
    <li><a data-toggle="tab" href="#rejected-ads">Rejected(<span id="rejected-count"></span>)</a></li>
  </ul>

<div class="tab-content">

  <div id="approved-ads" class="tab-pane fade in active">

    <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>E-mail</th>
            <th>Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $result = selectWithStatus($conn, 1);
            while($res = mysqli_fetch_row($result)) { 

            $gallery = $conn->prepare("SELECT link FROM imageGallery WHERE ad_id = ?" );
            $gallery->bind_param('s', $res[0]);


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
          <tr class="clickable-row">
            <td><?php echo $res[0]; ?></td>
            <td><?php echo $res[1]; ?></td>
            <td><?php echo $res[2]; ?></td>
            <td><?php echo $res[3]; ?></td>
            <td><?php echo ucfirst($res[4]); ?></td>
            <td><?php echo $res[5]; ?></td>
            <td><?php echo '<a href="javascript:fillModalMod( \'' . $res[3] . '\', \'' . $res[7] . '\', \'' . $res[8] . '\', \''  . $res[1] . '\', \'approved\', \''.$images.'\', \''.$hasGallery.'\', \''. $res[0].'\')">' . 'Details </a>'; ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

</div>

  <div id="pending-ads" class="tab-pane fade">

    <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>E-mail</th>
            <th>Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $result = selectWithStatus($conn, 2);
          while($res = mysqli_fetch_row($result)) { 
            $gallery = $conn->prepare("SELECT link FROM imageGallery WHERE ad_id = ?" );
            $gallery->bind_param('s', $res[0]);


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
          <tr class="clickable-row">
            <td><?php echo $res[0]; ?></td>
            <td><?php echo $res[1]; ?></td>
            <td><?php echo $res[2]; ?></td>
            <td><?php echo $res[3]; ?></td>
            <td><?php echo ucfirst($res[4]); ?></td>
            <td><?php echo $res[5]; ?></td>
            <td><?php echo '<a href="javascript:fillModalMod( \'' . $res[3] . '\', \'' . $res[7] . '\', \'' . $res[8] . '\', \''  . $res[1] . '\', \'pending\', \''.$images.'\', \''.$hasGallery.'\', \''. $res[0].'\')">' . 'Details </a>'; ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

  </div>

  <div id="outdated-ads" class="tab-pane fade">

    <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>E-mail</th>
            <th>Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $result = selectWithStatus($conn, 4);
          while($res = mysqli_fetch_row($result)) { 
            $gallery = $conn->prepare("SELECT link FROM imageGallery WHERE ad_id = ?" );
            $gallery->bind_param('s', $res[0]);


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
          <tr class="clickable-row">
            <td><?php echo $res[0]; ?></td>
            <td><?php echo $res[1]; ?></td>
            <td><?php echo $res[2]; ?></td>
            <td><?php echo $res[3]; ?></td>
            <td><?php echo ucfirst($res[4]); ?></td>
            <td><?php echo $res[5]; ?></td>
            <td><?php echo '<a href="javascript:fillModalMod( \'' . $res[3] . '\', \'' . $res[7] . '\', \'' . $res[8] . '\', \''  . $res[1] . '\', \'outdated\', \''.$images.'\', \''.$hasGallery.'\', \''. $res[0].'\')">' . 'Details </a>'; ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- Insert trash button here -->
    <button type="button" id="del-outdated" class="btn btn-danger bottom-btn" onclick="delete_all_outdated()">
      <span class="glyphicon glyphicon-trash"></span> Delete all
  </button>
  </div>

  <div id="rejected-ads" class="tab-pane fade">
    <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>E-mail</th>
            <th>Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $result = selectWithStatus($conn, 3);
          while($res = mysqli_fetch_row($result)) { 
            $gallery = $conn->prepare("SELECT link FROM imageGallery WHERE ad_id = ?" );
            $gallery->bind_param('s', $res[0]);


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
          <tr class="clickable-row">
            <td><?php echo $res[0]; ?></td>
            <td><?php echo $res[1]; ?></td>
            <td><?php echo $res[2]; ?></td>
            <td><?php echo $res[3]; ?></td>
            <td><?php echo ucfirst($res[4]); ?></td>
            <td><?php echo $res[5]; ?></td>
            <td><?php echo '<a href="javascript:fillModalMod( \'' . $res[3] . '\', \'' . $res[7] . '\', \'' . $res[8] . '\', \''  . $res[1] . '\', \'rejected\', \''.$images.'\', \''.$hasGallery.'\', \''. $res[0].'\')">' . 'Details </a>'; ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- Insert trash button here -->
    <button type="button" id="del-rejected" class="btn btn-danger bottom-btn" onclick="delete_all_rejected()">
      <span class="glyphicon glyphicon-trash"></span> Delete all
  </button>
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
          <div id = "contactsPanel">
          </div>
          <br>
          <div id = "galleryPanel">
          </div>
          <h3>Actions</h3>
          <hr>
          <div id = "actionPanel">
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
</div>


</body>


</html>
