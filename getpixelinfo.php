<?php
	$con = mysqli_connect('', '', '', '');

	if(mysqli_connect_errno()){
		echo "err";
		exit();
	}

	$id = $_POST["id"];

	$getInfoQuery = $con->prepare("SELECT author FROM grid WHERE id = ?");
	$getInfoQuery->bind_param("i", $id);
	$getInfoQuery->execute();
	$result = $getInfoQuery->get_result();
	echo $result->fetch_assoc()['author'];
	$getInfoQuery->close();
?>