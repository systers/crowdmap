<table class="table-list">
	<thead>
		<tr>
			<th scope="col" class="resource_available">Resource Available</th>
			<th scope="col" class="pcv_name">PCV NAME</th>
			<th scope="col" class="available_from">FROM</th>
			<th scope="col" class="available_until">TO</th>
			<th scope="col" class="contact_way">CONTACT</th>
			<th scope="col" class="add_info">INFO</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ($opportunities->count() == 0)
		{
			?>
			<tr><td colspan="3"><?php echo Kohana::lang('ui_main.no_opportunities'); ?></td></tr>
			<?php
		}
		foreach ($opportunities as $opportunity)
		{
			$opportunity_id = $opportunity->id;
			$resource_available = $opportunity->resource_available;
			$pcv_name = $opportunity->pcv_name;
			$available_from = $opportunity->available_from;
			$available_until = $opportunity->available_until;
			$contact= $opportunity->contact;
			$additional_info = $opportunity->additional_info;
		?>
		<tr>
			<td><a href="<?php echo url::site() . 'opportunities/view/' . $opportunity_id; ?>"> <?php echo $opportunity; ?></a></td>
			<td><?php echo $pcv_name; ?></td>
			<td><?php echo $available_from; ?></td>
			<td><?php echo $available_until; ?></td>
			<td><?php echo $contact; ?></td>
			<td><?php echo $additional_info; ?></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
<a class="more" href="<?php echo url::site() . 'opportunities/' ?>"><?php echo Kohana::lang('ui_main.view_more'); ?></a>
<div style="clear:both;"></div>
