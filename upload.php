<?php

if(isset($_POST['save_audio'])){

	$file=$_FILES['audio_img_file'];
	$fileName=$file['name'];
	$fileTempName=$file['tmp_name'];
	$fileError=$file['error'];
	$fileType=$file['type'];

	$fileEx = explode('.', $fileName);
	$fileExt = strtolower(end($fileEx));

	$allowed = array('jpeg','jpg','mp3','ogg');

	if(in_array($fileExt, $allowed)){
		$dir='Uploads/';
		$fileNewName = uniqid('',true).".".$fileExt;
		$path=$dir.basename($fileNewName);
		if(move_uploaded_file($fileTempName, $path)){
			echo "UPLOAD";
		}
		if(strcmp($fileExt,'mp3')==0){
			$var="<audio controls>
				<source src='".$path."' type='audio/mpeg'>
			</audio>";
		}
		elseif (strcmp($fileExt,'jpg')==0) {
			$var="<img src=".$path." alt='Smiley face'>";
		}

	}else{
		$var="Incompatible File type";
	}

	//echo $fileExt;

}
if(isset($_POST['text_submit'])){
	$var = $_POST['text_submit'];
}

// function save_audio($filename){

// 	$conn = 
// }

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