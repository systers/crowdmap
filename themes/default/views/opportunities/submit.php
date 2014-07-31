<div id="content">
	<div class="content-bg">
	<!-- start contacts block -->
		<div class="big-block">
		<?php print form::open(); ?>
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
		<h1>Submit a new Resource</h1><br />
			<div class="report_row">
				<h4><?php echo form::label('resource_available', 'Resource Available'); ?>:</h4><br />
				<?php print form::input('resource_available', $form['resource_available'], 'class="text"'); ?></div>
			<div class="report_row">
				<h4><?php echo form::label('pcv_name', 'PCV Name'); ?>:</h4><br />
				<?php print form::input('pcv_name', $form['pcv_name'], 'class="text"'); ?></div>
			<div class="report_row">
				<h4><?php echo form::label('available_from', 'Available From'); ?>:</h4><br />
				<?php print form::input('available_from', $form['available_from'], 'class="text"'); ?></div>
			<div class="report_row">
				<h4><?php echo form::label('available_until', 'Available Until'); ?>:</h4><br />
				<?php print form::input('available_until', $form['available_until'], ' class="text"'); ?></div>
			<div class="report_row">
				<h4><?php echo form::label('way_to_contact', 'Best way to Contact'); ?>:</strong><br />
				<?php print form::textarea('contact', $form['contact'], '"rows="5" cols="40" class="textarea long"'); ?></div>
			<div class="report_row">
				<h4><?php echo form::label('additional_info', 'Additional Information'); ?>:</h4><br />
				<?php print form::textarea('additional_info', $form['additional_info'], ' "rows="5" cols="40" class="textarea long"'); ?></div>
		</div>

	<div class="report_row">
		<input name="submit" type="submit" value="Submit" class="btn_submit"> </div>
		<?php print form::close(); ?>
		<!-- end report form block -->
	</div>
	</div>
</div>
