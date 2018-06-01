<?php

require __DIR__ . '/vendor/autoload.php';
	# Imports the Google Cloud client library
use Google\Cloud\Translate\TranslateClient;

$qid=$_POST['qid'];

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
			$dir='Solution/';
			$fileNewName = uniqid('',true).".".$fileExt;
			$path=$dir.basename($fileNewName);
			if(move_uploaded_file($fileTempName, $path)){
				echo "UPLOAD";

				//input from "Solve Me"
				insertdb(basename($fileNewName),$qid);

				$var="<audio controls>
					<source src='".$path."' type='audio/mpeg'>
				</audio>";  //displays the audio file in html
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
			$dir='Solution/';
			$fileNewName = uniqid('',true).".".$fileExt;
			$path=$dir.basename($fileNewName);
			if(move_uploaded_file($fileTempName, $path)){
				echo "UPLOAD";


				insertdb(basename($fileNewName),$qid); //Insert into questions table (only qid as of now)
				
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
				}
			}
		}else{
			$var="Incompatible File type";
		}
	}
	elseif (!empty($_POST['text'])) {
		$dir='Solution/';
		$fileName = uniqid('',true).".txt";
		$fileNewName = $dir.$fileName;
		$var = $_POST['text'];
		$myfile = fopen($fileNewName, "w") or die("Unable to open file!");
		insertdb($fileName,$qid);
		fwrite($myfile, $var." n6a6m6i6t6a ");
		fclose($myfile);

		translateLang($fileNewName,$var);
	}
}

function translateLang($file,$input){

	$translate = new TranslateClient([
	    'key' => ''
	]);

	$lang = $translate->detectLanguage($input);

	if(strcmp($lang['languageCode'],'en')!=0){

		$result = $translate->translate($input, [
		    'target' => 'en'
		]);

		$append = " ".$result['text'];

		$myfile = file_put_contents($file, $append.PHP_EOL , FILE_APPEND | LOCK_EX);

	}

}

function insertImgText($text,$img){

	$sql = "INSERT INTO simgtext (img_id,text_id) VALUES ('".$img."','".$text."')";

	if ($GLOBALS['conn']->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
	}
}

function insertdb($solution,$question){
	
	$sql = "INSERT INTO qs (qid,sid) VALUES ('".$question."','".$solution."')";

	if ($GLOBALS['conn']->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
	}
}

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