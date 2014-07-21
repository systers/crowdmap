<?php 
/**
 * JP: Homepage settings view page.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     API Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
?>
			<div class="bg">
				<h2>
					<?php admin::settings_subtabs("homepage"); ?>
				</h2>
				<?php print form::open(NULL, array('id' => 'homepageForm', 'name' => 'homepageForm','action'=> url::site().'admin/settings/homepage')); ?>
				<div class="report-form">
					<?php
					if ($form_error) {
					?>
						<!-- red-box -->
						<div class="red-box">
							<h3><?php echo Kohana::lang('ui_main.error');?></h3>
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

					if ($form_saved) {
					?>
						<!-- green-box -->
						<div class="green-box">
							<h3><?php echo Kohana::lang('ui_main.configuration_saved');?></h3>
						</div>
					<?php
					}
					?>				
					<div class="head">
						<h3><?php echo Kohana::lang('settings.homepage.title');?></h3>
						<input type="submit" class="save-rep-btn" value="<?php echo Kohana::lang('ui_admin.save_settings');?>" />
					</div>
					<!-- column -->		
					<div class="sms_holder">

						<div class="row">
							<h4><a href="#" class="tooltip" title="<?php echo Kohana::lang("tooltips.settings_enable_media_filters"); ?>"><?php echo Kohana::lang('settings.homepage.enable_media_filters'); ?></a></h4>
							<span class="sel-holder">
								<?php print form::dropdown('enable_media_filters', $yesno_array, $form['enable_media_filters']); ?>
							</span>
						</div>
						<div class="row">
							<h4><a href="#" class="tooltip" title="<?php echo Kohana::lang("tooltips.settings_enable_chronological_filter"); ?>"><?php echo Kohana::lang('settings.homepage.enable_chronological_filter'); ?></a></h4>
							<span class="sel-holder">
								<?php print form::dropdown('enable_chronological_filter', $yesno_array, $form['enable_chronological_filter']); ?>
							</span>
						</div>
						<div class="row">
							<h4><a href="#" class="tooltip" title="<?php echo Kohana::lang("tooltips.settings_enable_category_filters"); ?>"><?php echo Kohana::lang('settings.homepage.enable_category_filters'); ?></a></h4>
							<span class="sel-holder">
								<?php print form::dropdown('enable_category_filters', $yesno_array, $form['enable_category_filters']); ?>
							</span>
						</div>
						<div class="row">
							<h4><a href="#" class="tooltip" title="<?php echo Kohana::lang("tooltips.settings_enable_category_filters_showhide"); ?>"><?php echo Kohana::lang('settings.homepage.enable_category_filters_showhide'); ?></a></h4>
							<span class="sel-holder">
								<?php print form::dropdown('enable_category_filters_showhide', $yesno_array, $form['enable_category_filters_showhide']); ?>
							</span>
						</div>
						<div class="row">
							<h4><a href="#" class="tooltip" title="<?php echo Kohana::lang("tooltips.settings_show_reporting_options"); ?>"><?php echo Kohana::lang('settings.homepage.show_reporting_options'); ?></a></h4>
							<span class="sel-holder">
								<?php print form::dropdown('show_reporting_options', $yesno_array, $form['show_reporting_options']); ?>
							</span>
						</div>
						<div class="row">
							<h4><a href="#" class="tooltip" title="<?php echo Kohana::lang("tooltips.settings_show_submit_report_tab"); ?>"><?php echo Kohana::lang('settings.homepage.show_submit_report_tab'); ?></a></h4>
							<span class="sel-holder">
								<?php print form::dropdown('show_submit_report_tab', $yesno_array, $form['show_submit_report_tab']); ?>
							</span>
						</div>
						<div class="row">
							<h4><a href="#" class="tooltip" title="<?php echo Kohana::lang("tooltips.settings_enable_filter_search"); ?>"><?php echo Kohana::lang('settings.homepage.enable_filter_search'); ?></a></h4>
							<span class="sel-holder">
								<?php print form::dropdown('enable_filter_search', $yesno_array, $form['enable_filter_search']); ?>
							</span>
						</div>

					</div>
		
					<div class="simple_border"></div>
		
					<input type="submit" class="save-rep-btn" value="<?php echo Kohana::lang('ui_admin.save_settings');?>" />
				</div>
				<?php print form::close(); ?>
			</div>
