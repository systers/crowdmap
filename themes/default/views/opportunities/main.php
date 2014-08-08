<div id="content">
	<div class="content-bg">
		<!-- start block -->
		<div class="big-block">
			<h1>Opportunities</h1>
				<form action="opportunities/submit">
                        	<input id="btn-submit-opportunities" class="btn_submit" type="submit" value="Submit a new Opportunity" />
                        	</form><br /><br />
			<div id="opportunities_form" class="opportunities">
			<div class="tt-arrow">
	<h2 class="heading">In Search of</h2>
	<table class="table-list">
        <?php form::open(); ?>
	<thead>
                <tr>
                        <th scope="col" class="search_of">Resource Needed</th>
                        <th scope="col" class="pcv_name">FOR INCIDENT ID</th>
                </tr>
        </thead>
        <tbody>
                <?php
              if (count($opportunities_needed) == 0)
              {
                        ?>
                        <tr><td colspan="3">Currently no Resources Needed!</td></tr>
                        <?php
              }
              foreach ($opportunities_needed as $opportunity_needed)
		{
                ?>
                <tr>
                        <td><?php echo $opportunity_needed['2']; ?></td>
                        <td><?php echo $opportunity_needed['1']; ?></td>
                </tr>
                <?php
                }
                ?>
        </tbody>
	<?php form::close(); ?>
</table>
<a class="more" href="<?php echo url::site() . 'opportunities/' ?>"><?php echo Kohana::lang('ui_main.view_more'); ?></a>
<div style="clear:both;"></div>
			</div>
	<div class="tt-arrow">
	<h2 class="heading">Resources Available</h2>
	<table class="table-list">
        <?php form::open(); ?>
	<thead>
                <tr>
                        <th scope="col" class="resource_available">Resource Available</th>
                        <th scope="col" class="pcv_name">PCV NAME</th>
                        <th scope="col" class="available_until">AVAILABLE UNTIL</th>
                        <th scope="col" class="contact_way">CONTACT</th>
                        <th scope="col" class="add_info">ADDITIONAL INFO</th>
                </tr>
        </thead>
        <tbody>
                <?php
                if (count($opportunities) == 0)
                {
                      ?>
                        <tr><td colspan="3">Currently no Resources Available! :( </td></tr>
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
<a class="more" href="<?php echo url::site() . 'opportunities/' ?>"><?php echo Kohana::lang('ui_main.view_more'); ?></a>
<div style="clear:both;"></div>
			</div>
		</div>
		<!-- end block -->
	</div>
</div>
