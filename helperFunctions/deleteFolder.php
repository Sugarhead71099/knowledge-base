<?php
	
	include_once('../../../config.inc.php');
	
	if(isset($_POST['elem_id']) && strpos($_POST['elem_id'], 'Root') === false && isset($_POST['link_node'])) {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno) {
			printf('Connection failed: %s\n', $mysqli->connect_error);
			exit();
		}

		$stmt = $mysqli->prepare("DELETE FROM knowledge_base_tree_hierarchy WHERE elem_id = ? LIMIT 1");
		$stmt->bind_param('s', $_POST['elem_id']);
		$stmt->execute();
		$stmt->close();

		$children = array();

		function findAllChildren($elem_id, &$children) {
			global $mysqli;

			$stmt = $mysqli->prepare("SELECT elem_id, submenu_request_file FROM knowledge_base_tree_hierarchy WHERE parent = ?");
			$stmt->bind_param('s', $elem_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();

			if($result->num_rows) {
				while($childNode = $result->fetch_assoc()) {
					$children[] = (object) array("elem_id" => $childNode['elem_id'], "linkNode" => $childNode['submenu_request_file']);
					findAllChildren($childNode['elem_id'], $children);
				}
			} else {
				$children[] = (object) array("elem_id" => $mysqli->real_escape_string($_POST['elem_id']), "linkNode" => $_POST['link_node']);
				echo sizeof($children);
				deleteAllChildren($children);
			}
		}

		function deleteAllChildren($arr) {
			global $mysqli;

			foreach($arr as $value) {
				if($value->linkNode) {
					$submenus = (int) substr($value->elem_id, strrpos($value->elem_id, "_") + 1);
					echo "elem_id:\t" . $value->elem_id . "\n";
					$stmt = $mysqli->prepare("SELECT id FROM kb_submenus WHERE belongs_to = ?");
					$stmt->bind_param('i', $submenus);
					$stmt->execute();
					$result = $stmt->get_result();
					$stmt->close();

					if($result->num_rows) {
						$stmt = $mysqli->prepare("DELETE FROM kb_submenus WHERE belongs_to = ?");
						$stmt->bind_param('i', $submenus);
						$stmt->execute();
						$stmt->close();

						while($protocols = $result->fetch_assoc()) {
							$mysqli->query("DELETE FROM kb_protocols WHERE belongs_to = {$protocols['id']};");
						}
					}
				}
				$mysqli->query("DELETE FROM knowledge_base_tree_hierarchy WHERE elem_id = '{$value->elem_id}' LIMIT 1;");
			}
		}

		findAllChildren($_POST['elem_id']);

		$mysqli->close();
	}

?>