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



</head>

<body>
<?php
    session_start();

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

    $db = new ConnectionFactory();
    $conn = $db -> get_connection();



?>

<script>

  $(document).ready( _ => { setTabsCounter(); } );

</script>

<div class="container">

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
        ?>
          <tr class="clickable-row">
            <td><?php echo $res[0]; ?></td>
            <td><?php echo $res[1]; ?></td>
            <td><?php echo $res[2]; ?></td>
            <td><?php echo $res[3]; ?></td>
            <td><?php echo ucfirst($res[4]); ?></td>
            <td><?php echo $res[5]; ?></td>
            <td><?php echo '<a href="javascript:fillModalMod( \'' . $res[3] . '\', \'' . $res[7] . '\', \'' . $res[8] . '\', \''  . $res[1] . '\', \'approved\')">' . 'Details </a>'; ?></td>
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
        ?>
          <tr class="clickable-row">
            <td><?php echo $res[0]; ?></td>
            <td><?php echo $res[1]; ?></td>
            <td><?php echo $res[2]; ?></td>
            <td><?php echo $res[3]; ?></td>
            <td><?php echo ucfirst($res[4]); ?></td>
            <td><?php echo $res[5]; ?></td>
            <td><?php echo '<a href="javascript:fillModalMod( \'' . $res[3] . '\', \'' . $res[7] . '\', \'' . $res[8] . '\', \''  . $res[1] . '\', \'pending\')">' . 'Details </a>'; ?></td>
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
        ?>
          <tr class="clickable-row">
            <td><?php echo $res[0]; ?></td>
            <td><?php echo $res[1]; ?></td>
            <td><?php echo $res[2]; ?></td>
            <td><?php echo $res[3]; ?></td>
            <td><?php echo ucfirst($res[4]); ?></td>
            <td><?php echo $res[5]; ?></td>
            <td><?php echo '<a href="javascript:fillModalMod( \'' . $res[3] . '\', \'' . $res[7] . '\', \'' . $res[8] . '\', \''  . $res[1] . '\', \'outdated\')">' . 'Details </a>'; ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
    
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
        ?>
          <tr class="clickable-row">
            <td><?php echo $res[0]; ?></td>
            <td><?php echo $res[1]; ?></td>
            <td><?php echo $res[2]; ?></td>
            <td><?php echo $res[3]; ?></td>
            <td><?php echo ucfirst($res[4]); ?></td>
            <td><?php echo $res[5]; ?></td>
            <td><?php echo '<a href="javascript:fillModalMod( \'' . $res[3] . '\', \'' . $res[7] . '\', \'' . $res[8] . '\', \''  . $res[1] . '\', \'rejected\')">' . 'Details </a>'; ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
    
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
          <h3>Actions</h3>
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


</body>


</html>
