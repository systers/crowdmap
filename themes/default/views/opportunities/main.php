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
                        <th scope="col" class="pcv_name">PCV NAME</th>
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
                        $opportunity_needed = $opportunity_needed->search_of;
                        //$pcv_name = $opportunity_needed->pcv_name;
                ?>
                <tr>
                        <td><?php echo "1"; ?></td>
                        <td><?php //echo //$pcv_name; ?></td>
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
                        <th scope="col" class="available_from">FROM</th>
                        <th scope="col" class="available_until">TO</th>
                        <th scope="col" class="contact_way">CONTACT</th>
                        <th scope="col" class="add_info">INFO</th>
                </tr>
        </thead>
        <tbody>
                <?php
                if ($opportunities == 0)
                {
                      ?>
                        <tr><td colspan="3">Currently no Resources Available! :( </td></tr>
                        <?php
                }
                //foreach ($opportunities as $opportunity)
               	//{
                  //    $opportunity_id = $opportunity->id;
                    //  $resource_available = $opportunity->resource_available;
                //      $pcv_name = $opportunity->pcv_name;
                  //    $available_from = $opportunity->available_from;
                    ///  $available_until = $opportunity->available_until;
                     // $contact= $opportunity->contact;
                     // $add_info = $opportunity->add_info;
                ?>
                <tr>
                        <td><?php echo "1"; ?></td>
			<td><?php //echo $resource_available; ?></td>
                        <td><?php //echo $pcv_name; ?></td>
                        <td><?php //echo $available_from; ?></td>
                        <td><?php //echo $available_until; ?></td>
                        <td><?php //echo $contact; ?></td>
                        <td><?php //echo $add_info; ?></td>
                </tr>
                <?php
               // }
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
