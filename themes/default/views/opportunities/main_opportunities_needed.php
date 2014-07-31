<table class="table-list">
	<thead>
		<tr>
			<th scope="col" class="search_of"><?php echo Kohana::lang('ui_main.in_search_of'); ?></th>
			<th scope="col" class="pcv_name"><?php echo Kohana::lang('ui_main.pcv_name'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ($opportunities_needed->count() == 0)
		{
			?>
			<tr><td colspan="3"><?php echo Kohana::lang('ui_main.no_opportunities'); ?></td></tr>
			<?php
		}
		foreach ($opportunities_needed as $opportunity_needed)
		
			$opportunity_needed_id = $opportunity_needed->id;
			$opportunity_needed = $opportunity_needed->search_of;
			//$pcv_name = $opportunity_needed->pcv_name;
		?>
		<tr>
			<td><a href="<?php echo url::site() . 'opportunities/view/' . $opportunity_id; ?>"> <?php echo $opportunity_needed; ?></a></td>
			<td><?php //echo //$pcv_name; ?></td>
		</tr>
		<?php
		//}
		?>
	</tbody>
</table>
<a class="more" href="<?php echo url::site() . 'opportunities/' ?>"><?php echo Kohana::lang('ui_main.view_more'); ?></a>
<div style="clear:both;"></div>
