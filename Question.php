<?php
include('rake/rake.php');

session_start();


if(isset($_SESSION['name'])){
  $name = $_SESSION['name'];
  $fid = $_SESSION['id'];
}
else{
  header('Location: login.html');
}

require __DIR__ . '/vendor/autoload.php';
	# Imports the Google Cloud client library
use Google\Cloud\Translate\TranslateClient;
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
// date_default_timezone_set('Asia/Kolkata');
// $current_datetime = date('Y-m-d H:i:s');
if(isset($_POST['submit_text'])||isset($_POST['submit_img'])||isset($_POST['submit_audio'])){
	if(isset($_POST['submit_audio']) && is_uploaded_file($_FILES['audio_file']['tmp_name'])){
		$file=$_FILES['audio_file']; //audio/image file from the form
		$fileName=$file['name']; //Name of the file
		$fileTempName=$file['tmp_name']; //temp name stored by php
		$fileError=$file['error']; //If value=0 (no error) and value=1 (error)
		$fileType=$file['type']; //type ?? not used
		$fileEx = explode('.', $fileName); //Explode similar split in python
		$fileExt = strtolower(end($fileEx)); //lower case (JPG -> jpg) and from end()
		$allowed = array('mp3','ogg'); //accepted file types
		if(in_array($fileExt, $allowed)){
			$dir='Question/';
			$fileNewName = uniqid('',true).".".$fileExt;
			$path=$dir.basename($fileNewName);
			if(move_uploaded_file($fileTempName, $path)){
				echo "UPLOAD";
				insertdb(basename($fileNewName)); //Insert into questions table (only qid as of now)
				$var="<audio controls>
					<source src='".$path."' type='audio/mpeg'>
				</audio>";  //displays the audio file in html
				header('Location: indexForFarmer.php');
			}
		}else{
			$var="Incompatible File type";
		}
	}
	elseif (isset($_POST['submit_img']) && is_uploaded_file($_FILES['img_file']['tmp_name'])) {
		//upload the file to folder Question
		//Update the q relation with qid
		$file=$_FILES['img_file']; //audio/image file from the form
		$fileName=$file['name']; //Name of the file
		$fileTempName=$file['tmp_name']; //temp name stored by php
		$fileError=$file['error']; //If value=0 (no error) and value=1 (error)
		$fileType=$file['type']; //type ?? not used
		$fileEx = explode('.', $fileName); //Explode similar split in python
		$fileExt = strtolower(end($fileEx)); //lower case (JPG -> jpg) and from end()
		$allowed = array('jpeg','jpg','png'); //accepted file types
		if(in_array($fileExt, $allowed)){
			$dir='Question/';
			$fileNewName = uniqid('',true).".".$fileExt;
			$path=$dir.basename($fileNewName);
			if(move_uploaded_file($fileTempName, $path)){
				echo "UPLOAD";
				insertdb(basename($fileNewName)); //Insert into questions table (only qid as of now)
				$var="<img src=".$path." alt='Smiley face'>"; //displays image in html
				if(!empty($_POST['text_file'])){			
					//INSERT INTO IMG_TEXT TABLE THE imgname and text
					$textFileName = uniqid('',true).".txt";
					$textFileNewName = $dir.$textFileName;
					$var = $_POST['text_file'];
					$myfile = fopen($textFileNewName, "w") or die("Unable to open file!");
					insertImgText($textFileName,basename($fileNewName));
					fwrite($myfile, $var." n6a6m6i6t6a ");
					fclose($myfile);
					translateLang($textFileNewName,$var);

					$wordsTags = autoTagging($textFileNewName);
					insertTags($wordsTags);//Insert into tags table
					updateTag($wordsTags,basename($fileNewName));//Update into q_tag table
				}
				header('Location: indexForFarmer.php');
			}
		}else{
			$var="Incompatible File type";
		}
	}
	elseif (!empty($_POST['text'])) {

		$dir='Question/';
		$fileName = uniqid('',true).".txt";
		$fileNewName = $dir.$fileName;
		$var = $_POST['text'];
		$myfile = fopen($fileNewName, "w") or die("Unable to open file!");
		fwrite($myfile, $var." n6a6m6i6t6a ");
		fclose($myfile);
		translateLang($fileNewName,$var);

		$wordsTags = autoTagging($fileNewName);

		//print_r($wordsTags);

		$relatedQ = checkRelatedQuestions($fileName,$wordsTags);
		
		if(!empty($relatedQ)){
			//echo "string";
			$_SESSION['arrayRelated'] = $relatedQ;

			//print_r($relatedQ);
			header('Location: arrayRelatedFilter.php');

			//insertdb($fileName);
			//updateTag($wordsTags,$fileName);
		}
		else{
			insertdb($fileName);
			insertTags($wordsTags);
			updateTag($wordsTags,$fileName);
			header('Location: indexForFarmer.php');
		}
	}
}

function checkRelatedQuestions($qid1,$tags){

	$l = sizeof($tags);

	$qidArray = array();

	if($l>=3){
		
		$a = $tags[0];
		$b = $tags[1];
		$c = $tags[2];
		$sql = "SELECT * FROM q_tag WHERE (tag LIKE '%".$a."%' AND tag LIKE '%".$b."%' AND tag LIKE '%".$c."%')";

		$result = $GLOBALS['conn']->query($sql);
		  if ($result->num_rows > 0) {
		      // output data of each row
		      while($row = $result->fetch_assoc()) {
		          $qid =$row["qid"];
		    	  array_push($qidArray, $qid);
		      }
		  }

		  if(!empty($qidArray)){
		  	return $qidArray;
		  }

	}
	if($l==2) {

		$a = $tags[0];
		$b = $tags[1];
		$sql = "SELECT * FROM q_tag WHERE (tag LIKE '%".$a."%' AND tag LIKE '%".$b."%')";

		$result = $GLOBALS['conn']->query($sql);
		  if ($result->num_rows > 0) {
		      // output data of each row
		      while($row = $result->fetch_assoc()) {
		          $qid =$row["qid"];
		    	  array_push($qidArray, $qid);
		      }
		  }

		  if(!empty($qidArray)){
		  	return $qidArray;
		  }
	}
	if ($l==1) {

		$a = $tags[0];
		$sql = "SELECT * FROM q_tag WHERE (tag LIKE '%".$a."%')";

		$result = $GLOBALS['conn']->query($sql);
		  if ($result->num_rows > 0) {
		      // output data of each row
		      while($row = $result->fetch_assoc()) {
		          $qid =$row["qid"];
		    	  array_push($qidArray, $qid);
		      }
		  }

		  if(!empty($qidArray)){
		  	return $qidArray;
		  }
	}
	return $qidArray;
}


function translateLang($file,$input){
	$translate = new TranslateClient([
	    'key' => 'AIzaSyCF8Q_I0_0UVYFufryFb4ZghjCzKLU09_Y'
	]);
	$lang = $translate->detectLanguage($input);
	if(strcmp($lang['languageCode'],'en')!=0){
		$result = $translate->translate($input, [
		    'target' => 'en'
		]);
		$append = " ".$result['text'];
		//$myfile = file_put_contents($file, $append.PHP_EOL , FILE_APPEND | LOCK_EX);
	}
	else{
		$str = file_get_contents($file);
		$append = " ".$str;
	}
	$myfile = file_put_contents($file, $append.PHP_EOL , FILE_APPEND | LOCK_EX);
}

function autoTagging($fullFile){
	$str = file_get_contents($fullFile);

	$original = explode("n6a6m6i6t6a", $str);

	$rake = new Rake('rake/stoplist_smart.txt');
	$phrases = $rake->extract($original[1]);
	// $wordsTags=array();
	// $words = preg_split('/[\s]+/', $str );
	// $lengthWords = count($words);
	// $tags = fetchAllTags();
	// $lengthTags = count($tags);
	// for($x = 0; $x < $lengthWords; $x++) {
	//     for($y = 0; $y < $lengthTags; $y++) {
	//     	if(strcmp(strtolower($words[$x]),strtolower($tags[$y]))==0){
	//     		if(!in_array($tags[$y], $wordsTags, true)){
	//     			array_push($wordsTags,$tags[$y]);
	//     		}
	//     	}
	//     }
	// }
	//print_r ($phrases);
	$returnArray = array_slice(array_keys($phrases),0,3);
	//insertTags($returnArray);
	return $returnArray;
}
function insertTags($tags){
	$l=count($tags);
	for($x = 0; $x < $l; $x++) {

    	$sql = "INSERT INTO tags (tag) VALUES ('".$tags[$x]."')";
		if ($GLOBALS['conn']->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
		}
	}
}

function updateTag($tags,$qid){
	$l=count($tags);
	$temp = "";
	for($x = 0; $x < $l; $x++) {
		$temp = $temp.$tags[$x].",";
	}
	$sql = "INSERT INTO q_tag (tag,qid) VALUES ('".$temp."','".$qid."')";
	if ($GLOBALS['conn']->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
	}
}
function fetchAllTags(){
	$tags = array();
	$sql = "SELECT tag from tags";
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
function insertImgText($text,$img){
	
	$sql = "INSERT INTO qimgtext (img_id,text_id) VALUES ('".$img."','".$text."')";
	if ($GLOBALS['conn']->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
	}
}
function insertdb($question){
	
	$sql = "INSERT INTO q (qid,fid) VALUES ('".$question."','".$GLOBALS['fid']."')";
	if ($GLOBALS['conn']->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
	}
}
$GLOBALS['conn']->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

 <?php echo $var;?>

</body>
</html>