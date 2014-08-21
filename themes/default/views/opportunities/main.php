<div id="content">
	<div class="content-bg">
		<!-- start block -->
		<div class="big-block">
		<h1><?php echo Kohana::lang('ui_main.opportunities'); ?></h1>
				<form action="opportunities/submit">
                        	<input id="btn-submit-opportunities" class="btn_submit" type="submit" value="<?php echo Kohana::lang('ui_main.opportunities_submit'); ?>" />
                        	</form><br /><br />
			<div id="opportunities_form" class="opportunities">
			<div class="tt-arrow">
	<h2 class="heading"><?php echo Kohana::lang('ui_main.search_of'); ?></h2>
	<table class="table-list">
        <?php form::open(); ?>
	<thead>
                <tr>
                        <th scope="col" class="search_of_row"><?php echo Kohana::lang('ui_main.date'); ?></th>
			<th scope="col" class="search_of_row"><?php echo Kohana::lang('ui_main.report_title'); ?></th>
			<th scope="col" class="search_of_row"><?php echo Kohana::lang('ui_main.search_of'); ?></th>
                </tr>
        </thead>
        <tbody>
                <?php
              if (count($opportunities_needed) == 0)
              {
                        ?>
                        <tr><td colspan="3"><?php echo Kohana::lang('ui_main.no_opportunities_needed'); ?></td></tr>
                        <?php
              }
              foreach ($opportunities_needed as $opportunity_needed)
		{
                ?>
                <tr>
			<td><?php echo $opportunity_needed[1] ?></td>
			<td><a href="<?php echo url::site() . 'reports/view/' . $opportunity_needed[0]; ?>"> <?php echo $opportunity_needed[2]; ?></a></td>
                        <td><?php echo $opportunity_needed[3] ?></td>
                </tr>
                <?php
                }
                ?>
        </tbody>
	<?php form::close(); ?>
</table>
<a class="more" href="<?php echo url::site() . 'opportunities/' ?>"><?php //echo Kohana::lang('ui_main.view_more'); ?></a>
<div style="clear:both;"></div>
			</div>
	<div class="tt-arrow">
	<h2 class="heading"><?php echo Kohana::lang('ui_main.resources_available'); ?></h2>
	<table class="table-list">
        <?php form::open(); ?>
	<thead>
                <tr>
                        <th scope="col" class="resources_available_row"><?php echo Kohana::lang('ui_main.resource_available'); ?></th>
                        <th scope="col" class="resources_available_row"><?php echo Kohana::lang('ui_main.pcv_name'); ?></th>
                        <th scope="col" class="resources_available_row"><?php echo Kohana::lang('ui_main.available_until'); ?></th>
                        <th scope="col" class="resources_available_row"><?php echo Kohana::lang('ui_main.contact_way'); ?></th>
                        <th scope="col" class="resources_available_row"><?php echo Kohana::lang('ui_main.add_info'); ?></th>
                </tr>
        </thead>
        <tbody>
                <?php
                if (count($opportunities) == 0)
                {
                      ?>
                        <tr><td colspan="3"><?php echo Kohana::lang('ui_main.no_resources_available'); ?></td></tr>
                        <?php
                }
                foreach ($opportunities as $opportunity)
               	{
                ?>
                <tr>
                        <td><?php echo $opportunity['0']; ?></td>
			<td><?php echo $opportunity['1']; ?></td>
                        <td><?php echo $opportunity['3']; ?></td>
                        <td><?php echo $opportunity['4']; ?></td>
                        <td><?php echo $opportunity['5']; ?></td>
                </tr>
                <?php
                }
                ?>
        </tbody>
	<?php form::close(); ?>
	</table>
<a class="more" href="<?php echo url::site() . 'opportunities/' ?>"><?php //echo Kohana::lang('ui_main.view_more'); ?></a>
<div style="clear:both;"></div>
			</div>
		</div>
		<!-- end block -->
		</div>
	</div>
</div>
