<?php
	$con = mysqli_connect('', '', '', '');

	if(mysqli_connect_errno()){
		echo "err";
		exit();
	}

	$currentFrame = $_POST["currentFrame"];

	$searchString = "SELECT id, color, author FROM grid WHERE time >= DATE_SUB(NOW(),INTERVAL 20 SECOND) ORDER BY id ASC";
	$result = $con->query($searchString); 

	while ($row = $result->fetch_assoc()) {
		echo $row['id'];
    	echo "\t";
    	echo $row['color'];
    	echo "\t";
    	echo $row['author'];
    	echo "\t";
	}

	$infoString = "SELECT current_frame, frame_time FROM info";
	$infoResult = $con->query($infoString);
	$row = $infoResult->fetch_assoc();

	if($row['current_frame'] != $currentFrame){
		echo $row['frame_time'];
	}


?>