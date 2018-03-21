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

		$stmtQuery = "SELECT * FROM kb_submenus WHERE LOWER(name) LIKE ?";
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
		$submenuMatches = $stmt->get_result();
		$stmt->close();

		while($submenus = $submenuMatches->fetch_assoc()) {
			$belongs_to = "%_" . $submenus['belongs_to'];
			$result = $mysqli->query("SELECT elem_id FROM knowledge_base_tree_hierarchy WHERE elem_id LIKE '{$belongs_to}' LIMIT 1;");
			$parentLinkInfo = $result->fetch_assoc();
			$parentLink = $parentLinkInfo['elem_id'];
			$result->close();

?>

			<div class="panel panel-default">
		        <div class="panel-heading">
		            <h4 class="panel-title">
		                <a data-toggle="collapse" data-parent="#submenuSearchResults" href="#<?php echo $submenus['reference_name']; ?>" aria-expanded="false" class="collapsed"><?php echo $submenus['name']; ?></a>
		            </h4>
		        </div>
		        <div id="<?php echo $submenus['reference_name']; ?>" class="panel-collapse collapse">
		            <div class="panel-body text-center">
						<?php
							$stmt = $mysqli->prepare("SELECT * FROM kb_protocols WHERE belongs_to = ? ORDER BY name");
							$stmt->bind_param('i', $submenus['id']);
							$stmt->execute();
							$subMenuItems = $stmt->get_result();
							$stmt->close();
							if($subMenuItems->num_rows) {
								while($subRow = $subMenuItems->fetch_assoc()) {
						?>

									<a class="col-lg-4 col-md-6 col-sm-12 col-xs-12 protocol" href="<?php echo DOC_ROOT; ?>modules/kb/?parentLink=<?php echo $parentLink; ?>&parentMenu=<?php echo $submenus['reference_name']; ?>&fileName=<?php echo $subRow['reference_name']; ?>.php&sopLink=true&rand=<?php echo rand(); ?>"><?php echo $subRow['name']; ?></a>

						<?php
								}
							}
						?>
		            </div>
		        </div>
		    </div>

<?php

		}

		$mysqli->close();

	}
	
?>