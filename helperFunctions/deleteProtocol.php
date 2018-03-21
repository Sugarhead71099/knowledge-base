<?php

	include_once('../../../config.inc.php');
	include_once('../kbFunctions.php');

	if(isset($_POST['protocolName']) && isset($_POST['submenuBelongsTo']) && isset($_POST['parentMenu']) && isset($_POST['elem_id'])) {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$name = htmlentities(strip_tags($_POST['protocolName']));

		$parentMenu = htmlentities(strip_tags($_POST['parentMenu']));

		$stmt = $mysqli->prepare("SELECT id FROM kb_submenus WHERE name = ? AND belongs_to = ?");
		$stmt->bind_param('si', $parentMenu, $_POST['submenuBelongsTo']);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_assoc();
		$belongs_to = $result['id'];
		$stmt->close();

		$stmt = $mysqli->prepare("DELETE FROM kb_protocols WHERE name = ? AND belongs_to = ? LIMIT 1");
		$stmt->bind_param('si', $name, $belongs_to);
		$stmt->execute();
		$stmt->close();

		$filepath = '../' . getFolderpath('../mainTabs', $_POST['elem_id']) . '/' . removeSpacingAddCamelCase($_POST['parentMenu']) . '/' . removeSpacingAddCamelCase($_POST['protocolName']) . '.php';
		if(file_exists($filepath))
			unlink($filepath);

		$mysqli->close();

	}

?>