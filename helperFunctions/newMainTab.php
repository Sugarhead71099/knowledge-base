<?php

	include_once('../../../config.inc.php');
	include_once('../kbFunctions.php');

	if(isset($_POST['data']) && isset($_POST['tabName'])) {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$name = htmlentities(strip_tags(addSpacingNormal($_POST['tabName'])));

		$result = $mysqli->query("SELECT MAX(view_order) AS max_view_order FROM kb_tabs;");
		$vo = $result->fetch_assoc();

		$view_order = $vo['max_view_order'] + 1;

		$result->close();

		// $result = $mysqli->query("SELECT MAX(id) AS max_id FROM kb_tabs;");
		// $id = $result->fetch_assoc();

		// $badLinkNameChars = array("#", "%", "\\", "?", "/");
		// $link_name = mysqli_real_escape_string($con, trim(str_replace($badLinkNameChars, '', $_POST['tabName'])));

		$reference_name = preg_replace('/\s+/', '', str_replace($badChars, '', lcfirst(ucwords(trim($_POST['tabName']))))); // . '_' . ($id['max_id'] + 1);

		// $result->close();

		$stmt = $mysqli->prepare("INSERT INTO kb_tabs (name, view_order, reference_name) VALUES (?, ?, ?)");
		$stmt->bind_param('sis', $name, $view_order, $reference_name);
		$stmt->execute();
		$stmt->close();

		$filePath = '../mainTabs/' . $reference_name;
		if(!file_exists($filePath))
		    mkdir($filePath, 0777, true);

		if(!file_exists($filePath . '/' . $reference_name . '.php')) {
			$fileData = $_POST["data"];
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

			$file = fopen($filePath . '/' . $reference_name . '.php', 'w+');
			fwrite($file, $fileData);
			fclose($file);
		}

		$mysqli->close();

	}

?>