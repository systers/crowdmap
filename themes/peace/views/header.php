<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo html::specialchars($page_title.$site_name); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php echo $header_block; ?>
	<?php
	// Action::header_scripts - Additional Inline Scripts from Plugins
	Event::run('ushahidi_action.header_scripts');
	?>

</head>

<?php
  // Add a class to the body tag according to the page URI

  // we're on the home page
  if (count($uri_segments) == 0)
  {
  	$body_class = "page-main";
  }
  // 1st tier pages
  elseif (count($uri_segments) == 1)
  {
    $body_class = "page-".$uri_segments[0];
  }
  // 2nd tier pages... ie "/reports/submit"
  elseif (count($uri_segments) >= 2)
  {
    $body_class = "page-".$uri_segments[0]."-".$uri_segments[1];
  }
?>

<!-- JP: Added containers and wrappers. -->
<body id="page" class="<?php echo $body_class; ?>">

	<div id="header_nav-container">
		<div class="wrapper floatholder rapidxwpr">

			<?php echo $header_nav; ?>

		</div>
	</div>

        <!-- / header item for plugins -->
        <?php
            // Action::header_item - Additional items to be added by plugins
	        Event::run('ushahidi_action.header_item');
        ?>

	<!-- mainmenu -->
	<div id="mainmenu-container">

		<div class="wrapper floatholder rapidxwpr">

			<div id="mainmenu" class="clearingfix">
				<ul>
					<!-- JP: Show or hide reports_submit tab, depending on settings. -->
					<?php nav::main_tabs($this_page, (Kohana::config('settings.show_submit_report_tab') ? array() : array('reports_submit'))); ?>
				</ul>

				<?php if ($allow_feed == 1) { ?>
				<div class="feedicon"><a href="<?php echo url::site(); ?>feed/"><img alt="<?php echo html::escape(Kohana::lang('ui_main.rss')); ?>" src="<?php echo url::file_loc('img'); ?>media/img/icon-feed.png" style="vertical-align: middle;" border="0" /></a></div>
				<?php } ?>

			</div>

		</div>

	</div>
	<!-- / mainmenu -->

        <!-- wrapper -->
        <div class="wrapper floatholder rapidxwpr">

                <!-- main body -->
                <div id="middle">
                        <div class="background layoutleft">
