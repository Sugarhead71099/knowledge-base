<?php

	include_once('../../../config.inc.php');
	include_once('../kbFunctions.php');


	if(isset($_POST['menuName']) && trim($_POST['menuName']) && isset($_POST['elem_id']) && isset($_POST['belongs_to'])) {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$name = htmlentities(strip_tags($_POST['menuName']));

		$stmt = $mysqli->prepare("SELECT id FROM kb_submenus WHERE name = ? AND belongs_to = ?");
		$stmt->bind_param('si', $name, $_POST['belongs_to']);
		$stmt->execute();
		$result = $stmt->get_result();
		$submenuID = $result->fetch_assoc();
		$stmt->close();

		echo "\n\nSubmenuID:\t" . $submenuID['id'] . "\n\n";
		$result = $mysqli->query("SELECT id FROM kb_protocols WHERE belongs_to = {$submenuID['id']};");
		$menuChildren = $result->fetch_assoc();
		$result->close();

		if(sizeof($menuChildren)) {
			// mysqli_query($con, "DELETE FROM knowledge_base WHERE id IN (" . implode(',', $menuChildren) . ");");	
			$mysqli->query("DELETE FROM kb_protocols WHERE belongs_to = {$submenuID['id']};");

			$filepath = '../' . getFolderpath('../mainTabs', '/' . $_POST['elem_id'] . '/' . removeSpacingAddCamelCase($_POST['menuName']));
			removeDirectoryRecursively($filepath);

			echo "Had Children";
		}

		$stmt = $mysqli->prepare("DELETE FROM kb_submenus WHERE name = ? AND belongs_to = ?");
		$stmt->bind_param('si', $name, $_POST['belongs_to']);
		$stmt->execute();
		$stmt->close();

		$mysqli->close();

		echo "\nDeleted Where name = '" . $name . "' And belongs_to = " . $_POST['belongs_to'];
	}

?>