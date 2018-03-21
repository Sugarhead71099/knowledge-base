<?php
	
	include_once('../../../config.inc.php');
	
	if(isset($_POST['elem_id']) && isset($_POST['parent']) && isset($_POST['text']) && isset($_POST['icon']) && isset($_POST['type']) && isset($_POST['root_folder']) && isset($_POST['submenu_request_file']) && isset($_POST['allParents']) && isset($_POST['fileData'])) {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	    if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$stmt = $mysqli->prepare("SELECT MAX(id) FROM knowledge_base_tree_hierarchy WHERE root_folder = ?");
		$stmt->bind_param('s', $_POST['root_folder']);
		$stmt->execute();
		$stmt->bind_result($highestID);
		$stmt->fetch();
		$stmt->close();

		$elem_id = $_POST['elem_id'] . '_' . ($highestID + 1);

		$text = htmlentities(strip_tags($_POST['text']));

		$stmt = $mysqli->prepare("INSERT INTO knowledge_base_tree_hierarchy (elem_id, parent, text, icon, type, root_folder, submenu_request_file) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param('ssssssi', $elem_id, $_POST['parent'], $text, $_POST['icon'], $_POST['type'], $_POST['root_folder'], $_POST['submenu_request_file']);
		$stmt->execute();
		$stmt->close();

		$mysqli->close();

		$allParents = json_decode($_POST['allParents'], true);

		$filepath = '../mainTabs/' . str_replace('Root', '', $_POST['root_folder']) . '/' . constructFolderFilepath($allParents);

		if(!$_POST['submenu_request_file']) {
			if(!file_exists($filepath))
		    	mkdir($filepath, 0777, true);
		} else {
			if(!file_exists($filepath . '.php')) {
				mkdir($filepath, 0777, true);
				$fileData = $_POST["fileData"];
				$fileData = str_replace("&lt;", "<", $fileData);
				$fileData = str_replace("&gt;", ">", $fileData);
				$fileData = str_replace("&quot;", "\"", $fileData);
				$fileData = str_replace("quotation;", "\\\"", $fileData);
				$fileData = str_replace("quotationreg;", "\"", $fileData);
				$fileData = str_replace("apos;", "\\\'", $fileData);
				$fileData = str_replace("aposreg;", "'", $fileData);
				$fileData = str_replace("bsol;", "\\\\", $fileData);
				$fileData = str_replace("&sol;", "/", $fileData);
				$fileData = str_replace("ampersand;", "&", $fileData);
				$fileData = str_replace("&amp;", "$", $fileData);

				$file = fopen($filepath . substr($filepath, strripos($filepath, '/')) . '.php', 'w+');
				fwrite($file, $fileData);
				fclose($file);
			}
		}
	}

	function constructFolderFilepath($parents) {
		global $elem_id;
		$newFilepath = '';

		for($index = sizeof($parents) - 3; $index >= 0; $index--)
			$newFilepath .= $parents[$index] . '/';

		return $newFilepath . $elem_id;
	}

?>