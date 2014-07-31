<div id="content">
	<div class="content-bg">
		<!-- start block -->
		<div class="big-block">
			<h1><?php echo Kohana::lang('ui_main.opportunities'); ?></h1>
				<form action="opportunities/submit">
                        	<input id="btn-submit-opportunities" class="btn_submit" type="submit" value="<?php echo Kohana::lang('ui_main.submit_new_opportunity!'); ?>" />
                        	</form><br /><br />
			<div id="contact_us" class="contact">
			<div class="tt-arrow">
				<h2 class="heading"><?php echo Kohana::lang('ui_main.in_search_of'); ?></h2>
				<?php echo $search_of_view; ?>
			</div>
			<div class="tt-arrow">
			<h2 class="heading"><?php echo Kohana::lang('ui_main.resources_available'); ?></h2>
				<?php echo $resource_available_view; ?></div>
			</div>
		</div>
		<!-- end block -->
	</div>
</div>
