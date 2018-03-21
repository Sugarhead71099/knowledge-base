<?php

	// ini_set('display_errors', 1);

	include_once('includes/kbDatabases.php');
	require_once('../../config.inc.php');

	if(!session_id())
		session_start();

	ob_start();

	// $_SESSION['isSuperAdmin'] = PrivilegedUser::getByUsername($_SESSION['username'])->hasRole('Super Admin');

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A Full Fledged Knowledge Base.">
		<meta name="author" content="Coderthemes">

		<title>Knowledge Base</title>

		<link href="<?php echo DOC_ROOT; ?>assets/plugins/jstree/style.css" rel="stylesheet" type="text/css">

		<link href="<?php echo DOC_ROOT; ?>assets/plugins/bootstrapvalidator/src/css/bootstrapValidator.css" rel="stylesheet" type="text/css" />

		<link href="<?php echo DOC_ROOT; ?>assets/plugins/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">

		<link href="<?php echo DOC_ROOT; ?>assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css" rel="stylesheet" type="text/css" />

		<link href="<?php echo DOC_ROOT; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo DOC_ROOT; ?>assets/css/core.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo DOC_ROOT; ?>assets/css/components.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo DOC_ROOT; ?>assets/css/icons.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo DOC_ROOT; ?>assets/css/pages.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo DOC_ROOT; ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />

		<link href="<?php echo DOC_ROOT; ?>assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />

		<link href="<?php echo DOC_ROOT; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

	    <link href="https://fonts.googleapis.com/css?family=Candal" rel="stylesheet">

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo DOC_ROOT; ?>assets/js/modernizr.min.js"></script>
		

		<link href="<?php echo DOC_ROOT; ?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

		<script src="<?php echo DOC_ROOT; ?>assets/js/jquery.min.js"></script>
		
		<!-- JSTree -->
        <script src="<?php echo DOC_ROOT; ?>assets/plugins/jstree/jstree.min.js"></script>

		<script src="https://use.fontawesome.com/c42ad8a8d4.js"></script>

	    <link href="https://fonts.googleapis.com/css?family=Candal" rel="stylesheet" />

	    <link href="<?php echo DOC_ROOT; ?>assets/css/custom/customBootstrap4.0.0.css" rel="stylesheet" type="text/css" />

	    <link href="<?php echo DOC_ROOT; ?>assets/css/custom/kb.css" rel="stylesheet" type="text/css" />
	</head>
	<body>