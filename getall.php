<?php
	$con = mysqli_connect('', '', '', '');

	if(mysqli_connect_errno()){
		echo "err";
		exit();
	}

	$searchString = "SELECT color FROM grid ORDER BY id ASC";
	$result = $con->query($searchString); 

	while ($row = $result->fetch_assoc()) {
    	echo $row['color'];
    	echo "\t";
	}

	$infoQuery = "SELECT current_frame, frame_time FROM info";
	$infoResult = $con->query($infoQuery); 
	$info = $infoResult->fetch_assoc();
	echo $info['current_frame'];
	echo "\t";
	echo $info['frame_time'];
	echo "\t";
	echo time();
?>