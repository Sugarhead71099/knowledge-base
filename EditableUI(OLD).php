<?php
include_once("../../config.inc.php");
require(DOC_PATH.'modules/templates/class.left_side_bar.php');
require(DOC_PATH.'include/classes/bilozz/class.dropdown.php');
session_start();
$port =  $_SERVER['SERVER_PORT']; if($port == 80 || $port == 443) {} else { echo '<div style="font-size: 120%; margin: 1em; padding: 1em; border: 1pt solid #FF0000; background-color: #fff0f0;">You do not have sufficient permissions to access this page. Click <a href="https://secure.bilozz.com:8080/bilozz/" >here</a> to go back to the login page.</div>'; exit(); } 

if (!isset($_SESSION) || !isset($_SESSION['password']) || !isset($_SESSION['username']))
{
    header("location: ".DOC_ROOT."index.html");
}

$drop = new dropdown();
$menu = new left_side_bar();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo DOC_ROOT; ?>assets/images/favicon_1.ico">

        <title>Bilozz - Medical Billing Management System</title>

        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">

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
        <link href="<?php echo DOC_ROOT; ?>assets/css/custom/kb.css" rel="stylesheet" type="text/css" />
        <style>
            .note-toolbar {
                background-color: rgba(95, 190, 170, 0.35) !important;
            }

            .alncenter{
                text-align: center;
            }
            .role_toolbar {
                float: left;
            }
            .fa-trash-o {
                color: #F05050;
            }
            .glyphicon-remove {
                color: #F05050;
            }
            .glyphicon-edit {
                color: #7266ba;
            }
            .glyphicon-download-alt {
                color: #4c5667;
            }
            .table-hover tr.even.row_selected td {
                background-color: #ffff99;
            }
            .table-hover tr.odd.row_selected td {
                background-color: #ffff99;
            }
        </style>

        <script src="https://use.fontawesome.com/c42ad8a8d4.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Candal" rel="stylesheet" />
        <link href="<?php echo DOC_ROOT; ?>assets/css/custom/customBootstrap4.0.0.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="fixed-left">

        
        <div id="wrapper" class="<?php echo $_SESSION["layout"]; ?>" style="overflow-y: auto !important;">
        
            <div class="topbar">
                <?php include(DOC_PATH.'modules/templates/logo.php'); ?>
                <?php include(DOC_PATH.'modules/templates/top_bar.php'); ?>
            </div>
            
            <div class="left side-menu">
                <?php echo $menu->build_menu('kb'); ?>
            </div>
            
            
            <div class="content-page" style="overflow-y: auto !important;">
                <div class="content" style="width: 100%; height: 100%; margin: 0 auto;">
                    <div class="container" style="width: 100%; height: 100%; margin: 0 auto;">

                        <div class="row" style="border: none; width: 100%; height: 82vh; margin: 0 auto; margin-top: 4%;">
                            <?php include('CreationToolsNavbar.html'); ?>
                            <div class="col-sm-12" style="border: none; width: 100%; margin: 0 auto;">
                                <div class="card-box" style="border: none; width: 100%; margin: 0 auto;">
                                    <div class="tabl-rep plugin" style="border: none; width: 100%; margin: 0 auto;">
                                        <div class="table-wrapper" style="border: none; width: 100%; margin: 0 auto;">
                                            <div id="content-body">





                                                <!--Container For This Block of HTML-->
                                                <div class="container0 text-center" id="pageContainer">
                                                    <div id="editContent">

                                                        <?php echo isset($_POST["protocolData"]) ? $_POST["protocolData"] : "<h1>Sorry, there data found for this file</h1>"; ?>

                                                    </div>

                                                    <!-- New Table Form Modal -->
                                                    <div class="modal fade" id="tableForm" tabindex="-1" role="dialog" aria-labelledby="tableFormLabel" aria-hidden="false">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="tableFormLabel">Create A Table</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                            
                                                                    <form id="newTableForm">
                                                                        <div class="form-group">
                                                                            <label for="newTableRows">Rows</label>
                                                                            <input type="text" class="form-control" id="newTableRows" value="3" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="newTableColumns">Columns</label>
                                                                            <input type="text" class="form-control" id="newTableColumns" value="2" disabled>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn0 btn0-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button id="tableSubmit" type="button" class="btn0 btn0-primary" data-dismiss="modal">Create</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- New Image Form Modal -->
                                                    <div class="modal fade" id="imageForm" tabindex="-1" role="dialog" aria-labelledby="imageFormLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="imageFormLabel">Add An Image</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                            
                                                                    <form id="newImageForm">
                                                                        <div class="form-group">
                                                                            <label for="newImageWidth">Width</label>
                                                                            <input type="text" class="form-control" id="newImageWidth" placeholder="Input Width... (Default: 20)">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="newImageHeight">Height</label>
                                                                            <input type="text" class="form-control" id="newImageHeight" placeholder="Input Height... (Recommended: Leave blank for best results)">
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn0 btn0-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button id="imageSubmit" type="button" class="btn0 btn0-primary" data-dismiss="modal">Create</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Preview Modal -->
                                                    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #b0d7f0;">
                                                                    <h5 class="modal-title" id="previewModalLabel">Preview</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" id="previewModalBody">
                                                            
                                                                    

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Text Edit Popover (Card) -->
<!--                                                     <div class="card" id="textEditPopover">
                                                        <div class="card-header row0">
                                                            <h3 class="col-lg-9" style="padding-left: 15.5rem;">Text Edit</h1>
                                                            <span class="pull-right option-icon col-lg-2 text-edit-popover-close"><i class="fa fa-close" aria-hidden="true"></i></span>
                                                        </div>
                                                        <div class="card-block col-lg-12">

                                                            <div class="form-group col-lg-4">
                                                                <h4>Font Family / Font Size</h4>
                                                                <div class="row0" id="fontFamilyContainer">
                                                                    <div class="col-lg-6" id="fontSizeContaier">
                                                                        <div class="input-group">
                                                                            <div class="input-group-btn0">
                                                                                <button type="button" class="btn0 btn0-secondary dropdown-toggle font-family-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    Times New Roman
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <button class="dropdown-item font-family-option">Candal</button>
                                                                                    <button class="dropdown-item font-family-option">Times New Roman</button>
                                                                                    <button class="dropdown-item font-family-option">Calibri</button>
                                                                                    <button class="dropdown-item font-family-option">Arial</button>
                                                                                    <button class="dropdown-item font-family-option">Monospace</button>
                                                                                    <button class="dropdown-item font-family-option">Verdana</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6" id="fontSizeContainer">
                                                                        <div class="input-group">
                                                                            <input type="number" class="form-control font-size-input" min="10" max="60" aria-label="Font size selector (number)">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-lg-2">
                                                                <h4>Text-Color</h4>
                                                                <input type="color" class="text-color form-control">
                                                            </div>

                                                            <div class="form-group col-lg-3">
                                                                <h4>Text-Alignment</h4>
                                                                <div class="row0 col-lg-12" id="textAlignmentContainer">
                                                                    <span class="pull-right option-icon col-lg-2 text-align" data-value="justify" onmousedown="event.preventDefault();" onclick="document.execCommand('justifyFull', false, null); document.execCommand('styleWithCSS', false, true);"><i class="fa fa-align-justify" aria-hidden="true"></i></span>
                                                                    <span class="pull-right option-icon col-lg-2 text-align" data-value="left" onmousedown="event.preventDefault();" onclick="document.execCommand('justifyLeft', false, null); document.execCommand('styleWithCSS', false, true);"><i class="fa fa-align-left" aria-hidden="true"></i></span>
                                                                    <span class="pull-right option-icon col-lg-2 text-align" data-value="center" onmousedown="event.preventDefault();" onclick="document.execCommand('justifyCenter', false, null); document.execCommand('styleWithCSS', false, true);"><i class="fa fa-align-center" aria-hidden="true"></i></span>
                                                                    <span class="pull-right option-icon col-lg-2 text-align" data-vlue="right" onmousedown="event.preventDefault();" onclick="document.execCommand('justifyRight', false, null); document.execCommand('styleWithCSS', false, true);"><i class="fa fa-align-right" aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-lg-3">
                                                                <h4>Text-Style</h4>
                                                                <div class="row0 col-lg-12" id="textStyleContainer">
                                                                    <span class="pull-right option-icon col-lg-2 text-style" data-value="bold" onmousedown="event.preventDefault();" onclick="document.execCommand('bold', false, null);"><i class="fa fa-bold" aria-hidden="true"></i></span>
                                                                    <span class="pull-right option-icon col-lg-2 text-style" data-value="underline" onmousedown="event.preventDefault();" onclick="document.execCommand('underline', false, null);"><i class="fa fa-underline" aria-hidden="true"></i></span>
                                                                    <span class="pull-right option-icon col-lg-2 text-style" data-value="italic" onmousedown="event.preventDefault();" onclick="document.execCommand('italic', false, null);"><i class="fa fa-italic" aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div> -->

                                                    <div class="sweet-overlay" tabindex="-1"></div>
                                                    <div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="display: none; margin-top: -150px;">
                                                        <div class="sa-icon sa-error" style="display: block;">
                                                            <span class="sa-x-mark">
                                                                <span class="sa-line sa-left"></span>
                                                                <span class="sa-line sa-right"></span>
                                                            </span>
                                                        </div>
                                                        <div class="sa-icon sa-warning" style="display: none;">
                                                            <span class="sa-body"></span>
                                                            <span class="sa-dot"></span>
                                                        </div>
                                                        <div class="sa-icon sa-info" style="display: none;"></div>
                                                        <div class="sa-icon sa-success" style="display: none;">
                                                            <span class="sa-line sa-tip"></span>
                                                            <span class="sa-line sa-long"></span>

                                                            <div class="sa-placeholder"></div>
                                                            <div class="sa-fix"></div>
                                                        </div>
                                                        <div class="sa-icon sa-custom" style="display: none; background-image: url(&quot;<?php echo DOC_ROOT; ?>assets/plugins/sweetalert/thumbs-up.jpg&quot;); width: 80px; height: 80px;"></div>
                                                        <h2 class="sweet-alert-content"></h2>
                                                        <p style="display: block;"></p>
                                                        <fieldset>
                                                            <input type="text" tabindex="3" placeholder="">
                                                            <div class="sa-input-error"></div>
                                                        </fieldset>
                                                        <div class="sa-error-container">
                                                            <div class="icon">!</div>
                                                            <p>Not valid!</p>
                                                        </div>
                                                        <div class="sa-button-container">
                                                            <button class="cancel" tabindex="2" style="display: none; box-shadow: none;">Cancel</button>
                                                            <div class="sa-confirm-button-container">
                                                                <button id="sweetAlertOk" class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(140, 212, 245); box-shadow: rgba(140, 212, 245, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">OK</button>
                                                            <div class="la-ball-fall">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                <div>





                                            </div>
                                            <div id="end-of-content-body"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <footer class="footer">
                <?php include(DOC_PATH.'/modules/templates/footer.php'); ?>
                <button class="btn btn-info" id="sa-warning" onmousedown="event.preventDefault();" style="display: none !important;">Click me</button>
                <button class="pull-right btn btn-default btn-sm waves-effect waves-light" id="submitChanges">Submit Changes</button>
            </footer>
        </div>

        <script>
            var resizefunc = [];
        </script>


        <!-- jQuery  -->
        <script src="<?php echo DOC_ROOT; ?>assets/js/jquery.min.js"></script>
        <script src"<?php echo DOC_ROOT; ?>assets/js/jquery.mobile-1.4.5.min.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/detect.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/fastclick.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/waves.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/wow.min.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/jquery.scrollTo.min.js"></script>

        <script src="<?php echo DOC_ROOT; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>

        <script src="<?php echo DOC_ROOT; ?>assets/plugins/parsleyjs/dist/parsley.min.js" type="text/javascript"></script>
        
        <script src="<?php echo DOC_ROOT; ?>assets/plugins/sweetalert/dist/sweetalert.min.js"></script>

        <script src="<?php echo DOC_ROOT; ?>assets/plugins/notifyjs/dist/notify.min.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/plugins/notifications/notify-metro.js"></script>     

        <script src="<?php echo DOC_ROOT; ?>assets/js/custom/jquery.chained.min.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/jquery.core.js"></script>
        
        <script src="<?php echo DOC_ROOT; ?>assets/plugins/dropzone/dist/dropzone.js"></script>

        
        <script src="<?php echo DOC_ROOT; ?>assets/js/bilozz_<?php echo JSVERSION; ?>.js"></script>


        <!-- Sweet Alert -->
        <script src="<?php echo DOC_ROOT; ?>assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/pages/jquery.sweet-alert.init.js"></script>

        <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/custom/kb-bootstrap.min.js"></script>

        <!-- Summernote EditUI -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.js"></script>

        <?php include_once("kbFunctions.php"); ?>

        <script>
            const accordionParent = `<?php echo $_POST['referenceName']; ?>`;
            // const parentTab = `<?php echo $_POST['parentTab']; ?>`;
            // const parentMenu = `<?php echo $_POST['parentMenu']; ?>`;
            const protocolName = `<?php echo $_POST['protocolName']; ?>`;
            // console.log("mainTabs/" + parentTab + "/" + parentMenu + "/" + protocolName + ".php");
            $("#submitChanges").click(function() {
                $(".exit-edit-mode").click();
                const tableColumns = $("#editContent").find(".table-value");
                for(var index = 0; index < tableColumns.length; index++)
                    if(hasClass(tableColumns[index], "col-lg-3"))
                        $(tableColumns[index]).removeClass("col-lg-3").addClass("col-lg-4");
                    else
                        $(tableColumns[index]).removeClass("col-lg-7").addClass("col-lg-8");

                $("#editContent").find(".in").removeClass("in");
                $("#editContent").find(".header").attr("contenteditable", "false");
                $("#editContent").find(".options-container0").remove();

                $.ajax({
                    type: "POST",
                    url: "helperFunctions/saveProtocolChanges.php",
                    data: {newData: $("#editContent").html(), protocolName: protocolName},
                    datatype: "text",
                    success: function(data) {
                        console.log(data);
                        window.location.href = "kb.php";
                    }
                });
            });

            // Given the element and class to compare against - return true if class applied to element - otherwise returns false
            function hasClass(element, cls) {
                return (" " + element.className + " ").indexOf(" " + cls + " ") > -1;
            }
        </script>



        <script>
            $(document).ready(function() {
                let sections = [...document.querySelectorAll("div .section")];     // An array of all the sections as a whole
                let sectionBodies = [...document.querySelectorAll("div .collapse[role='tabpanel']")];       // An array of all the sectionBodies / panels attributed with the accordion / collapsible menu

                let imageArray = [];    // Array full of images that are added to the template (this document)

                // let sectionClassCorrectionInterval;

                // Enable navbar and options functionality - Enable Editable User Interface (This function runs by default / on it's own)
                (function enableFunctionality() {                    
                    $("#createTable").popover({
                        container: "body",
                        title: "Table",
                        toggle: "popover",
                        placement: "bottom",
                        trigger: "hover"
                    });

                    $("#tableRow").click(addTableRow);      // Adds a row0 to the bottom of the last row0 of active sections
                    $(".header[href='#collapse1']").focus();

                    // Give the submit button of the tableCreationForm functionality (create table on submit)
                    $("#tableSubmit").click(createTable);

                    $("#addImage").click(addImageBlock);

                    $("#newSection").click(addNewSection);

                    $("#addTextbox").click(addTextbox);

                    $("#addHyperlink").click(addHyperlink);

                    $("#importantMessage, #noteMessage").click(addMessage);

                    $("#numericList, #alphabeticList, #bulletList").click(addList);

                    $(".nav-item").click(function() {
                        $("[contenteditable]").unbind("click").click(function() {
                            $(this).focus();
                        });
                    }); 

                    // $("#textEditPopover").hide();

                    $("#previewButton").click(function() {
                        let documentHTML = $(document.documentElement).html();

                        const documentBodyStartHTML = $(document.documentElement).html().indexOf('<div class="container0 text-center" id="pageContainer">');
                        const docuemntBodyEndHTML = $(document.documentElement).html().indexOf('<div id="end-of-content-body"></div>');
                        const documentBodyHTML = $.parseHTML(documentHTML.substring(documentBodyStartHTML, docuemntBodyEndHTML));

                        const allTableColumns = $(documentBodyHTML).find(".table-value");
                        for(var index = 0; index < allTableColumns.length; index++)
                            if(hasClass(allTableColumns[index], "col-lg-3"))
                                $(allTableColumns[index]).removeClass("col-lg-3").addClass("col-lg-4");
                            else
                                $(allTableColumns[index]).removeClass("col-lg-7").addClass("col-lg-8");

                        $(documentBodyHTML).find("#creationTools").remove();
                        $(documentBodyHTML).find(".clearfix").remove();
                        $(documentBodyHTML).find("#previewButton").remove();
                        $(documentBodyHTML).find(".options-container0").remove();

                        $("#previewModalBody").append(documentBodyHTML);
                        $("#previewModal").modal("show").disableSelection();

                        $(".sweet-overlay").css("display", "block");
                        // $(".sweet-overlay").css("z-index", "999");
                        
                        $("#previewModal").css("z-index", "50000");
                        $("#previewModalBody").find(".sweet-overlay").remove();
                        $("#previewModalBody").find(".image-container").addClass("special-element");
                        $("#previewModalBody").find(".table").addClass("special-table-element");
                        $("#previewModalBody").find(".collapse[role='tabpanel']").addClass("show");

                        const sectionBods = [...document.getElementById("previewModalBody").querySelectorAll(".collapse[role='tabpanel']")];
                        sectionBods.forEach(sectionBod => {
                            sectionBod.removeAttribute("style");
                        });

                        $("#previewModal").on("hidden.bs.modal", function() {
                            $("#previewModalBody").empty();
                            $(".sweet-overlay").css("display", "none");
                            $(".sweet-overlay").css("z-index", "");
                        });
                    });

                    $(".header").attr("contenteditable", "true");

                    $(".panel-heading").append(`<div class="options-container0 col-lg-3 pull-right">
                                                    <span class="pull-right option-icon col-lg-1 section-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                                    <span class="pull-right option-icon col-lg-1 section-up"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
                                                    <span class="pull-right option-icon col-lg-1 section-down"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                                                </div>`);

                    $("#accordion" + accordionParent).sortable({
                        revert: true
                    });

                    // Make everything functional from the beginning
                    updateEverything();
                })();



                // Adds a new sections to the accordion (is appended after the last sections)
                function addNewSection() {
                    const newSectionIDNumber = sectionBodies.length + 1;      // Get last sections-body id numebr and add 1 to it for newSectionIDNumber

                    $(`<div class="card panel panel-default section">
                             <div class="card-header panel-heading" role="tab">
                                 <h5 class="mb-0 panel-title">
                                     <a contenteditable data-toggle="collapse" data-parent="#accordion${accordionParent}" href="#collapse${accordionParent}${newSectionIDNumber}" aria-expanded="false" aria-controls="collapse${accordionParent}${newSectionIDNumber}" class="collapsed header text-center"></a>
                                 </h5>
                                <div class="options-container0 col-lg-3 pull-right">
                                    <span class="pull-right option-icon col-lg-1 section-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                    <span class="pull-right option-icon col-lg-1 section-up"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
                                    <span class="pull-right option-icon col-lg-1 section-down"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                                </div>
                             </div>
                             <div id="collapse${accordionParent}${newSectionIDNumber}" class="collapse panel-collapse" role="tabpanel" aria-labelledby="heading${accordionParent}${newSectionIDNumber}" aria-expanded="false" style>
                                 <div class=" card-block panel-body text-center">
                                    <div class="summernote"></div>
                                 </div>
                             </div>
                        </div>`).appendTo($("#accordion" + accordionParent));

                    $(`.header[href="#collapse${accordionParent}${newSectionIDNumber}"]`).focus();

                    // Add this to the 'all-sections-array'
                    sections.push($(`#collapse${accordionParent}${newSectionIDNumber}`).parent().parent().parent());

                    sectionBodies.push(document.getElementById(`collapse${accordionParent}${newSectionIDNumber}`));               // Add this body to the 'all-sections-bodies-array'

                    updateSections();           // Unbinds focus listener on previous elements and applies new focus listener to all elements with class of "new-sections" - Does the same for options' click listeners
                    updateSummernote();
                }

                // Adds textbox to the end of the active / open sections
                function addTextbox() {
                    const activeSection = getActiveSection();
                    if(activeSection === undefined)
                        displayErrorMessage("PLEASE OPEN A SECTION", "newTextboxError-noActiveSection");
                    else {
                        // const activeSectionChildren = $(activeSection).children();

                        //     $(`<div class="row0 text-center textbox-container0" style="margin-top: 1.5rem !important;">
                        //             <div contenteditable class="textarea-container0 col-lg-11 text-justify">
                        //                 <!-- <textarea class="textbox-textarea text-justify col-lg-12" style="height: 10rem;"></textarea> -->
                        //             </div>
                        //             <div class="options-container0">
                        //                 <span class="option-icon text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                        //                 <span class="option-icon element-delete" style="margin-left: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></span>
                        //             </div>
                        //        </div>`).appendTo( (activeSectionChildren.length > 0 && !(hasClass(activeSectionChildren[activeSectionChildren.length - 1], "table"))) ? activeSectionChildren[activeSectionChildren.length - 1] : activeSection );

                        // updateTextbox();        // Updates the textboxes with the class of .textbox-textarea and textbox options with the class of .textbox-delete
                        // updateTextEditPopover();
                        $(activeSection).find(".card-block").append(`<div class="summernote"></div>`);
                        updateSummernote();
                    }
                }

                // Adds the chosen image from the input from the DOM (Function needs modifying for efficiency - imageArray is main problem)
                function addImage(input) {
                    if(input.files && input.files[0]) {
                        const reader = new FileReader();
                        const lastImage = imageArray.length - 1;
                        const lastImageID = `#image${lastImage}`;
                        //const gridWidth = windowWidth;
              
                        // Modify the newly created image element to be draggable and add the chosen image source (actual image to be displayed)
                        reader.onload = function(event) {
                            $(lastImageID).attr("src", event.target.result);//.draggable({ containment: "parent", axis: "x", cursor: "move" });
                        }

                        imageArray.push(document.getElementById(lastImageID));      // Places image into 'all-images-array' for reference later

                        reader.readAsDataURL(input.files[0]);

                        updateImageOptions();       // Sets an "onchange listener" to all elements(inputs) with the "uploadImage" class
                        // updateTextEditPopover();
                    }
                }

                // Creates a table with a given amount of columns and rows from user in active / open sections
                function createTable() {
                    const activeSection = getActiveSection();
                    if(activeSection === undefined)
                        displayErrorMessage("PLEASE OPEN A SECTION", "newTableError-noActiveSection");
                    else {
                        $(`<div class="table" style="margin-top: 1.5rem !important;">
                            <div class="row0 row0-text">
                                <div contenteditable class="col-lg-3 text-center table-value">
                                    <!-- <textarea class="col-lg-12 text-center table-textbox"></textarea> -->
                                </div>
                                <div contenteditable class="col-lg-7 text-center table-value">
                                    <!-- <textarea class="col-lg-12 text-center table-textbox"></textarea> -->
                                </div>
                                <div class="options-container0 col-lg-2 table-options">
                                    <span class="option-icon row0-add"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    <span class="option-icon row0-down"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                                    <span class="option-icon row0-up"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
                                    <span class="option-icon text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    <span class="option-icon row0-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="row0 row0-text">
                                <div contenteditable class="col-lg-3 text-center table-value">
                                    <!-- <textarea class="col-lg-12 text-center table-textbox"></textarea> -->
                                </div>
                                <div contenteditable class="col-lg-7 text-center table-value">
                                    <!-- <textarea class="col-lg-12 text-center table-textbox"></textarea> -->
                                </div>
                                <div class="options-container0 col-lg-2 table-options">
                                    <span class="option-icon row0-add"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    <span class="option-icon row0-down"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                                    <span class="option-icon row0-up"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
                                    <span class="option-icon text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    <span class="option-icon row0-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="row0 row0-text">
                                <div contenteditable class="col-lg-3 text-center table-value">
                                    <!-- <textarea class="col-lg-12 text-center table-textbox"></textarea> -->
                                </div>
                                <div contenteditable class="col-lg-7 text-center table-value">
                                    <!-- <textarea class="col-lg-12 text-center table-textbox"></textarea> -->
                                </div>
                                <div class="options-container0 col-lg-2 table-options">
                                    <span class="option-icon row0-add"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    <span class="option-icon row0-down"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                                    <span class="option-icon row0-up"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
                                    <span class="option-icon text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    <span class="option-icon row0-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>`).appendTo(activeSection.firstElementChild);
                        
                        updateTableOptions();       // Unbind the click listener on older rows and bind them back to all - This is used to prevent toggling issues with the listeners (newer vs. older - enabled vs. disabled)
                        // updateTextEditPopover();
                    }
                }

                // // Adds a table row0 to the bottom of last table row0 in active / open sections
                // function addTableRow() {

                //     const openSection = getActiveSection();     // Gets the active sections

                //     // If there is no open sections found then display error message - else - look for new table row0
                //     if(openSection === undefined)
                //         displayErrorMessage("PLEASE OPEN A section", "tableRowError-noActiveSection");
                //     else {
                //         const table = openSection.getElementsByClassName("table")[0];       // Gets the first table found in the active / open sections

                //         // If there is no table found in the sections display an error message - else - add a new table row0 (draggable) to the end of last row0
                //         if(table === undefined)
                //             displayErrorMessage("PLEASE CREATE A TABLE BEFORE ATTEMPTING TO ADD ROWS", "tableRowError-noTableFound");
                //         else {
                //             let tableRows = table.getElementsByClassName("row0-text");
                //             $(`<div class="row0 row0-text">
                //                     <div contenteditable class="col-lg-3 text-center table-value">
                //                         <!-- <textarea class="col-lg-12 text-center table-textbox"></textarea> -->
                //                     </div>
                //                     <div contenteditable class="col-lg-7 text-center table-value">
                //                         <!-- <textarea class="col-lg-12 text-center table-textbox"></textarea> -->
                //                     </div>
                //                     <div class="options-container0 col-lg-2 table-options">
                //                         <span class="option-icon row0-down"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                //                         <span class="option-icon row0-up"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
                //                         <span class="option-icon text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                //                         <span class="option-icon row0-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                //                     </div>
                //                </div>`).insertAfter(tableRows[tableRows.length - 1]);

                //             updateTableOptions();       // Unbind the click listener on older rows and bind them back to all - This is used to prevent toggling issues with the listeners (newer vs. older - enabled vs. disabled)
                //             updateTextbox();        // Updates the textboxes with the class of .textbox-textarea and textbox options with the class of .textbox-delete
                //             updateTextEditPopover();
                //         }
                //     }

                // }

                // Adds a table row0 to the bottom of the row0 that the plus (row0-add) button was clicked
                function addTableRow() {
                    $(`<div class="row0 row0-text">
                            <div contenteditable class="col-lg-3 text-center table-value">
                                <!-- <textarea class="col-lg-12 text-center table-textbox"></textarea> -->
                            </div>
                            <div contenteditable class="col-lg-7 text-center table-value">
                                <!-- <textarea class="col-lg-12 text-center table-textbox"></textarea> -->
                            </div>
                            <div class="options-container0 col-lg-2 table-options">
                                <span class="option-icon row0-add"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                <span class="option-icon row0-down"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                                <span class="option-icon row0-up"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
                                <span class="option-icon text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                <span class="option-icon row0-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                            </div>
                        </div>`).insertAfter($(this).parent().parent());

                    updateTableOptions();
                    // updateTextEditPopover();
                }

                // Creates an image to the end of the active / open sections
                function addImageBlock() {
                    const activeSection = getActiveSection();
                    if(activeSection === undefined)
                        displayErrorMessage("PLEASE OPEN A SECTION", "newImageError-noActiveSection");
                    else {
                        const activeSectionChildren = $(activeSection).first().children();

                            $(`<div class="row0 col-lg-12 text-center image-container" style="border: none; margin-top: 1.5rem !important;">
                                    <div class=" text-center list-image row0 text-center col-lg-10">
                                        <div class="text-center list-image col-lg-12">
                                            <input class="upload-image" type="file" />
                                        </div>
                                    </div>
                                    <div class="options-container0 col-lg-2 image-options">
                                        <!--<span class="option-icon"><i class="fa fa-pencil-square-o image-edit" aria-hidden="true"></i></span>-->
                                        <span class="option-icon image-grow"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        <span class="option-icon image-shrink"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                        <span class="option-icon element-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                    </div>
                               </div>`).appendTo( (activeSectionChildren.length > 0 && !(hasClass(activeSectionChildren[activeSectionChildren.length - 1], "table") && !(hasClass(activeSectionChildrent[activeSectionChildren.length - 1], "ordered-list")) ) ? activeSectionChildren[activeSectionChildren.length - 1] : activeSection.firstElementChild) );
                        
                        updateImageOptions();       // Sets an "onchange listener" to all elements(inputs) with the "uploadImage" class
                        // updateTextEditPopover();
                    }
                }

                // Creates an IMPORTANT or Note message at the end of active sections (Message type will be based on which message button was clicked)
                function addMessage() {
                    const activeSection = getActiveSection();
                    if(activeSection === undefined)
                        displayErrorMessage("PLEASE OPEN A SECTION", "newImportantError-noActiveSection");
                    else {
                        const activeSectionChildren = $(activeSection).first().children();

                        switch($(this).attr("id")) {
                            case "importantMessage":
                                $(`<div class="row0 message-block-container0 col-lg-11" style="margin-top: 1.5rem !important;">
                                        <p class="important-message-container0 col-lg-11 text-center alert alert-danger"><span class="col-lg-2" style="text-decoration: underline; color: red;">IMPORTANT:</span> <span contenteditable class="col-lg-10"><!-- <textarea class="important-text col-lg-6"></textarea> --></span></p>
                                        <div class="options-container0 col-lg-1">
                                            <span class="option-icon text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                            <span class="option-icon col-lg-12 element-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                        </div>
                                   </div>`).appendTo( (activeSectionChildren.length > 0 && !(hasClass(activeSectionChildren[activeSectionChildren.length - 1], "table")) && !(hasClass(activeSectionChildren[activeSectionChildren.length - 1], "important-message-container0")) && !(hasClass(activeSectionChildren[activeSectionChildren.length - 1], "note-message-container0"))) ? activeSection.firstElementChild : activeSectionChildren[activeSectionChildren.length - 1]);
                                break;
                            case "noteMessage":
                                $(`<div class="row0 message-block-container0 col-lg-11" style="margin-top: 1.5rem !important;">
                                        <p class="note-message-container0 col-lg-11 text-center alert alert-warning"><span class="col-lg-2" style="color: #b1b13c; text-decoration: underline;">NOTE:</span> <span contenteditable class="col-lg-10"><!-- <textarea class="note-text col-lg-6"></textarea> --></span></p>
                                        <div class="options-container0 col-lg-1">
                                            <span class="option-icon text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                            <span class="option-icon col-lg-12 element-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                        </div>
                                   </div>`).appendTo( (activeSectionChildren.length > 0 && !(hasClass(activeSectionChildren[activeSectionChildren.length - 1], "table")) && !(hasClass(activeSectionChildren[activeSectionChildren.length - 1], "important-message-container0")) && !(hasClass(activeSectionChildren[activeSectionChildren.length - 1], "note-message-container0"))) ? activeSection.firstElementChild : activeSectionChildren[activeSectionChildren.length - 1]);
                                break;
                            default:
                                console.log("No message button was recognized from the selected 'Message Types' dropdown");
                                break;
                        }
                        
                        updateMessages();       // Updates all messages and message options by setting focus listener on messages with the class of .imporant-text & .note-text - setting click listner on option with class of .message-delete
                        // updateTextEditPopover();
                    }
                }

                // Looks at the type of list that was requested (clicked) and adds it to the end of the active sections
                function addList() {
                    const activeSection = getActiveSection();
                    if(activeSection === undefined)
                        displayErrorMessage("PLEASE OPEN A SECTION", "newListError-noActiveSection");
                    else {
                        switch($(this).attr("id")) {
                            case "numericList":
                                $(`<ol class="ordered-list text-justify col-lg-12" style="margin-top: 1.5rem !important;">
                                        <li class="text-justify col-lg-10">
                                            <div class="row0 text-justify col-lg-12 list-content-container0">
                                                <div contenteditable class="col-lg-9 col-sm-7 text-justify list-value">
                                                    <!-- <textarea class="list-textarea col-lg-12"></textarea> -->
                                                </div>
                                                <div class="options-container0 col-lg-3 col-sm-4 list-options">
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-next"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-image"><i class="fa fa-image" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-unordered-list"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </li>
                                   </ol>`).appendTo(activeSection.firstElementChild);
                                break;
                            case "alphabeticList": // Currently Disabled - Not An option in the CreationToolsNavbar
                                $(`<ol class="ordered-list text-justify col-lg-12" type="A" style="margin-top: 1.5rem !important;">
                                        <li class="col-lg-3 text-justify col-lg-10">
                                            <div class="row0 text-justify col-lg-12 list-content-container0">
                                                <div contenteditable class="col-lg-9 col-sm-7 text-justify list-value">
                                                    <!-- <textarea class="list-textarea col-lg-12"></textarea> -->
                                                </div>
                                                <div class="options-container0 col-lg-3 col-sm-4 list-options">
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-next"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-image"><i class="fa fa-image" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-unordered-list"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </li>                           
                                   </ol>`).appendTo(activeSection.firstElementChild);
                                break;
                            case "bulletList":
                                $(`<ul class="unordered-list text-justify col-lg-12" type="disc" style="margin-top: 1.5rem !important;">
                                        <li class="col-lg-3 text-justify col-lg-10">
                                            <div class="row0 text-justify col-lg-12 col-sm-12 list-content-container0">
                                                <div contenteditable class="col-lg-9 col-sm-7 text-justify list-value">
                                                    <!-- <textarea class="list-textarea col-lg-12"></textarea> -->
                                                </div>
                                                <div class="options-container0 col-lg-3 col-sm-4 list-options">
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-next"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-image"><i class="fa fa-image" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-ordered-list"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                                    <span class="option-icon col-lg-2 col-sm-2 list-item-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </li>
                                   </ul>`).appendTo(activeSection.firstElementChild);
                                break;
                            default:
                                console.log("No type of list was selected from the 'List Types' dropdown");
                                break;
                        }
                    }

                    updateList();       // Updates all list-item and list-item options by setting focus listener on list-textareas and setting dblclick & click listeners to all the children of oredered & unordered lists
                    // updateTextEditPopover();
                }

                // Get all the HTML of sections and switch it with next sections (sections under)
                function sectionDown() {
                    const elementTitle = ".header";
                    const elementBody = "div .card-block";

                    const currentSection = $(this).parent().parent().parent();
                    const currentSectionTitleHTML = $.trim($(currentSection).find(elementTitle).html());
                    const currentSectionBodyHTML = $.trim($(currentSection).find(elementBody).html());

                    const nextSection = $(currentSection).next();
                    const nextSectionTitleHTML = $.trim($(nextSection).find(elementTitle).html());
                    const nextSectionBodyHTML = $.trim($(nextSection).find(elementBody).html());

                    $(nextSection).find(elementTitle).html(currentSectionTitleHTML);
                    $(nextSection).find(elementBody).html(currentSectionBodyHTML);

                    $(currentSection).find(elementTitle).html(nextSectionTitleHTML);
                    $(currentSection).find(elementBody).html(nextSectionBodyHTML);

                    updateEverything();
                }

                // Get all the HTML of the sections and switch it with previous sections (sections down)
                function sectionUp() {
                    const elementTitle = ".header";
                    const elementBody = "div .card-block";

                    const currentSection = $(this).parent().parent().parent();
                    const currentSectionTitleHTML = $.trim($(currentSection).find(elementTitle).html());
                    const currentSectionBodyHTML = $.trim($(currentSection).find(elementBody).html());

                    const previousSection = $(currentSection).prev();
                    const previousSectionTitleHTML = $.trim($(previousSection).find(elementTitle).html());
                    const previousSectionBodyHTML = $.trim($(previousSection).find(elementBody).html());

                    $(previousSection).find(elementTitle).html(currentSectionTitleHTML);
                    $(previousSection).find(elementBody).html(currentSectionBodyHTML);

                    $(currentSection).find(elementTitle).html(previousSectionTitleHTML);
                    $(currentSection).find(elementBody).html(previousSectionBodyHTML);

                    updateEverything();
                }

                // Deletes whole sections
                function sectionDelete() {
                    const section = this.parentElement.parentElement.parentElement;
                    const sectionBody = this.parentElement.parentElement.nextElementSibling;

                    for(var index = 0; index < sectionBodies.length; index++)
                        if(sectionBodies[index].id === sectionBody.id) {
                            sectionBodies.splice(index, 1);
                            sections.splice(index, 1);
                            break;
                        }

                    $(this).parent().parent().parent().remove();
                }

                // Swaps row0 values with the values of the row0 below it
                function tableRowDown() {
                    const currentRowValues = [...this.parentElement.parentElement.querySelectorAll(".table-value")];
                    const nextRowValues = [...this.parentElement.parentElement.nextElementSibling.querySelectorAll(".table-value")];
                    const nextRowValuesText = [];

                    // Place the next row0's values into the nextRowValuesText
                    nextRowValues.forEach(value => {
                        nextRowValuesText.push($.trim($(value).text()));
                    });

                    // Place the current row0's values into the next row0's values
                    for(var index = 0; index < currentRowValues.length; index++)
                        $(nextRowValues[index]).text($.trim($(currentRowValues[index]).text()));

                    // Place the next row0's values into the current row0's values
                    for(var index2 = 0; index2 < nextRowValuesText.length; index2++)
                        $(currentRowValues[index2]).text(nextRowValuesText[index2]);

                    updateTableOptions();
                }

                // Swaps row0 values (textarea.value) with the values of the row0 above it
                function tableRowUp() {
                    const currentRowValues = [...this.parentElement.parentElement.querySelectorAll(".table-value")];
                    const previousRowValues = [...this.parentElement.parentElement.previousElementSibling.querySelectorAll(".table-value")];
                    const previousRowValuesText = [];

                    // Place the next row0's textarea values into the nextRowValuesText
                    previousRowValues.forEach(value => {
                        previousRowValuesText.push($.trim($(value).text()));
                    });

                    // Place the current row0's values into the previous row0's values
                    for(var index = 0; index < currentRowValues.length; index++)
                        $(previousRowValues[index]).text($.trim($(currentRowValues[index]).text()));

                    // Place the previous row0's values into the current row0's values
                    for(var index2 = 0; index2 < previousRowValuesText.length; index2++)
                        $(currentRowValues[index2]).text(previousRowValuesText[index2]);

                    updateTableOptions();
                }

                // Deletes the whole row0 from the table
                function tableRowDelete() {
                    const table = getActiveSection().getElementsByClassName("table")[0];        // Gets the first table found in the active / open sections

                    $(this).parent().parent().remove();     // Remove selected table row0

                    let tableRows = table.getElementsByClassName("row0-text");

                    if(tableRows.length === 0)
                        $(table).remove();
                }

                function addHyperLink() {
                    const activeSection = getActiveSection();
                    if(activeSection === undefined)
                        displayErrorMessage("PLEASE OPEN A SECTION", "newListError-noActiveSection");
                    else {
                        $(`<a href="javascript:void(0)">Blank Link</a>`).appendTo(activeSection);
                    }
                }

                function editHyperLink() {

                }

                // CURRENTLY NOT IN USE - DISABLED IN REPLACEMENT OF "IMAGE GROW" & "IMAGE SHRINK" FUNCTIONS
                 // Allows for user to change the width and/or height of image
                function editImage() {
                    $("#imageForm").modal("show");
                    const editButtonPressed = this;

                    $("#imageSubmit").click(function() {
                        const image = editButtonPressed.parentElement.previousElementSibling.firstElementChild.firstElementChild;       // Image to be edited
                        const width = $("#newImageWidth").val().trim() != "" ? $("#newImageWidth").val().trim() : 20;
                        const height = $("#newImageHeight").val().trim();

                        image.setAttribute("width", `${width}%`);
                        image.setAttribute("height", `${height}%`);
                        $(this).unbind("click");
                    });
                }

                // Increments image width by 10 percent (Relative to the image container0 width)
                function imageGrow() {
                    const image = this.parentElement.previousElementSibling.firstElementChild.firstElementChild;        // Image to be edited
                    newImageWidth = parseInt(image.style.width.substring(0, image.style.width.length - 1)) + 10;

                    image.style.width = `${newImageWidth}%`;
                }

                // Decrements image width by 10 percent (Relative to the image container0 width)
                function imageShrink() {
                    const image = this.parentElement.previousElementSibling.firstElementChild.firstElementChild;        // Image to be edited
                    newImageWidth = parseInt(image.style.width.substring(0, image.style.width.length - 1)) - 10;

                    image.style.width = `${newImageWidth}%`;
                }

                // Deletes whole container0
                function deleteElement() {
                    $(this).parent().parent().remove();
                }

                // Adds a "<li></li>" block that appends an additional list element after the final / existing one (the list element where the plus button was clicked)
                function addNextListItem(element) {
                    // Add new List element (with new options) after the final list element
                    $(`<li class="col-lg-3 text-justify col-lg-10">
                            <div class="row0 text-justify col-lg-12 list-content-container0">
                                <div contenteditable class="col-lg-9 col-sm-7 text-justify list-value">
                                    <!-- <textarea class="list-textarea col-lg-12"></textarea> -->
                                </div>
                                <div class="options-container0 col-lg-3 col-sm-4 list-options">
                                    <span class="option-icon col-lg-2 col-sm-2 list-item-next"><i class="fa fa-plus" aria-hidden"true"></i></span>
                                    <span class="option-icon col-lg-2 col-sm-2 list-item-image"><i class="fa fa-image" aria-hidden="true"></i></span>

                                    ${hasClass(element.parentElement.parentElement.parentElement.parentElement, "ordered-list") ? '<span class="option-icon col-lg-2 col-sm-2 list-item-unordered-list"><i class="fa fa-list-ul" aria-hidden="true"></i></span>' : '<span class="option-icon col-lg-2 col-sm-2 list-item-ordered-list"><i class="fa fa-list-ol" aria-hidden="true"></i></span>'}

                                    <span class="option-icon col-lg-2 col-sm-2 list-item text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    <span class="option-icon col-lg-2 col-sm-2 list-item-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                       </li>`).insertAfter($(element).parent().parent().parent());

                    $(element.parentElement.parentElement.parentElement.nextElementSibling.firstElementChild.firstElementChild).focus();
                    $(element.parentElement.parentElement.parentElement.nextElementSibling.firstElementChild.firstElementChild).unbind("keydown").keydown(function(e) {
                        if(e.which === 13) {
                            e.preventDefault();
                            addNextListItem(this.nextElementSibling.firstElementChild);
                        }
                    });

                    updateList();
                    // updateTextEditPopover();
                }

                function addListImageBlock() {
                    $(`<div class="row0 col-lg-12" style="border: none; margin: 2.5rem auto; margin-bottom: 1.5rem;">
                            <div class="list-image row0 text-center col-lg-10 list-image-container0">
                                <div class="list-image col-lg-12">
                                    <input class="upload-image" type="file" />
                                </div>
                            </div>
                            <div class="options-container0 col-lg-2 image-options">
                                <!--<span class="option-icon"><i class="fa fa-pencil-square-o image-edit" aria-hidden="true"></i></span>-->
                                <span class="option-icon image-grow"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                <span class="option-icon image-shrink"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                <span class="option-icon element-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                            </div>
                       </div>`).insertAfter($(this).parent().parent().parent());

                    updateImageOptions();
                }

                // Adds an unordered list to a currently active list (this list is tabbed over, as it is nested inside a current list)
                function addUnorderedListItem() {
                    $(`<ul class="unordered-list text-justify col-lg-12" type="disc" style="float: left; left: 4rem; margin-bottom: 2.5% !important;">
                            <li class="col-lg-3 text-justify col-lg-10">
                                <div class="row0 text-justify col-lg-12 list-content-container0">
                                    <div contenteditable class="col-lg-9 col-sm-7 text-justify list-value">
                                        <!-- <textarea class="list-textarea col-lg-12"></textarea> -->
                                    </div>
                                    <div class="options-container0 col-lg-3 col-sm-4 list-options">
                                        <span class="option-icon col-lg-2 col-sm-2 list-item-next"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        <span class="option-icon col-lg-2 col-sm-2 list-item-image"><i class="fa fa-image" aria-hidden="true"></i></span>
                                        <span class="option-icon col-lg-2 col-sm-2 list-item-ordered-list"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                                        <span class="option-icon col-lg-2 col-sm-2 list-item text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                        <span class="option-icon col-lg-2 col-sm-2 list-item-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </li>
                       </ul>`).insertAfter($(this).parent().parent().parent());

                    updateList();
                    // updateTextEditPopover();
                }

                function continueOrderedListItem() {
                    // Add new List element (with new options) after the final list element
                    $(`<li class="clear-float col-lg-3 text-justify col-lg-10">
                            <div class="row0 text-justify col-lg-12 list-content-container0">
                                <div contenteditable class="col-lg-9 col-sm-7 text-justify list-value">
                                    <!-- <textarea class="list-textarea col-lg-12"></textarea> -->
                                </div>
                                <div class="options-container0 col-lg-3 col-sm-4 list-options">
                                    <span class="option-icon col-lg-2 col-sm-2 list-item-next"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    <span class="option-icon col-lg-2 col-sm-2 list-item-image"><i class="fa fa-image" aria-hidden="true"></i></span>
                                    <span class="option-icon col-lg-2 col-sm-2 list-item-unordered-list"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                                    <span class="option-icon col-lg-2 col-sm-2 list-item text-edit"><i class="fa fa-font" aria-hidden="true"></i></span>
                                    <span class="option-icon col-lg-2 col-sm-2 list-item-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </li>`).insertAfter($(this).parent().parent().parent().parent());

                    updateList();
                    // updateTextEditPopover();
                }

                // Deletes a single list item
                function deleteListItem() {
                    const optionsContainerChildren = $(this).parent().children();

                    // If the selected list element to delete is the last element of the list and there is more than 1 list item in the list, delete this list element and place 'extra' options back on previous list element
                    if(this.parentElement.parentElement.parentElement.parentElement.children.length > 1 && optionsContainerChildren.length > 1) {
                        const previousListElement = this.parentElement.parentElement.parentElement.previousElementSibling;      // Previous list element

                        $(this).parent().parent().parent().remove();
                    } else
                        $(this).parent().parent().parent().parent().remove();        // If only 1 list element remains, delete whole list
                }

                // Unbinds focus listener on previous elements and applies new focus listener to all elements with class of "new-sections" - Does the same for options' click listeners (This is used to prevent toggling issues with the listeners (newer vs. older - enabled vs. disabled))
                function updateSections() {
                    $(".header").unbind("click").click(function() {
                        elementClicked = this;
                        const sectionClassUpdateTimeout = setTimeout(function() {
                            sectionBodies.forEach(sectionBody => {
                                if(hasClass(sectionBody, "in"))
                                    $(sectionBody).removeClass("in");
                            });
                        }, 50);
                    });

                    $("#accordion" + accordionParent).sortable({
                        revert: true
                    });

                    sectionBodies.forEach(sectionBody => {
                        $(sectionBody.firstElementChild).sortable({ revert: true });
                    });

                    $(".section-up").unbind("click", sectionUp).click(sectionUp);
                    $(".section-down").unbind("click", sectionDown).click(sectionDown);
                    $(".section-delete").unbind("click", sectionDelete).click(sectionDelete);
                }

                // Unbind the click listener on older rows and bind them back to all - This is used to prevent toggling issues with the listeners (newer vs. older - enabled vs. disabled)
                function updateTableOptions() {
                    $(".row0-add").unbind("click", addTableRow).click(addTableRow);
                    $(".row0-down").unbind("click", tableRowDown).click(tableRowDown);
                    $(".row0-up").unbind("click", tableRowUp).click(tableRowUp);
                    $(".row0-delete").unbind("click", tableRowDelete).click(tableRowDelete);

                    $(".table").sortable({
                        revert: true
                    });
                    $(".table-value").unbind("click").click(function() {
                        $(this).focus();
                    });
                }

                // Unbinds listeners on older rows and bind them back to all - This is used to prevent toggling issues with the listeners (newer vs. older - enabled vs. disabled)
                 // Updates the textboxes with the class of .textbox-textarea and textbox options with the class of .textbox-delete
                function updateTextbox() {
                    $(".element-delete").unbind("click", deleteElement).click(deleteElement);
                }

                function updateHyperlink() {
                    $(".hyperlink-edit").unbind("click", editHyperlink).click(editHyperlink);
                }

                function updateSummernote() {
                    $(".summernote").summernote({
                        height: 270,                 // set editor height
                        minHeight: null,             // set minimum height of editor
                        maxHeight: null,             // set maximum height of editor
                        focus: true                 // set focus to editable area after initializing summernote
                    });
                    $(".caret").removeClass("caret");
                    $(".exit-edit-mode").remove();
                    $(".note-toolbar").append(`<div class="note-btn-group btn-group note-table pull-right exit-edit-mode">
                                                    <div class="note-btn-group btn-group">
                                                        <button type="button" class="note-btn btn btn-primary btn-sm" data-container="body" title="Exit Edit Mode" data-toggle="tooltip" data-placement="bottom" data-trigger="hover">
                                                            <i class="fa fa-edit"></i>
                                                            <span class=""></span>
                                                        </button>
                                                    </div>
                                               </div>`);
                    $(".exit-edit-mode").unbind("click").click(function() {
                        const activeSection = getActiveSection();
                        $(activeSection).find(".card-block").append(this.parentElement.nextElementSibling.children[2].innerHTML);
                        $(activeSection).find(".summernote").remove();
                        $(activeSection).find(".note-editor").remove();
                    });
                }

                // Unbinds listeners on older rows and bind them back to all - This is used to prevent toggling issues with the listeners (newer vs. older - enabled vs. disabled)
                 /* Sets an "onchange listener" to all elements(inputs) with the "uploadImage" class
                   * Precondition: element will wait for an image file chosen by user
                    * Postcondition: new img element is created for displaying image chosen by user and input is removed from the DOM */
                function updateImageOptions() {

                    // Add new image to the DOM with a set width of 20% and retrieve selected image from user
                    $(".upload-image").unbind("change").change(function() {
                        const imageIDNumber = imageArray.length - 1;

                        $(`<img class="image" id="image${imageIDNumber}" src="#" alt="your image" />`).insertAfter(this);
                        document.getElementById(`image${imageIDNumber}`).style.width = "20%";
                        addImage(this);     // Retrieve selected image from user
                        $(this).remove();       // Remove the file input and replace it with user's selected image
                    });

                    // Allows user to change the image selected
                    $(".image").unbind("dblclick").dblclick(function() {
                        $(this).replaceWith(`<input class="upload-image" type="file" />`);

                        const index = imageArray.indexOf(document.getElementById(this.id));
                        if(index > -1)
                            imageArray.splice(index, 1);

                        updateImageOptions();       // Sets an "onchange listener" to all elements(inputs) with the "uploadImage" class
                    });

                    $(".image-edit").unbind("click", editImage).click(editImage);
                    $(".image-grow").unbind("click", imageGrow).click(imageGrow);
                    $(".image-shrink").unbind("click", imageShrink).click(imageShrink);
                    $(".element-delete").unbind("click", deleteElement).click(deleteElement);
                }

                // Unbinds listeners on older rows and bind them back to all - This is used to prevent toggling issues with the listeners (newer vs. older - enabled vs. disabled)
                 // Updates all messages and message options by setting focus listener on messages with the class of .imporant-text & .note-text - setting click listner on option with class of .message-delete
                function updateMessages() {


                    $(".element-delete").unbind("click", deleteElement).click(deleteElement);
                }

                // Unbinds listeners on older rows and binds them back to all - This is used to prevent toggling issues with the listeners (newer vs. older - enabled vs. disabled)
                 // Updates all list-item and list-item options by setting focus listener on list-textareas and setting dblclick & click listeners to all the children of oredered & unordered lists
                function updateList() {
                    $(".list-value").unbind("focus").focus(function(e) {
                        $(this).unbind("keydown").keydown(function(e) {
                            if(e.which === 13) {
                                e.preventDefault();
                                addNextListItem(this.nextElementSibling.firstElementChild);
                            }
                        });
                    });

                    $(".list-item-next").unbind("click").click(function() {
                        addNextListItem(this);
                    });
                    $(".list-item-image").unbind("click").click(addListImageBlock);
                    $(".list-item-unordered-list").unbind("click", addUnorderedListItem).click(addUnorderedListItem);
                    $(".list-item-ordered-list").unbind("click", continueOrderedListItem).click(continueOrderedListItem);
                    $(".list-item-delete").unbind("click", deleteListItem).click(deleteListItem);
                }

                function updateTextEditPopover() {
                    let hidePopupTimeoutId, element, elementInFocus;    // popup timeout id and the element attribute to be modified


                    $("#textEditPopover").on("mouseenter", function() {
                        clearTimeout(hidePopupTimeoutId);
                    });

                    $(".text-edit").unbind("mousedown").mousedown(function(e) {
                        event.preventDefault();

                        element = this.parentElement.previousElementSibling;
                        elementInFocus = $(":focus");       // Element that currently in focus

                        $(".text-color").val("#000000");
                        $(".font-size-input").val($(element).css("font-size").substring(0, $(element).css("font-size").length - 2));
                        $("#textEditPopover").css({ "top": (e.pageY - $("#textEditPopover").height() / 1.475), "left": "20%", "position": "absolute" });
                        $("#textEditPopover").show();
                    });

                    $("#textEditPopover").on("mouseleave", function() {
                        clearTimeout(hidePopupTimeoutId);
                        hidePopupTimeoutId = setTimeout(function() {
                            $("#textEditPopover").hide();
                        }, 10000);
                    });

                    $(".text-edit-popover-close").unbind("click").click(function() {
                        $("#textEditPopover").hide();
                    });

                    // Switch the value of the "font-family" input / dropdown (After dropdown item clicked - the clicked value should be the assigned to the parent's value)
                    $(".font-family-option").unbind("click").click(function() {
                        document.execCommand('styleWithCSS', false, true);
                        document.execCommand('fontName', false, $(this).text());
                        $(".font-family-button").text($(this).text());
                        $(elementInFocus).focus();
                    });

                    $(".font-size-input").unbind("change").change(function() {
                        document.execCommand('styleWithCSS', false, true);
                        document.execCommand('fontSize', false, `${$(this).val()}`);
                        $(elementInFocus).focus();
                    });

                    $(".text-color").unbind("change").change(function() {
                        document.execCommand('styleWithCSS', false, true);
                        document.execCommand('forecolor', false, $(this).val());
                        $(elementInFocus).focus();
                    });

                    // Switch the value / text of the "text-alignment" button pressed (Which alignment was selected)
                    $(".text-align").unbind("click").click(function() {
                        const item = $(".text-align[data-value]");
                        for(var index = 0; index < item.length; index++) {
                            if($(item[index]).attr("data-value") === $(this).attr("data-value")) {
                                item[index].style.backgroundColor = "rgba(181, 189, 198, 1)";
                                // $(item[index]).addClass("text-edit-selected");
                                // console.log(hasClass(item[index], "text-edit-selected"));
                            }
                            else
                                item[index].style.backgroundColor = "rgba(221, 229, 238, 1)";
                                // $(this).removeClass("text-edit-selected");
                        }
                        $(elementInFocus).focus();
                    });

                    $(".text-style").unbind("click").click(function() {
                        $(this).toggleClass("text-edit-selected");
                        $(elementInFocus).focus();
                    });

                }

                // Calls all update functions to update all elements and their event listeners (hence the title, 'update all')
                function updateEverything() {
                    updateSections();
                    updateTableOptions();
                    updateTextbox();
                    updateImageOptions();
                    updateMessages();
                    updateList();
                    // updateTextEditPopover();
                }

                /* Loops through all of the sectionBodies in the "sectionBodies" array above and determines if they are open
                  * Precondition: Array of sectionBodies are looped through and checked for a class of "show"
                   * Postcondition: If class of "show" is found in sections - that sections BODY is returned; otherwise, "undefined" is returned */
                function getActiveSection() {

                    let activeSection;

                    // For each sections, check if class of "show" is present. If "true" - return that sections
                    sectionBodies.forEach(section => {
                        if(hasClass(section, "in"))
                            activeSection = section;
                    });

                    return activeSection;

                }

                // Displays an alert-error-message with the given parameters
                function displayErrorMessage(errorMessage, errorMessageID) {
                    // $(`<div id="${errorMessageID}" class="alert alert-danger text-center" style="width: 50%; margin: 20px auto; margin-top: 100px;">${errorMessage}</div>`).insertAfter($("#creationTools"));
                    // setTimeout(function() {
                    //     $(`#${errorMessageID}`).remove();
                    // }, 5000);
                    $("#sweetAlertOk").unbind("click").click(function() {
                        $(".sweet-alert").css("display", "none");
                        $(".sweet-overlay").css("display", "none");
                    });

                    $(".sweet-alert").css("display", "block");
                    $(".sweet-alert-content").text(`${errorMessage}`);

                    $(".sweet-overlay").css("display", "block");
                }

                // Inserts an element (newNode) after the specified reference element (referenceNode) - This is a Vanilla Javascript function that takes native DOM elements / non Jquery objects
                function insertAfter(referenceNode, newNode) {
                    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
                }
             
                // Given an array and array value to be deleted - this function finds the index of the value in the array and deletes it
                function deleteArrayValue(array, deleteValue) {
                    array.indexOf(deleteValue) >= 0 ? arr.splice(array.indexOf(deleteValue), 1) : console.log("The 'delete value' given was not found in the array supplied");
                }

                // Takes an option icon and deletes all option icons except for delete
                function removeExtraOptions(optionElement) {
                    const optionsContainerChildren = $(optionElement).parent().children();      // Get all the children of the "options-container0"

                    // remove all options from current "options-container0" except for delete option
                    for(var child = 0; child < optionsContainerChildren.length - 1; child++)
                        $(optionsContainerChildren[child]).remove();
                }

                function setTextColor(color) {
                    document.execCommand('styleWithCSS', false, true);
                    document.execCommand('foreColor', false, color);
                }

                function download(filename, text) {
                    let pom = document.createElement('a');
                    pom.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
                    pom.setAttribute('download', filename);

                    if (document.createEvent) {
                        let event = document.createEvent('MouseEvents');
                        event.initEvent('click', true, true);
                        pom.dispatchEvent(event);
                    }
                    else
                        pom.click();
                }

            });

        </script>



        <!-- <script src="<?php // echo DOC_ROOT; ?>assets/js/custom/kb_edit.js"></script> -->

<!-- <div id="accordion" role="tablist" aria-multiselectable="true">

    <div class="card section">
        <div class="card-header" role="tab">
            <h5 class="mb-0">
                <a contenteditable class="collapsed header" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
                    
                </a>
            </h5>
            <div class="options-container0 col-lg-3 pull-right">
                <span class="pull-right option-icon col-lg-1 section-delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                <span class="pull-right option-icon col-lg-1 section-up"><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
                <span class="pull-right option-icon col-lg-1 section-down"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
            </div>
        </div>
        <div id="collapse1" class="collapse" role="tabpanel" aria-labelledby="heading1">
            <div class="card-block">

                

            </div>
        </div>
    </div>

</div> -->

    </body>
</html>