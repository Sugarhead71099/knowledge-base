<?php

	include_once('../../../config.inc.php');
	include_once('../kbFunctions.php');

	if(isset($_POST['oldName']) && isset($_POST['newName']) && isset($_POST['belongs_to']) && isset($_POST['elem_id'])) {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$oldName = htmlentities(strip_tags($_POST['oldName']));

		$name = htmlentities(strip_tags($_POST['newName']));

		// $badLinkNameChars = array("\\", "'");
		// $link_name = mysqli_real_escape_string($con, trim(str_replace($badLinkNameChars, "", removeSpacingAddCamelCase($_POST['newName'])) . "Body"));

		$reference_name = preg_replace('/\s+/', '', str_replace($badChars, '', lcfirst(ucwords(trim(removeSpacingAddCamelCase($_POST['newName']))))));

		$stmt = $mysqli->prepare("SELECT id FROM kb_submenus WHERE name = ? AND belongs_to = ?");
		$stmt->bind_param('si', $name, $_POST['belongs_to']);
		$stmt->execute();
		$existingSubmenu = $stmt->get_result();
		$stmt->close();

		if(!$existingSubmenu->num_rows) {
			$stmt = $mysqli->prepare("UPDATE kb_submenus SET name = ?, reference_name = ? WHERE belongs_to = ? LIMIT 1");
			$stmt->bind_param('ssi', $name, $reference_name, $_POST['belongs_to']);
			$stmt->execute();
			$stmt->close();

			$folderpath = '../' . getFolderpath('../mainTabs', $_POST['elem_id']);
			$oldFilePath = $folderpath . '/' . removeSpacingAddCamelCase($_POST['oldName']);
			$newFilePath = $folderpath . '/' . removeSpacingAddCamelCase($_POST['newName']);
			if(file_exists($oldFilePath))
				rename($oldFilePath, $newFilePath);
		}

		$mysqli->close();

	}

?>