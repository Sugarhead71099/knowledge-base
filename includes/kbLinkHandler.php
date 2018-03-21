		<!-- Link Handler -->
		<?php
			if(isset($_GET['fileName']) && trim($_GET['fileName']) && substr($_GET['fileName'], strlen($_GET['fileName']) - 4) === '.php') {
				if(isset($_GET['parentLink']) && isset($_GET['parentMenu'])) {
					$filepath = getFilepath('mainTabs', '/' . $_GET['parentLink'] . '/' . $_GET['parentMenu'] . '/' . $_GET['fileName']);
					if($_GET['sopLink'] === 'false') {
		?>

						<!-- Display protocol in unique window -->
						<script>
							let protocolFilepath = '<?php echo $filepath; ?>';
							if($.trim(protocolFilepath)) {
								
								$.post(protocolFilepath, (data) => {
									$("#wrapper").html(`<div class="tab-content" style="background: white; width: 95%; height: 95%; margin-left: 2.5%; margin-top: 1.25%; padding: 10px 20px; overflow-y: auto;">
															${data}
														</div>`);
								});
							}
						</script>

		<?php
					} else {
		?>

						<!-- Display protocol in modal -->
						<script>
							// $('#changeProtocol').css('visibility', 'hidden');
							$("#toggleFullWidthModal").click();
							// $('#custom-width-modal').on('hidden.bs.modal', (e) => {
							// 	$('#changeProtocol').css('visibility', 'visible');
							// 	$('#custom-width-modal').off('hidden.bs.modal');
							// });
							$(".modal-backdrop").toggleClass("reveal");

							let protocolFilepath = "<?php echo $filepath; ?>";
							if($.trim(protocolFilepath)) {
								let protocolName = "<?php echo $_GET['fileName']; ?>";
								protocolName = protocolName.replace(/.php/g, "");

								$.post(protocolFilepath, function(data) {
									$("#custom-width-modal .modal-body").html(data);
									$("#custom-width-modal .modal-body").append(`<form id="protocolForm" method="POST" action="EditableUI.php" style="display: none;">
																					<input id="protocolData" name="protocolData" type="text">
																					<input id="parentMenu" name="parentMenu" type="text">
																					<input id="protocolName" name="protocolName" type="text">
																					<input id="referenceName" name="referenceName" type="text">
																					<input id="elemID" name="elemID" type="text">
																				  </form>`);
									$('#protocolData').val(data);
									$('#parentMenu').val(`<?php echo $_GET['parentMenu']; ?>`);
									$('#protocolName').val(protocolName);
									$('#referenceName').val(protocolName);
									$('#elemID').val(`<?php echo $_GET['parentLink']; ?>`);
								});
							}

							$("#changeProtocol").unbind("click").click(function() {
								postOutputTabData();
							});

							document.getElementById("protocolWindow").href = window.location.href.replace(/true/g, "false");
							$("#protocolWindow").unbind("click").click(function(e) {
								e.preventDefault();
								window.open(this.href, "Protocol Window Display", "toolbar=yes,scrollbars=yes,resizable=yes,left=100,top=25,width=" + (screen.width - 100) + ",height=" + (screen.height - 100));
							});

							document.getElementById("sopLink").href = window.location.href;
							$("#sopLink").unbind("click").click(function(e) {
								e.preventDefault();
								copyToClipboard(this.href);
								$.Notification.notify('success', 'bottom left', '', 'SOP Link Copied To Clipboard');
							});
						</script>

		<?php

					}
				}
			}

		?>
