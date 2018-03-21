<?php

	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);
	require_once('../../config.inc.php');

	/***** Construct Tables *****/


	// Knowledge Base Core Database Structure
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if($mysqli->connect_errno)
	// 	die('Database mysqli Could Not Be Established: ' . PHP_EOL . '\t' . $mysqli->connect_error);
		die('');

	$createKnowledgeBaseTabs = "CREATE TABLE IF NOT EXISTS kb_tabs (
								id INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
								name VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
								view_order INT(9) NOT NULL DEFAULT 0,
								reference_name VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
								PRIMARY KEY (id), UNIQUE name_UNIQUE (name), UNIQUE reference_name_UNIQUE (reference_name)
						   ) ENGINE = InnoDB;";

    $mysqli->query($createKnowledgeBaseTabs);


	// Knowledge Base jsTree Database (sub-database)
	$createKnowledgeBaseTreeHierarchy = "CREATE TABLE IF NOT EXISTS knowledge_base_tree_hierarchy (
											id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
											elem_id VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
											parent VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '#',
											text VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
											icon VARCHAR(268) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'fa fa-folder',
											opened TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
											disabled TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
											selected TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
											li_attr VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
											a_attr VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
											type VARCHAR(268) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'default',
											root_folder VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
											submenu_request_file TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
											PRIMARY KEY (id), UNIQUE elem_id_UNIQUE (elem_id)
										) ENGINE = InnoDB;";

    $mysqli->query($createKnowledgeBaseTreeHierarchy);


	$createKnowledgeBaseSubmenus = "CREATE TABLE IF NOT EXISTS kb_submenus (
								id INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
								name VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
								view_order INT(9) NOT NULL DEFAULT 0,
								belongs_to INT(10) UNSIGNED NULL DEFAULT NULL,
								reference_name VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
								PRIMARY KEY (id)
						   ) ENGINE = InnoDB;";

    $mysqli->query($createKnowledgeBaseSubmenus);


	$createKnowledgeBaseProtocols = "CREATE TABLE IF NOT EXISTS kb_protocols (
								id INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
								name VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
								view_order INT(9) NOT NULL DEFAULT 0,
								belongs_to INT(9) UNSIGNED NULL DEFAULT NULL,
								reference_name VARCHAR(535) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
								PRIMARY KEY (id)
						   ) ENGINE = InnoDB;";

    $mysqli->query($createKnowledgeBaseProtocols);


	/***** Necessary Init Queries *****/

	// // Place A 'Home' Object into 'knowledge_base'
	// $initKnowledgeBase = "INSERT INTO knowledge_base (name, view_order, is_main_tab, link_name, reference_name) VALUES ('Home', 1, 1, 'home', 'home');";
	// if(!$mysqli->query($initKnowledgeBase))
	// 	echo 'Knowledge Base initialization has failed: ' . PHP_EOL . '\t' . $mysqli->error . PHP_EOL;

	// // Place A 'homeRoot' Object into 'knowledge_base_tree_hierarchy'
	// $initKnowledgeBaseTreeHierarchy = "INSERT INTO knowledge_base_tree_hierarchy (elem_id, text, opened, disabled, type, root_folder) VALUES ('homeRoot', 'home', 1, 1, '#', 'homeRoot');";
	// if(!$mysqli->query($initKnowledgeBaseTreeHierarchy))
	// 	echo 'Knowledge Base Tree Hierarchy initialization has failed ' . PHP_EOL . '\t' . $mysqli->error . PHP_EOL;

?>