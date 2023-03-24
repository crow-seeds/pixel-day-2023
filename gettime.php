<?php
	$con = mysqli_connect('', '', '', '');

	if(mysqli_connect_errno()){
		echo "err";
		exit();
	}

	$id = $_POST["id"];

	$initialQuery = $con->prepare("INSERT IGNORE INTO users (user_id, last_placed) VALUES (?, DATE_SUB(NOW(),INTERVAL 20 MINUTE))");
	$initialQuery->bind_param("i", $id);
	$initialQuery->execute();
	$initialQuery->close();


	$getTimeQuery = $con->prepare("SELECT last_placed FROM users WHERE user_id = ?");
	$getTimeQuery->bind_param("i", $id);
	$getTimeQuery->execute();
	$result = $getTimeQuery->get_result();

	while($row = $result->fetch_assoc()){
		echo $row['last_placed'];
	}
	$getTimeQuery->close();
?>