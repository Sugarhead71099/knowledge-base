<?php
	include_once('../../../config.inc.php');

	if(isset($_POST['elem_id']) && isset($_POST['text'])) {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$text = htmlentities(strip_tags($_POST['text']));

		$stmt = $mysqli->prepare("UPDATE knowledge_base_tree_hierarchy SET text = ? WHERE elem_id = ?");
		$stmt->bind_param('ss', $text, $_POST['elem_id']);
		$stmt->execute();
		$stmt->close();

		$mysqli->close();
	}
?>