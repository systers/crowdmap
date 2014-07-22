<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Download Reports view page.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */
?>

<?php print form::open(NULL, array('id' => 'reportForm'));?>

<div class="big-block">
	<h1><?php echo Kohana::lang('ui_admin.download_reports');?></h1>
	<?php if ($form_error): ?>
	<!-- red-box -->
	<div class="red-box">
		<h3><?php echo Kohana::lang('ui_main.error');?></h3>
		<ul>
			<?php
				foreach ($errors as $error_item => $error_description)
				{
					// print "<li>" . $error_description . "</li>";
					print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
				}
			?>
		</ul>
	</div>
	<?php endif; ?>
	<div class="categories report_category">
	<h2><?php echo Kohana::lang('ui_main.categories') ?></h2>
		
		<div style="clear: left; width: 100%; float: left;">
			<input type="checkbox" id="category_all" name="category_all" onclick="CheckAll(this.id, 'category')"/><strong><?php echo utf8::strtoupper(Kohana::lang('ui_main.select_all'));?></strong>
		</div>
		<?php
		$selected_categories = (!empty($form['incident_category']) AND is_array($form['incident_category']))
					? $selected_categories = $form['incident_category']
				: array();
		if (method_exists('category','form_tree'))
		{
			echo category::form_tree('category', $selected_categories, 2, TRUE);
		}
		elseif (Kohana::config('settings.ushahidi_version') >= 2.4 AND Kohana::config('settings.ushahidi_version') <= 2.5)
		{
			echo category::tree(ORM::factory('category')->find_all(), TRUE, $selected_categories, 'category', 2, TRUE);
		}
		elseif (Kohana::config('settings.ushahidi_version') < 2.4)
		{
			echo category::tree(ORM::factory('category')->find_all(), $selected_categories, 'category', 2, TRUE);
		}
		?>
	</div>
	<div>
		<!-- JP: Reformated the layout. -->
		<table style="width: 100%; clear: both;">
			<tr>
				<td style="width: 50%">
					<h2><?php echo Kohana::lang('ui_main.verification') ?></h2>
					<table>
						<tr>
							<td>
								<?php print form::checkbox('verified[]', 1, TRUE); ?>&nbsp;
							</td>
							<td>
								<?php echo Kohana::lang('ui_main.verified');?>
							</td>
						</tr>
						<tr>
							<td>
								<?php print form::checkbox('verified[]', 0, TRUE); ?>&nbsp;
							</td>
							<td>
								<?php echo Kohana::lang('ui_main.unverified');?>
							</td>
						</tr>
					</table>
				</td>
				<td style="width: 50%">
					<h2>Date range</h2>
					<table>
						<tr>
							<td>
								<strong><?php echo Kohana::lang('ui_admin.from_date'); ?>&nbsp;</strong>
							</td>
							<td>
								<?php print form::input('from_date', $form['from_date'], ' class="text", SIZE=10'); ?>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo Kohana::lang('ui_admin.to_date'); ?>&nbsp;</strong>
							</td>
							<td>
								<?php print form::input('to_date', $form['to_date'], ' class="text", SIZE=10'); ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<!-- JP: Added filter search. -->
		<br>
		<h2><?php echo Kohana::lang('ui_main.filter_by_search'); ?></h2>
		<strong><?php echo Kohana::lang('ui_main.keywords'); ?></strong>
		<br>
		<?php print form::input('filter_search', $form['filter_search'], ' class="text", SIZE=25'); ?>

	</div>
	<br>
	<div class="box">
		<table>
			<tr>
				<td width="5"><?php print form::radio('formato', 0, 1);?></td><td width="50">CSV</td>
				<td width="5"><?php print form::radio('formato', 1, 0);?></td><td width="50">KML</td>
				<!-- JP: Added HTML option. -->
				<td width="5"><?php print form::radio('formato', 2, 0);?></td><td width="50">HTML</td>
				<td width="50">
				<input id="save_only" type="image" src="<?php print url::file_loc('img');?>media/img/admin/btn-download.gif" class="save-rep-btn" />
				</td>
			</tr>
		</table>
	</div>
	<div id="form_error"></div>
	<?php print form::close();?>
</div>
