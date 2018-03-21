<?php

	include_once('../../../config.inc.php');
	include_once('../kbFunctions.php');

	if(isset($_POST['oldName']) && isset($_POST['newName']) && isset($_POST['old_elem_id']) && isset($_POST['new_elem_id'])) {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$oldName = htmlentities(strip_tags(addSpacingNormal($_POST['oldName'])));

		$name = htmlentities(strip_tags(addSpacingNormal($_POST['newName'])));

		// $badLinkNameChars = array("#", "%", "\\", "?", "/");
		// $link_name = mysqli_real_escape_string($con, trim(str_replace($badLinkNameChars, "", $_POST["newName"])));

		$old_reference_name = preg_replace('/\s+/', '', str_replace($badChars, '', lcfirst(ucwords(trim($_POST['oldName'])))));
		$reference_name = preg_replace('/\s+/', '', str_replace($badChars, '', lcfirst(ucwords(trim($_POST['newName'])))));

		$stmt = $mysqli->prepare("UPDATE kb_tabs SET name = ?, reference_name = ? WHERE name = ? LIMIT 1");
		$stmt->bind_param('sss', $name, $reference_name, $oldName);
		$stmt->execute();
		$stmt->close();

		$stmt = $mysqli->prepare("UPDATE knowledge_base_tree_hierarchy SET elem_id = ?, text = ?, root_folder = ? WHERE elem_id = ? LIMIT 1");
		$stmt->bind_param('ssss', $_POST['new_elem_id'], $reference_name, $_POST['new_elem_id'], $_POST['old_elem_id']);
		$stmt->execute();
		$stmt->close();

		$oldFilePath = '../mainTabs/' . $old_reference_name;
		$newFilePath = '../mainTabs/' . $reference_name;
		rename($oldFilePath, $newFilePath);
		rename($newFilePath . '/' . $old_reference_name . '.php', $newFilePath . '/' . $reference_name . '.php');

		replaceInFile($newFilePath . '/' . $reference_name . '.php', '<h4 class="text-dark header-title m-t-0 m-b-30">' . substr($_POST['old_elem_id'], 0, strrpos($_POST['old_elem_id'], 'Root')) . '</h4>', '<h4 class="text-dark header-title m-t-0 m-b-30">' . substr($_POST['new_elem_id'], 0, strrpos($_POST['new_elem_id'], 'Root')) . '</h4>');

		$mysqli->close();

	}

?>