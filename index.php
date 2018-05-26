<?php
//$sqlSolved = "SELECT qid,sid FROM qs WHERE qid in (select qid from q where q\.solved = 1)";
$sqlSolved = "SELECT * FROM q WHERE solved = 1";
$sqlUnsolved = "SELECT * FROM q WHERE solved = 0";

$solved = fetchsql($sqlSolved,1);
$unsolved = fetchsql($sqlUnsolved,0);

function fetchsql($sql,$solved){
  $temp = "";

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ks";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $farmerId= $row["fid"];
          $fileName = $row["qid"];

          $fileEx = explode('.', $fileName);
          $fileExt = strtolower(end($fileEx));

          if(strcmp($fileExt,'mp3')==0){
            $temp = makeAudio($fileName,$farmerId,$temp,"Question");
            $textName = checkImgText($fileName,1);
            if($textName!=0){
              $temp = makeText($textName,"^^^^^",$temp,"Question");
            }
            
            if($solved!=0){
              $temp = findsolution($fileName,$temp);
            }

          }
          elseif (strcmp($fileExt,'jpg')==0) {
            $temp = makeImage($fileName,$farmerId,$temp,"Question");
            $textName = checkImgText($fileName,1);
            if($textName!=0){
              $temp = makeText($textName,"^^^^",$temp,"Question");
            }
            
            if($solved!=0){
              $temp = findsolution($fileName,$temp);
            }

          }
          elseif (strcmp($fileExt,'txt')==0) {
            $temp = makeText($fileName,$farmerId,$temp,"Question");
            
            if($solved!=0){
              $temp = findsolution($fileName,$temp);
            }
          }
      }
      return $temp;
  } else {
      echo "0 results";
  }
  $conn->close();
}

function findsolution($fileName,$temp){
  
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ks";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  $sqlSolution = "SELECT sid,eid FROM qs WHERE qid='".$fileName."'";

  $result = $conn->query($sqlSolution);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $solution= $row["sid"];
          $expert=$row["eid"];
      }
  }
  $fileEx = explode('.', $solution);
  $fileExt = strtolower(end($fileEx));

  if(strcmp($fileExt,'mp3')==0){
    $temp = makeAudio($solution,$expert,$temp,"Solution");
    $textName = checkImgText($solution,0);
    if($textName!=0){
      $temp = makeText($textName,"^^^^^",$temp,"Solution");
    }
  }
  elseif (strcmp($fileExt,'jpg')==0) {
    $temp = makeImage($solution,$expert,$temp,"Solution");
    $textName = checkImgText($solution,0);
    if($textName!=0){
      $temp = makeText($textName,"^^^^",$temp,"Solution");
    }
  }
  elseif (strcmp($fileExt,'txt')==0) {
    $temp = makeText($solution,$expert,$temp,"Solution");
  }
  return $temp;
}

function checkImgText($fileName,$check){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ks";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  if($check!=0){
    $sql = "SELECT text_id FROM qimgtext WHERE img_id='".$fileName."'";
  }
  else {
    $sql = "SELECT text_id FROM simgtext WHERE img_id='".$fileName."'";
  }
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $textFetched= $row["text_id"];
      }
      return $textFetched;
  }
  else{
    return 0;
  }

}

function makeAudio($fileName,$farmerId,$temp,$dir){
  $temp = $temp."
        <div class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$farmerId."</strong>
            <audio controls>
              <source src='".$dir."/".$fileName."' type='audio/mpeg'>
            </audio>
          </p>
        </div> ";
  return $temp;

}
function makeImage($fileName,$farmerId,$temp,$dir){
    $temp = $temp."
        <div class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$farmerId."</strong>
            <img src=\"".$dir."/".$fileName."\" alt='Smiley face' height=\"100px\" width=\"100px\">
          </p>
        </div> ";
  return $temp;
  
}
function makeText($fileName,$farmerId,$temp,$dir){
    $myfile = fopen($dir."/".$fileName,"r") or die("Unable to open file!");
    $temp = $temp."
        <div class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$farmerId."</strong>".
              fread($myfile,filesize($dir."/".$fileName))."
          </p>
        </div> ";
    fclose($myfile);
  return $temp;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>KS</title>
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body class="bg-light">

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
      <a class="navbar-brand mr-auto mr-lg-0" href="#">Krishi Sahayak</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Questions <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Notifications</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Friends <span class="badge badge-pill bg-light align-text-bottom">27</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Switch account</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">LANGUAGE</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="nav-scroller bg-white box-shadow">
      <nav class="nav nav-underline">
        <a class="nav-link active" href="#">TAGS</a>
        
        <a class="nav-link" href="#">Crops</a>
        <a class="nav-link" href="#">Soil</a>
        <a class="nav-link" href="#">Weather</a>
        <a class="nav-link" href="#">Irrigation</a>
        <a class="nav-link" href="#">Fertilizers</a>
        <a class="nav-link" href="#">Loans</a>
        <a class="nav-link" href="#">Seeds</a>
      </nav>
    </div>

    <main role="main" class="container">
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="question.png" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">ASK QUESTIONS</h6>
          <small>VOICE NOTES - TEXT - IMAGES</small>
        </div>
      </div>

      <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">SOLVED</h6>

        <?php echo $solved;?>

        <small class="d-block text-right mt-3">
          <a href="#">All updates</a>
        </small>
      </div>

      <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">UNSOLVED</h6>
        

        <?php echo $unsolved;?>


        <small class="d-block text-right mt-3">
          <a href="#">All suggestions</a>
        </small>
      </div>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script src="offcanvas.js"></script>
  </body>
</html>

