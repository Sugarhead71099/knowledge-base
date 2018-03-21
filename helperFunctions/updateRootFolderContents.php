<?php

	include_once("../../../config.inc.php");
	
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(mysqli_connect_errno()) {
		printf("Connection failed: %s\n", mysqli_connect_error());
		exit();
	}

	$folders = mysqli_query($con, "SELECT * FROM knowledge_base_tree_hierarchy WHERE root_folder = '" . $_POST['root_folder'] . "';");

	$updatedRootFolders = array();

	if(mysqli_num_rows($folders) > 0)
		while($folder = mysqli_fetch_assoc($folders))
			$updatedRootFolders[] = (object) array("id" => $folder["elem_id"], "parent" => $folder["parent"], "text" => $folder["text"], "icon" => $folder["icon"], "state" => (object) array("opened" => $folder["opened"], "disabled" => $folder["disabled"], "selected" => $folder["selected"] ), "li_attr" => (object) array(), "a_attr" => (object) array() );

	mysqli_close($con);

	echo json_encode($updatedRootFolders);

?>