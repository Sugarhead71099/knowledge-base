<?php
	
	include_once('../../../config.inc.php');
	include_once('../kbFunctions.php');

	if(isset($_POST['searchString'])) {

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$searchString = htmlentities(strip_tags($_POST['searchString']));
		$searchWords = getWords($searchString);

		$stmtQuery = "SELECT * FROM kb_protocols WHERE LOWER(name) LIKE ?";
		for($i = 1; $i < sizeof($searchWords); $i++) {
			$stmtQuery .= " OR LOWER(name) LIKE ?";
		}
		$stmtQuery .= " ORDER BY name";

		$types = '';
		foreach($searchWords as $key => $word) {
			$searchWords[$key] = "%" . strtolower($word) . "%";
			$types .= 's';
		}

		array_unshift($searchWords, $types);
		
		$stmt = $mysqli->prepare($stmtQuery);
		// call_user_func_array(array($stmt, 'bind_param'), $searchWords);
		$ref = new ReflectionClass('mysqli_stmt');
		$method = $ref->getMethod("bind_param");
		$method->invokeArgs($stmt, $searchWords);
		$stmt->execute();
		$protocolMatches = $stmt->get_result();
		$stmt->close();

		while($protocols = $protocolMatches->fetch_assoc()) {
			$result = $mysqli->query("SELECT belongs_to, reference_name FROM kb_submenus WHERE id = {$protocols['belongs_to']} LIMIT 1;");
			$parentMenuInfo = $result->fetch_assoc();
			$parentMenu = $parentMenuInfo['reference_name'];
			$parentMenuBelongsTo = "%_" . $parentMenuInfo['belongs_to'];
			$result->close();

			$result = $mysqli->query("SELECT elem_id FROM knowledge_base_tree_hierarchy WHERE elem_id LIKE '{$parentMenuBelongsTo}' LIMIT 1;");
			$parentLinkInfo = $result->fetch_assoc();
			$parentLink = $parentLinkInfo['elem_id'];
			$result->close();

?>

			<a class="col-lg-4 col-md-6 col-sm-12 col-xs-12 protocol" href="<?php echo DOC_ROOT; ?>modules/kb/?parentLink=<?php echo $parentLink; ?>&parentMenu=<?php echo $parentMenu; ?>&fileName=<?php echo $protocols['reference_name']; ?>.php&sopLink=true&rand=<?php echo rand(); ?>"><?php echo $protocols['name']; ?></a>

<?php

		}

		$mysqli->close();

	}
	
?>