<?php

    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    header('X-XSS-Protection: 0');

    require_once('../../config.inc.php');

    if(!session_id())
        session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A Fully Featured Editable Interface For Knowledge Base Protocols.">
        <meta name="author" content="Coderthemes">

        <title>Bilozz - Medical Billing Management System</title>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">

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
        
        <script src="https://use.fontawesome.com/c42ad8a8d4.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Candal" rel="stylesheet" />

        <link href="<?php echo DOC_ROOT; ?>assets/css/custom/customBootstrap4.0.0.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo DOC_ROOT; ?>assets/css/custom/kb.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo DOC_ROOT; ?>assets/css/custom/eui.css" rel="stylesheet" type="text/css" />
    </head>
    <body>