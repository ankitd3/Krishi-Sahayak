<?php

if(isset($_POST['save_audio'])&&$_POST['save_audio']=="UPLOAD AUDIO"){
	$dir='Uploads/';
	$audio_path=$dir.basename($_FILES['audioFile']['name']);
	if(move_uploaded_file($_FILES['audioFile']['tmp_name'], $audio_path)){
		echo "UPLOAD";
		$var="<audio controls>
				<source src='".$audio_path."' type='audio/mpeg'>
			</audio>";
	}
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