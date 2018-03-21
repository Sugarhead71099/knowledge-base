<?php

	include_once('../../../config.inc.php');
	include_once('../kbFunctions.php');

	if(isset($_POST['tabName']) && isset($_POST['elem_id'])) {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$name = htmlentities(strip_tags($_POST['tabName']));

		// Get Associated Root Folder ID
		$stmt = $mysqli->prepare("SELECT id FROM knowledge_base_tree_hierarchy WHERE root_folder = ? AND submenu_request_file = 1");
		$stmt->bind_param('s', $_POST['elem_id']);
		$stmt->execute();
		$results = $stmt->get_result();
		$stmt->close();

		// Delete All Associated Protocols And Submenus
		while($submenuRequestFiles = $results->fetch_assoc()) {
			$assocSubmenus = $mysqli->query("SELECT id FROM kb_submenus WHERE belongs_to = {$submenuRequestFiles['id']};");
			if($assocSubmenus->num_rows) {
				// $protocolDelQuery = "";
				while($submenus = $assocSubmenus->fetch_assoc()) {
					$mysqli->query("DELETE FROM kb_protocols WHERE belongs_to = {submenus['id']};");
					$mysqli->query("DELETE FROM kb_submenus WHERE id = {$submenus['id']};");
				}
			}
			$assocSubmenus->close();
		}

		// Delete All Associated Tree Nodes (Delete Tree)
		$stmt = $mysqli->prepare("DELETE FROM knowledge_base_tree_hierarchy WHERE root_folder = ?");
		$stmt->bind_param('s', $_POST['elem_id']);
		$stmt->execute();
		$stmt->close();

		// Delete Main Tab
		$stmt = $mysqli->prepare("DELETE FROM kb_tabs WHERE name = ? LIMIT 1");
		$stmt->bind_param('s', $name);
		$stmt->execute();
		$stmt->close();

		$filepath = preg_replace('/\s+/', '', str_replace($badChars, '', removeSpacingAddCamelCase($_POST['tabName'])));
		removeDirectoryRecursively('../mainTabs/' . $filepath);

		$mysqli->close();

	}

?>