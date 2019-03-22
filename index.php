<?php include_once('includes/kbHeader.php'); ?>

<div id="wrapper" style="overflow-y: auto !important; width: 100% !important;">
    
	<div class="content-page0">
		<div class="content" style="width: 100%; height: 100%; margin: 0 auto;">
			<div class="container" style="width: 100%; height: 100%; margin: 0 auto;">
			
				<div class="row" style="margin: 0 auto; margin-top: 4%; width: 100%; height: 85vh;"> 
                    <div class="tabs-vertical-env" style="height: 100%; overflow-y: auto; overflow-x: hidden;"> 
                        <ul id="kBMainTabs" class="nav tabs-vertical">
                        	<?php

                        		if($mainTabs = $mysqli->query("SELECT name, view_order, reference_name FROM kb_tabs ORDER BY view_order;"))
                        			
                        			while($row = $mainTabs->fetch_assoc()): ?>

                        				<li class="<?php echo ($row['reference_name'] === 'home' ? 'active' : ''); ?>" style="<?php echo ($row['view_order'] == 0 ? 'display: none; opacity: 0;' : ''); ?>">
	                                    	<a href="#<?php echo $row['reference_name']; ?>" data-toggle="tab" aria-expanded="true"><font><font><?php echo $row['name']; ?></font></font></a>
	                                   	</li>

<!--                                         <script>
                                            console.log('Name:\t<?php // echo $row["name"]; ?>');
                                            console.log('View_order:\t<?php // echo $row["view_order"]; ?>');
                                            console.log('Reference_name:\t<?php // echo $row["reference_name"]; ?>\n\n');
                                        </script> -->

	                                <?php endwhile;

                        	?>
                        </ul>

                        <div class="tab-content">
                        	<?php

                        		$mainTabs->data_seek(0);
                        			while($row = $mainTabs->fetch_assoc()): ?>

                        				<div class="tab-pane <?php echo ($row['name'] === 'Home' ? 'active' : ''); ?>" id="<?php echo $row['reference_name']; ?>"><?php include_once("mainTabs/" . $row["reference_name"] . "/" . $row["reference_name"] . ".php"); ?></div>

                        			<?php endwhile;

                        	?>
                        	<div class="sticky-bottom row text-center pull-right" id="tabContentFooter">
								<footer id="knowledgeBaseFooter" style="position: relative;">
									<small>Training &amp; Resource Center &nbsp;| &nbsp;John Doe, LLC &nbsp;| &nbsp;2017-2018</small>
								</footer>
								<button class="pull-right btn btn-default btn-sm waves-effect waves-light" id="editUI">Edit</button>
							</div>
                        </div>
                    </div>
                </div>

                <?php

                	// echo count($_SESSION['permissions']) . '<br>';
                	// foreach($_SESSION['permissions'] as $key => $value)
                	// 	echo '[' . $key . '] => ' . $value . '<br>';

                ?>

            </div>
        </div>
    </div>

	<footer id="footer" class="footer">
    	<button class="btn btn-info" id="sa-warning" onmousedown="event.preventDefault();" style="display: none !important;">Click me</button>
		<button class="btn btn-primary waves-effect waves-light" id="toggleFullWidthModal" data-toggle="modal" data-target="#custom-width-modal" style="display: none !important;">Full width Modal</button>
	</footer>

</div>

<?php

    include_once('includes/protocolDisplayModal.php');
    include_once('includes/kbFooter.php');
    
?>
