<?php

	include_once('../../../config.inc.php');
	include_once('../kbFunctions.php');

	if(isset($_POST['menuName']) && isset($_POST['belongs_to'])) {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$name = htmlentities(strip_tags($_POST['menuName']));

		// $badLinkNameChars = array("\\", "'");
		// $link_name = mysqli_real_escape_string($con, trim(str_replace($badLinkNameChars, "", removeSpacingAddCamelCase($_POST["menuName"])))) . "Body";

		$reference_name = preg_replace('/\s+/', '', str_replace($badChars, '', lcfirst(ucwords(trim(removeSpacingAddCamelCase($_POST['menuName']))))));

		$stmt = $mysqli->prepare("SELECT id FROM kb_submenus WHERE name = ? AND belongs_to = ?");
		$stmt->bind_param('si', $name, $_POST['belongs_to']);
		$stmt->execute();
		$existingSubmenu = $stmt->get_result();
		$stmt->close();

		if(!$existingSubmenu->num_rows) {
			$stmt = $mysqli->prepare("INSERT INTO kb_submenus (name, belongs_to, reference_name) VALUES (?, ?, ?)");
			$stmt->bind_param('sis', $name, $_POST['belongs_to'], $reference_name);
			$stmt->execute();
			$stmt->close();
		}

		$mysqli->close();

	}

?>