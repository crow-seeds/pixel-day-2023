<?php
	$con = mysqli_connect('', '', '', '');

	if(mysqli_connect_errno()){
		echo "err";
		exit();
	}

	$startID = $_POST["startID"];
	$endID = $_POST["endID"];

	$getTimeQuery = $con->prepare("SELECT frame_time FROM frames WHERE current_frame >= ? AND current_frame < ? ORDER BY current_frame ASC");
	$getTimeQuery->bind_param("ii", $startID, $endID);
	$getTimeQuery->execute();
	$result = $getTimeQuery->get_result();

	while($row = $result->fetch_assoc()){
		echo $row['frame_time'];
		echo "\t";
	}
	$getTimeQuery->close();
?>