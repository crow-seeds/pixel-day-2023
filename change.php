<?php
	$con = mysqli_connect('', '', '', '');

	if(mysqli_connect_errno()){
		echo "err";
		exit();
	}

	$id = $_POST["id"];
	$color = $_POST["color"];
	$author = $_POST["author"];
	$user_id = $_POST["user_id"];

	$changeQuery = $con->prepare("UPDATE grid SET author = ?, color = ? WHERE id = ?");
	$changeQuery->bind_param("sii", $author, $color, $id);
	$changeQuery->execute();
	$changeQuery->close();

	$cooldownQuery = $con->prepare("INSERT INTO users (user_id, last_placed) VALUES (?, now()) ON DUPLICATE KEY UPDATE last_placed = now()");
	$cooldownQuery->bind_param("i", $user_id);
	$cooldownQuery->execute();
	$cooldownQuery->close();

	echo "SUCCESS";
?>