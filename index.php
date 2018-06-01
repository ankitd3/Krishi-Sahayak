<?php

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
//$sqlSolved = "SELECT qid,sid FROM qs WHERE qid in (select qid from q where q\.solved = 1)";
$sqlSolved = "SELECT * FROM q WHERE solved = 1";
$sqlUnsolved = "SELECT * FROM q WHERE solved = 0";

$allowedAudio = array('mp3','ogg'); //accepted file types
$allowedImage = array('jpeg','jpg','png'); //accepted file types

$solved = fetchQuestion($sqlSolved,1);//1-Solved
$unsolved = fetchQuestion($sqlUnsolved,0);//0-Solved

function fetchQuestion($sql,$solved){
  $temp = "";

  $result = $GLOBALS['conn']->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $farmerId= $row["fid"];
          $farmer_name = findname($farmerId,1);//1 for question
          $fileName = $row["qid"];
          $fileEx = explode('.', $fileName);
          $fileExt = strtolower(end($fileEx));
          //Enable commenting by clicking on it and go to comment section
          $temp = $temp."<a href='#comment' <p onclick=\"addQid('".$fileName."')\">Click to add qid in comments form automatically</p></a>";
          //array of tags returned for the question

          if(in_array($fileExt, $GLOBALS['allowedAudio'])){

            $temp = makeAudio($fileName,$farmer_name,$temp,"Question");//Question-Dir name
            // $textName = checkImgText($fileName,1);//1 for question
            // if($textName!=0){
            //   $temp = makeText($textName,"^^^^^",$temp,"Question");
            // }
          }
          elseif (in_array($fileExt, $GLOBALS['allowedImage'])) {

            $temp = makeImage($fileName,$farmer_name,$temp,"Question");
            $textName = checkImgText($fileName,1);//1 for question
            if($textName!=0){

              $tags = fetchTags($fileName);
          
              $temp = attachTags($tags,$temp);

              $temp = makeText($textName,"^^^^",$temp,"Question");
            }       
          }

          elseif (strcmp($fileExt,'txt')==0) {

            $tags = fetchTags($fileName);
          
            $temp = attachTags($tags,$temp);

            $temp = makeText($fileName,$farmer_name,$temp,"Question");
          }

          //attach solution(if any)
          if($solved!=0){
            $temp = fetchSolution($fileName,$temp);
          }
          else{
            $temp = $temp."<br><a href='SolutionE.php?qid=".$fileName."'>SOLVE ME</a>";
          }
          //Attach comments(if any)
          $temp = fetchComments($fileName,$temp);//check if there are any comments for the qid, returns an array with the filenames of comments to be included.
      }
      return $temp;
  } else {
      echo "0 results";
  }
}

function fetchTags($qid){
  $tags = array();
  $sql = "SELECT tag from q_tag where qid = '".$qid."'";
  $result = $GLOBALS['conn']->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $tag= $row["tag"];
          array_push($tags, $tag);
      }
    }
  return $tags;
}

function attachTags($tags,$temp){

    $length = count($tags);

    for($x = 0; $x < $length; $x++) {
      $temp = $temp . "<a href='filterQ.php?tag=".$tags[$x]."'>".$tags[$x]."</a>";
    }

    return $temp;
}

function fetchComments($qid,$temp){

  $myarray = array();
  $sql = "SELECT cid,user from comments where qid = '".$qid."'";
  $result = $GLOBALS['conn']->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $comment= $row["cid"];
          $user= $row["user"];
          $myarray = array_push_assoc($myarray, $comment, $user);
      }
    }
    else{
      return $temp;
    }
    foreach($myarray as $comment => $user) {
          $fileEx = explode('.', $comment);
          $fileExt = strtolower(end($fileEx));
          if(in_array($fileExt, $GLOBALS['allowedAudio'])){
                  $temp = makeAudio($comment,$user,$temp,"Comment");
          }
          elseif (in_array($fileExt, $GLOBALS['allowedImage'])) {
                  $temp = makeImage($comment,$user,$temp,"Comment");
                  $textName = checkImgText($comment,2);//2 for comments
                  if($textName!=0){
                    $temp = makeText($textName,"^^^^",$temp,"Comment");
                  }
          }
          elseif (strcmp($fileExt,'txt')==0) {
                  $temp = makeText($comment,$user,$temp,"Comment");
          }
    }
    return $temp;
}

function array_push_assoc($array, $key, $value){
  $array[$key] = $value;
  return $array;
}

function findname($id,$who){

  if($who==1){
    $sql = "SELECT name from farmer where fid = '".$id."'";
  }
  elseif ($who==2) {
    $sql = "SELECT name from expert where eid = '".$id."'";
  }
  $result = $GLOBALS['conn']->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $name= $row["name"];
      }
  }
  return $name;
}

function fetchSolution($fileName,$temp){

  $sqlSolution = "SELECT sid,eid FROM qs WHERE qid='".$fileName."'";
  $result = $GLOBALS['conn']->query($sqlSolution);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $solution= $row["sid"];
          $eid=$row["eid"];
          $expert = findname($eid,2);//2 identifies an expert
      }
  }
  $fileEx = explode('.', $solution);
  $fileExt = strtolower(end($fileEx));

  if(in_array($fileExt, $GLOBALS['allowedAudio'])){
    $temp = makeAudio($solution,$expert,$temp,"Solution");
    // $textName = checkImgText($solution,0);//0 for solution
    // if($textName!=0){
    //   $temp = makeText($textName,"^^^^^",$temp,"Solution");
    // }
  }
  elseif (in_array($fileExt, $GLOBALS['allowedImage'])) {
    $temp = makeImage($solution,$expert,$temp,"Solution");
    $textName = checkImgText($solution,0);//0 for solution
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
  
  if($check==1){ //check in question (with img and text)
    $sql = "SELECT text_id FROM qimgtext WHERE img_id='".$fileName."'";
  }
  elseif($check==0) { //check in solutions (with img and text)
    $sql = "SELECT text_id FROM simgtext WHERE img_id='".$fileName."'";
  }
  elseif($check==2) { //check in comments (with img and text)
    $sql = "SELECT text_id FROM cimgtext WHERE img_id='".$fileName."'";
  }
  $result = $GLOBALS['conn']->query($sql);
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

//Image display for Question,Solution,Comments
function makeAudio($fileName,$userId,$temp,$dir){
  if(strcmp($dir, "Question")==0){
      $temp = $temp."
          <div class=\"media text-muted pt-3\">
            <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
            <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
              <h2>@".$userId."</h2>
              <audio controls>
                <source src='".$dir."/".$fileName."' type='audio/mpeg'>
              </audio>
            </p>
          </div> ";
      return $temp;
  }
  elseif (strcmp($dir, "Solution")==0) {
    $temp = $temp."
          <div class=\"media text-muted pt-3\">
            <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
            <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
              <strong class=\"d-block text-gray-dark\">@".$userId."</strong>
              <audio controls>
                <source src='".$dir."/".$fileName."' type='audio/mpeg'>
              </audio>
            </p>
          </div> ";
      return $temp;
  }
  elseif (strcmp($dir, "Comment")==0) {
    $temp = $temp."
          <div class=\"media text-muted pt-3\">
            <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
            <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
              <strong class=\"d-block text-gray-dark\">@".$userId."</strong>
              <audio controls>
                <source src='".$dir."/".$fileName."' type='audio/mpeg'>
              </audio>
            </p>
          </div> ";
      return $temp;
  }
}
//Image display for Question,Solution,Comments
function makeImage($fileName,$userId,$temp,$dir){
  if(strcmp($dir, "Question")==0){
    $temp = $temp."
        <div class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$userId."</strong>
            <img src=\"".$dir."/".$fileName."\" class=\"thumbnail\" alt='Smiley face' height=\"100px\" width=\"100px\">
          </p>
        </div> ";
    return $temp;
  }
  elseif (strcmp($dir, "Solution")==0) {
    $temp = $temp."
        <div class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$userId."</strong>
            <img src=\"".$dir."/".$fileName."\" class=\"thumbnail\" alt='Smiley face' height=\"100px\" width=\"100px\">
          </p>
        </div> ";
    return $temp;
  }
  elseif (strcmp($dir, "Comment")==0) {
    $temp = $temp."
        <div class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$userId."</strong>
            <img src=\"".$dir."/".$fileName."\" class=\"thumbnail\" alt='Smiley face' height=\"100px\" width=\"100px\">
          </p>
        </div> ";
    return $temp;
  }
}
//Text display for Question,Solution,Comments
function makeText($fileName,$userId,$temp,$dir){

  $myfile = fopen($dir."/".$fileName,"r") or die("Unable to open file!");
  $text = fread($myfile,filesize($dir."/".$fileName));
  fclose($myfile);

  $original = explode("n6a6m6i6t6a", $text);

  $originalId = $fileName.'original';
  $translatedId = $fileName.'translated';

  if(strcmp($dir, "Question")==0){

    $temp = $temp."
        <div id=\"".$originalId."\" class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$userId."</strong>".
              $original[0]."
          </p>
        </div> ";

    $temp = $temp."
        <div id=\"".$translatedId."\" style=\"display: none;\" class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$userId."</strong>".
              $original[1]."
          </p>
        </div> ";

    $temp = $temp."<button onclick=\"toggle('".$originalId."','".$translatedId."')\">Translate</button>";

  return $temp;
  }
  elseif (strcmp($dir, "Solution")==0) {
    $temp = $temp."
        <div id=\"".$originalId."\" class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$userId."</strong>".
              $original[0]."
          </p>
        </div> ";

    $temp = $temp."
        <div id=\"".$translatedId."\" style=\"display: none;\" class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$userId."</strong>".
              $original[1]."
          </p>
        </div> ";

    $temp = $temp."<button onclick=\"toggle('".$originalId."','".$translatedId."')\">Translate</button>";
  return $temp;
  }
  elseif (strcmp($dir, "Comment")==0) {
    $temp = $temp."
        <div id=\"".$originalId."\" class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$userId."</strong>".
              $original[0]."
          </p>
        </div> ";

    $temp = $temp."
        <div id=\"".$translatedId."\" style=\"display: none;\" class=\"media text-muted pt-3\">
          <img data-src=\"holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1\" alt=\"\" class=\"mr-2 rounded\">
          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">@".$userId."</strong>".
              $original[1]."
          </p>
        </div> ";

    $temp = $temp."<button onclick=\"toggle('".$originalId."','".$translatedId."')\">Translate</button>";
    return $temp;
  }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <!--custom css-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,900" rel="stylesheet">
    <link rel="stylesheet" href="css/something.css">
</head>

<body>
<nav class="navbar navbar-expand-md">
        <a href="#" style="color: #FAFEF9" class="navbar-brand"> Q/A App for farmers </a>
        <div id="google_translate_element"></div>
        <button type="button" data-target="#menu" data-toggle="collapse" aria-controls="menu" aria-expanded="false" aria-label="toggle navigation"
            class="navbar-toggler navbar-dark">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Ask question</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Frequently asked</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Signout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container text-center">
        <h1>Krishi Sahayak</h1>
    </div>
    <hr>

    <!--yo-->

    <div class="container">
      
      <div class="card">
            <div class="card-header text-white">
                Solved 
            </div>

        <?php echo $solved;?>

      </div>



      <div class="card">
            <div class="card-header text-white">
                Unsolved 
            </div>
        
        <?php echo $unsolved;?>

      </div>

      <!--COMMENTS BEAUTIFY IT LIKE IN testOption.html-->
      <form id="comment" action = "comments.php" enctype="multipart/form-data" method="POST">
          <div class="form-group">
              <input type="text" id="audioComment" name="qid">
              <label for="audio_file">Upload audio here</label>
              <input type="file" name="audio_file" accept = "audio/*" class="form-control-file" id="audio_file">
          </div>
              <button type="submit" name="submit_audio" class="btn btn-lg">Post</button>       
      </form>

      <form action = "comments.php" method="POST">
          <div class="form-group">
              <input type="text" id="textComment" name="qid">
              <label for="text">Type question here</label>
              <textarea class="form-control" name="text" rows="5" id="text"></textarea>
          </div>
          <button type="submit" name="submit_text" class="btn btn-lg">Post</button>       
      </form> 

      <form action = "comments.php" enctype="multipart/form-data" method="POST">
          <div class="form-group">
              <input type="text" id="imgComment" name="qid">
              <label for="img_file">Upload your image here</label>
              <input type="file" name="img_file" class="form-control-file" id="img_file">
          </div>
          <div class="form-group">
              <label for="info">Question details:</label>
              <textarea class="form-control" name="text_file" rows="5" id="info"></textarea>
          </div>
          <button type="submit" name="submit_img" class="btn btn-lg">Post</button>       
      </form>
      <!--END OF COMMENTS FORMS -->

    </main>

    <script type="text/javascript">
        function addQid(qid){
          document.getElementById('audioComment').value=qid;
          document.getElementById('imgComment').value=qid;
          document.getElementById('textComment').value=qid;          
        }

        function toggle(id1,id2) {

          console.log(id2);

           var original = document.getElementById(id1); 
           var translated = document.getElementById(id2);

           original.style.display = (
               original.style.display == "none" ? "block" : "none"); 
           translated.style.display = (
               translated.style.display == "none" ? "block" : "none"); 
        }

    </script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
    </script>

    <script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

  </body>
</html>

