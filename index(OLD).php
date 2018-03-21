<?php include_once('includes/kbHeader.php'); ?>

<div id="wrapper0" class="" style="overflow-y: auto !important; width: 100% !important; height: 100%">
    
    
	<div class="content-page0">
		<div class="content" style="width: 100%; height: 100%; margin: 0 auto;">
			<div class="container" style="width: 100%; height: 100%; margin: 0 auto;">
			
				<div class="row" style="margin: 0 auto; margin-top: 1%; width: 100%; height: 85vh;"> 
                    <div class="tabs-vertical-env" style="height: 100%; overflow-y: auto; overflow-x: hidden;"> 
                        <ul id="kBMainTabs" class="nav tabs-vertical">
                        	<?php

                        		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        		if(mysqli_connect_errno()) {
                        			printf("Connection failed: %s\n", mysqli_connect_error());
                        			exit();
                        		}

                        		if($mainTabs = mysqli_query($connection, "SELECT name, link_name, view_order, is_main_tab, reference_name FROM knowledge_base WHERE is_main_tab = 1 ORDER BY view_order;"))

                        			while($row = mysqli_fetch_assoc($mainTabs)): ?>

                        				<li class="<?php echo ($row['name'] == 'Home' ? 'active' : ''); ?>" style="<?php echo ($row['view_order'] == 0 ? 'display: none; opacity: 0;' : ''); ?>">
	                                    	<a href="#<?php echo $row['reference_name']; ?>" data-toggle="tab" aria-expanded="true"><font><font><?php echo $row['name']; ?></font></font></a>
	                                   	</li>

	                                <?php endwhile;

                        	?>
                        </ul>

                        <div class="tab-content">
                        	<?php

                        		mysqli_data_seek($mainTabs, 0);
                        			while($row = mysqli_fetch_assoc($mainTabs)): ?>

                        				<div class="tab-pane <?php echo ($row['name'] == 'Home' ? 'active' : ''); ?>" id="<?php echo $row['reference_name']; ?>"><?php include_once("mainTabs/" . $row["link_name"] . "/" . $row["link_name"] . ".php"); ?></div>

                        			<?php endwhile;

                        	?>
                        	<div class="sticky-bottom row text-center pull-right" id="tabContentFooter">
								<footer id="knowledgeBaseFooter" style="position: relative;">
									<small>Knowledge &amp; Base &nbsp;| &nbsp;John Doe, Fake &nbsp;| &nbsp;2017-2018</small>
								</footer>
								<button class="pull-right btn btn-default btn-sm waves-effect waves-light" id="editUI">Edit</button>
							</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php include_once('includes/kbFooter.php'); ?>
