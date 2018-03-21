<div class="row" style="width: 100;">
	<div class="panel-group" id="<?php echo $accordionName; ?>">
		<?php
			$stmt = $mysqli->prepare("SELECT id, name, view_order, belongs_to, reference_name FROM kb_submenus WHERE belongs_to = ? ORDER BY name ASC");
			$stmt->bind_param('i', $belongs_to);
			$stmt->execute();
			$tabs = $stmt->get_result();
			if($tabs->num_rows) {
				while($row = $tabs->fetch_assoc()): ?>
					<div class="panel panel-default">
				        <div class="panel-heading">
				            <h4 class="panel-title">
				                <a data-toggle="collapse" data-parent="#<?php echo $accordionName; ?>" href="#<?php echo $row['reference_name']; ?>" aria-expanded="false" class="collapsed"><?php echo $row["name"]; ?></a>
				            </h4>
				        </div>
				        <div id="<?php echo $row['reference_name']; ?>" class="panel-collapse collapse">
				            <div class="panel-body text-center">
								<?php

									$stmt = $mysqli->prepare("SELECT name, view_order, belongs_to, reference_name FROM kb_protocols WHERE belongs_to = ? ORDER BY name ASC");
									$stmt->bind_param('i', $row['id']);
									$stmt->execute();
									$subMenuItems = $stmt->get_result();
									if($subMenuItems->num_rows) {
										while($subRow = $subMenuItems->fetch_assoc()): ?>

											<a class="col-lg-4 col-md-6 col-sm-12 col-xs-12 protocol" href="<?php echo DOC_ROOT; ?>modules/kb/?parentLink=<?php echo $parentLink; ?>&parentMenu=<?php echo $row['reference_name']; ?>&fileName=<?php echo $subRow['reference_name']; ?>.php&sopLink=false&rand=<?php echo rand(); ?>"><?php echo $subRow['name']; ?></a>

											<?php

												// $pathName = $row['belongs_to'];
												// $filepath = str_replace(' ', '', $pathName);
												// $filepath = "mainTabs/" . lcfirst($filepath) . "/" . $row['link_name'];
												$filepath = $row['reference_name'];
												if(!file_exists($filepath))
												    mkdir($filepath, 0777, true);

												if(!file_exists($filepath . '/' . $subRow['reference_name'] . '.php')) {
														$fileData = '<h1 class="text-center protocol-title" style="margin-bottom: 5%;">' . $subRow["name"] . '</h1>

																 <div class="panel-group" id="accordion' . $subRow["reference_name"] . '" role="tablist" aria-multiselectable="true" style="width: 100%; text-align: center; margin: 10px 20px;">

																	 <div class="card panel panel-default section">
																	         <div class="card-header panel-heading" role="tab">
																	             <h5 class="mb-0 panel-title">
																	                 <a contenteditable="false" data-toggle="collapse" data-parent="#accordion' . $subRow["reference_name"] . '" href="#collapse' . $subRow["reference_name"] . '1" aria-expanded="false" aria-controls="collapse' . $subRow["reference_name"] . '1" class="collapsed header text-center">Section #1.0</a>
																	             </h5>
																	         </div>
																		 <div id="collapse' . $subRow["reference_name"] . '1" class="collapse panel-collapse" role="tabpanel" aria-labelledby="heading' . $subRow["reference_name"] . '1" aria-expanded="false" style>
																			 <div class="card-block panel-body text-center">

																			 </div>
																		 </div>
																	 </div>

																 </div>';

													$file = fopen($filepath . '/' . $subRow['reference_name'] . '.php', 'w+');
													fwrite($file, $fileData);
													fclose($file);
												}

											?>

										<?php endwhile;

									}										

								?>
				            </div>
				        </div>
				    </div>
				<?php endwhile;
			}

			$tabs->close();
			if($subMenuItems)
				$subMenuItems->close();
			if($subRow)
				$subRow->close();

		?>
	</div>
</div>