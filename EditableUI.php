<?php include_once('includes/euiHeader.php'); ?>
        
<div id="wrapper" style="overflow-y: auto !important;">
    
    
    <div class="content-page0" style="overflow-y: auto !important;">
        <div class="content" style="width: 100%; height: 100%; margin: 0 auto;">
            <div class="container" style="width: 100%; height: 100%; margin: 0 auto;">

                <div class="row" style="border: none; width: 100%; height: 82vh; margin: 0 auto; margin-top: 4%;">
                    <?php include('includes/creationToolsNavbar.html'); ?>
                    <div class="col-sm-12" style="border: none; width: 100%; margin: 0 auto;">
                        <div class="card-box" style="border: none; width: 100%; margin: 0 auto;">
                            <div class="tabl-rep plugin" style="border: none; width: 100%; margin: 0 auto;">
                                <div class="table-wrapper" style="border: none; width: 100%; margin: 0 auto;">
                                    <div id="content-body">





                                        <!--Container For This Block of HTML-->
                                        <div class="container0 text-center" id="pageContainer">
                                            <div id="editContent">

                                                <?php echo isset($_POST['protocolData']) ? $_POST['protocolData'] : "<h1>Sorry, there is no data found for this file</h1>"; ?>

                                            </div>

                                            <!-- Preview Modal -->
                                            <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="background-color: #5fbeaa;">
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

                                            <!-- Error Message Modal -->
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

<?php include_once('includes/euiFooter.php'); ?>