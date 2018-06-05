<?php
//include('rake/rake.php');

session_start();

if(isset($_SESSION['name'])){
  $name = $_SESSION['name'];
  $id = $_SESSION['id'];
  $type = $_SESSION['type'];
}
else{
  header('Location: login.php');
}

require __DIR__ . '/vendor/autoload.php';
	# Imports the Google Cloud client library
use Google\Cloud\Translate\TranslateClient;

if(isset($_POST['submit_text'])||isset($_POST['submit_img'])||isset($_POST['submit_audio'])){

	echo "Form submitted";
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
			$dir='Comment/';
			$fileNewName = uniqid('',true).".".$fileExt;
			$path=$dir.basename($fileNewName);
			if(move_uploaded_file($fileTempName, $path)){
				echo "UPLOAD";
				insertdb(basename($fileNewName)); //Insert into questions table (only qid as of now)
				// $var="<audio controls>
				// 	<source src='".$path."' type='audio/mpeg'>
				// </audio>";  //displays the audio file in html
			}
		}else{
			echo "Incompatible File type";
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

		$allowed = array('jpeg','jpg'); //accepted file types

		if(in_array($fileExt, $allowed)){
			$dir='Comment/';
			$fileNewName = uniqid('',true).".".$fileExt;
			$path=$dir.basename($fileNewName);
			if(move_uploaded_file($fileTempName, $path)){
				echo "UPLOAD";
				insertdb(basename($fileNewName)); //Insert into questions table (only qid as of now)
				// $var="<img src=".$path." alt='Smiley face'>"; //displays image in html
			}
		}else{
			echo "Incompatible File type";
		}

		if(!empty($_POST['text_file'])){	
				echo "Got text";		
				//INSERT INTO IMG_TEXT TABLE THE imgname and text
				$textFileName = uniqid('',true).".txt";
				$textFileNewName = $dir.$textFileName;
				$var = $_POST['text_file'];
				$myfile = fopen($textFileNewName, "w") or die("Unable to open file!");
				insertImgText($textFileName,basename($fileNewName));
				fwrite($myfile, $var." n6a6m6i6t6a ");
				fclose($myfile);
				translateLang($textFileNewName,$var);

				// $wordsTags = autoTagging($textFileNewName);
				// insertTags($wordsTags);//Insert into tags table
				// updateTag($wordsTags,basename($fileNewName));//Update into q_tag table
			}
		}
	elseif (!empty($_POST['text'])) {
		$dir='Comment/';
		$fileName = uniqid('',true).".txt";
		$fileNewName = $dir.$fileName;
		$var = $_POST['text'];
		$myfile = fopen($fileNewName, "w") or die("Unable to open file!");
		fwrite($myfile, $var." n6a6m6i6t6a ");
		fclose($myfile);
		translateLang($fileNewName,$var);

		// $wordsTags = autoTagging($fileNewName);
		insertdb($fileName);
		// insertTags($wordsTags);
		// updateTag($wordsTags,$fileName);

	}
	header('Location: login.php');

}

// function insertTags($tags){
// 	$servername = "localhost";
// 	$username = "root";
// 	$password = "";
// 	$dbname = "ks";

// 	// Create connection
// 	$conn = new mysqli($servername, $username, $password, $dbname);
// 	// Check connection
// 	if ($conn->connect_error) {
// 	    die("Connection failed: " . $conn->connect_error);
// 	} 

// 	$l=count($tags);
// 	for($x = 0; $x < $l; $x++) {

//     	$sql = "INSERT INTO tags (tag) VALUES ('".$tags[$x]."')";
// 		if ($conn->query($sql) === TRUE) {
// 		    echo "New record created successfully";
// 		} else {
// 		    echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
// 		}
// 	}
// }

// function updateTag($tags,$qid){
// 	$servername = "localhost";
// 	$username = "root";
// 	$password = "";
// 	$dbname = "ks";

// 	// Create connection
// 	$conn = new mysqli($servername, $username, $password, $dbname);
// 	// Check connection
// 	if ($conn->connect_error) {
// 	    die("Connection failed: " . $conn->connect_error);
// 	} 
// 	$l=count($tags);
// 	$temp = "";
// 	for($x = 0; $x < $l; $x++) {
// 		$temp = $temp.$tags[$x].",";
// 	}
// 	$sql = "INSERT INTO q_tag (tag,qid) VALUES ('".$temp."','".$qid."')";
// 	if ($conn->query($sql) === TRUE) {
// 	    echo "New record created successfully";
// 	} else {
// 	    echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
// 	}
// }

// function autoTagging($fullFile){
// 	$str = file_get_contents($fullFile);

// 	$original = explode("n6a6m6i6t6a", $str);

// 	$rake = new Rake('rake/stoplist_smart.txt');
// 	$phrases = $rake->extract($original[1]);
// 	$returnArray = array_slice(array_keys($phrases),0,3);
// 	return $returnArray;
// }

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

function insertImgText($text,$img){
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

	$sql = "INSERT INTO cimgtext (img_id,text_id) VALUES ('".$img."','".$text."')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	}


function insertdb($comment){

	$qid = $_POST['qid'];

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

	$sql = "INSERT INTO comments (qid,cid,user) VALUES ('".$qid."','".$comment."','".$GLOBALS['name']."')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	}

?>