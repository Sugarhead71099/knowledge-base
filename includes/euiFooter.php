            <footer class="footer">
                <button class="btn btn-info" id="sa-warning" onmousedown="event.preventDefault();" style="display: none !important;">Click me</button>
                <button class="pull-right btn btn-default btn-sm waves-effect waves-light" id="submitChanges">Submit Changes</button>
            </footer>
        </div>

        <script>
            var resizefunc = [];
        </script>


        <!-- jQuery  -->
        <script src="<?php echo DOC_ROOT; ?>assets/js/jquery.min.js"></script>
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

        <!-- Sweet Alert -->
        <script src="<?php echo DOC_ROOT; ?>assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/pages/jquery.sweet-alert.init.js"></script>

        <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="<?php echo DOC_ROOT; ?>assets/js/custom/kb-bootstrap.min.js"></script>

        <!-- Summernote EditUI -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.js"></script>

        <script src="<?php echo DOC_ROOT; ?>assets/js/custom/hashmap.js"></script>

        <?php include_once('kbFunctions.php'); ?>

        <script>
            const accordionParent = `<?php echo $_POST['referenceName']; ?>`;
            // const parentTab = `<?php // echo $_POST['parentTab']; ?>`;
            const parentMenu = `<?php echo $_POST['parentMenu']; ?>`;
            const protocolName = `<?php echo $_POST['protocolName']; ?>`;
            const elem_id = `<?php echo $_POST['elemID']; ?>`;
        </script>

        <script src="<?php echo DOC_ROOT; ?>assets/js/custom/eui_core.js"></script>
    </body>
</html>