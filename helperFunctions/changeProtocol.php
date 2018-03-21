<?php

	include_once('../../../config.inc.php');
	include_once('../kbFunctions.php');

	if(isset($_POST['oldName']) && isset($_POST['newName']) && isset($_POST['submenuBelongsTo']) && isset($_POST['parentMenu']) && isset($_POST['elem_id'])) {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$oldName = htmlentities(strip_tags($_POST['oldName']));

		$name = htmlentities(strip_tags($_POST['newName']));

		$parentMenu = htmlentities(strip_tags($_POST['parentMenu']));

		// $badLinkNameChars = array("#", "%", "\\", "?", "/");
		// $link_name = mysqli_real_escape_string($con, trim(str_replace($badLinkNameChars, "", strtolower($_POST["newName"]))));

		$oldReferenceName = preg_replace("/\s+/", "", str_replace($badChars, "", lcfirst(ucwords(trim(strtolower($_POST["oldName"]))))));
		$reference_name = preg_replace("/\s+/", "", str_replace($badChars, "", lcfirst(ucwords(trim(strtolower($_POST["newName"]))))));

		$stmt = $mysqli->prepare("SELECT id FROM kb_submenus WHERE name = ? AND belongs_to = ?");
		$stmt->bind_param('si', $parentMenu, $_POST['submenuBelongsTo']);
		$stmt->execute();
		$results = $stmt->get_result();
		$result = $results->fetch_assoc();
		$belongs_to = $result['id'];
		$stmt->close();

		$stmt = $mysqli->prepare("SELECT id FROM kb_protocols WHERE name = ? AND belongs_to = ?");
		$stmt->bind_param('si', $name, $belongs_to);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();

		if(!$result->num_rows) {
			$stmt = $mysqli->prepare("UPDATE kb_protocols SET name = ?, reference_name = ? WHERE name = ? AND belongs_to = ?");
			$stmt->bind_param('sssi', $name, $reference_name, $oldName, $belongs_to);
			$stmt->execute();
			$stmt->close();

			$folderpath = '../' . getFolderpath('../mainTabs', $_POST['elem_id']) . '/' . removeSpacingAddCamelCase($_POST['parentMenu']);
			$oldFilepath = $folderpath . '/' . $oldReferenceName . '.php';
			$newFilepath= $folderpath . '/' . $reference_name . '.php';

			// echo "Old Filepath:\t" . $oldFilepath . "\nNew Filepath:\t" . $newFilepath\n\n";

			$fileContents = file_get_contents($oldFilepath);
			$fileContents = str_replace('>' . $oldName . '</h1>', '>' . $name . '</h1>', $fileContents);
			$fileContents = str_replace('id="accordion' . $oldReferenceName, 'id="accordion' . $reference_name, $fileContents);
			$fileContents = str_replace('data-parent="#accordion' . $oldReferenceName, 'data-parent="#accordion' . $reference_name, $fileContents);
			$fileContents = str_replace('href="#collapse' . $oldReferenceName, 'href="#collapse' . $reference_name, $fileContents);
			$fileContents = str_replace('aria-controls="collapse' . $oldReferenceName, 'aria-controls="collapse' . $reference_name, $fileContents);
			$fileContents = str_replace('id="collapse' . $oldReferenceName, 'id="collapse' . $reference_name, $fileContents);
			$fileContents = str_replace('aria-labelledby="heading' . $oldReferenceName, 'aria-labelledby="heading' . $reference_name, $fileContents);
			file_put_contents($oldFilepath, $fileContents);

			rename($oldFilepath, $newFilepath);
		}

		$mysqli->close();
	}

?>