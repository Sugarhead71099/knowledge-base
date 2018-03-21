<?php

	include_once('../../../config.inc.php');

	if(isset($_POST['elem_id']) && isset($_POST['text'])) {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	    if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$text = htmlentities(strip_tags($_POST['text']));

		$stmt = $mysqli->prepare("INSERT INTO knowledge_base_tree_hierarchy (elem_id, parent, text, opened, disabled, type, root_folder) VALUES (?, '#', ?, true, true, '#', ?)");
		$stmt->bind_param('sss', $_POST['elem_id'], $text, $_POST['elem_id']);
		$stmt->execute();
		$stmt->close();

		mysqli_close($mysqli);

	}
?>