<?php
	
	include_once('../../../config.inc.php');
	include_once('../kbFunctions.php');

	if(isset($_POST['protocolName']) && isset($_POST['parentMenu']) && isset($_POST['submenuBelongsTo'])) {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$name = htmlentities(strip_tags($_POST['protocolName']));
		$parentMenu = htmlentities(strip_tags($_POST['parentMenu']));

		// $badLinkNameChars = array("#", "%", "\\", "?", "/");
		// $link_name = mysqli_real_escape_string($con, trim(str_replace($badLinkNameChars, "", strtolower($_POST["protocolName"]))));

		$reference_name = preg_replace('/\s+/', '', str_replace($badChars, '', lcfirst(ucwords(trim(strtolower($_POST['protocolName']))))));

		$stmt = $mysqli->prepare("SELECT id FROM kb_submenus WHERE name = ? AND belongs_to = ?");
		$stmt->bind_param('si', $_POST['parentMenu'], $_POST['submenuBelongsTo']);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_assoc();
		$belongs_to = $result['id'];
		$stmt->close();

		$stmt = $mysqli->prepare("SELECT id FROM kb_protocols WHERE name = ? AND belongs_to = ?");
		$stmt->bind_param('si', $name, $belongs_to);
		$stmt->execute();
		$protocolExists = $stmt->get_result();
		$stmt->close();

		if(!$protocolExists->num_rows) {
			$stmt = $mysqli->prepare("INSERT INTO kb_protocols (name, belongs_to, reference_name) VALUES (?, ?, ?)");
			$stmt->bind_param('sis', $name, $belongs_to, $reference_name);
			$stmt->execute();
			$stmt->close();
		}

		$mysqli->close();

	}
	
?>