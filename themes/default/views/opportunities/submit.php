<div id="content">
	<div class="content-bg">
	<!-- start contacts block -->
		<div class="big-block">
		<div id="contact_us" class="contact">
			<?php
				if ($form_error)
				{
					?>
					<!-- red-box -->
					<div class="red-box">
						<h3>Error!</h3>
						<ul>
							<?php
							foreach ($errors as $error_item => $error_description)
							{
								print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
							}
							?>
						</ul>
					</div>
					<?php
				}
			?>
		<h1><?php echo Kohana::lang('ui_main.opportunities_submit'); ?> </h1><br />
			<?php print form::open(NULL, array('id' => 'opportunitiesForm', 'name' => 'opportunitiestForm')); ?>
			<div class="report_row">
				<h4><?php echo Kohana::lang('ui_main.resource_available'); ?> :</h4><br />
				<?php print form::input('resource_available', $form['resource_available'], 'class="text"'); ?></div>
			<div class="report_row">
				<h4><?php echo Kohana::lang('ui_main.pcv_name'); ?> :</h4><br />
				<?php print form::input('pcv_name', $form['pcv_name'], 'class="text"'); ?></div>
			<div class="report_row">
				<h4><?php echo Kohana::lang('ui_main.available_from'); ?>:</h4><span><?php echo Kohana::lang('ui_main.date_format');?></span></br >
				<?php print form::input('available_from', $form['available_from'], 'class="text"'); ?></div>
				<script type="text/javascript">
                                                        $().ready(function() {
                                                                $("#available_from").datepicker({ 
                                                                        showOn: "both", 
                                                                        buttonImage: "<?php echo url::file_loc('img'); ?>media/img/icon-calendar.gif", 
                                                                        buttonImageOnly: true 
                                                                });
                                                        });
				</script>
			<div class="report_row">
				<h4><?php echo Kohana::lang('ui_main.available_until'); ?>:</h4><span><?php echo Kohana::lang('ui_main.date_format');?></span></br >
				<?php print form::input('available_until', $form['available_until'], ' class="text"'); ?></div>
				<script type="text/javascript">
                                                        $().ready(function() {
                                                                $("#available_until").datepicker({ 
                                                                        showOn: "both", 
                                                                        buttonImage: "<?php echo url::file_loc('img'); ?>media/img/icon-calendar.gif", 
                                                                        buttonImageOnly: true 
                                                                });
                                                        });
                                </script>
			<div class="report_row">
				<h4><?php echo Kohana::lang('ui_main.contact_way'); ?>:</strong><br />
				<?php print form::textarea('contact', $form['contact'], '"rows="5" cols="40" class="textarea long"'); ?></div>
			<div class="report_row">
				<h4><?php echo Kohana::lang('ui_main.add_info'); ?>:</h4><br />
				<?php print form::textarea('add_info', $form['add_info'], ' "rows="5" cols="40" class="textarea long"'); ?></div>
		</div>

	<div class="report_row">
		<input name="submit" type="submit" value="Submit" class="btn_submit"> </div>
		<?php print form::close(); ?>
		<?php print form::open(); ?>
		<!-- end report form block -->
	</div>
	</div>
</div>
