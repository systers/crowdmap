<div id="content">
	<div class="content-bg">
		<!-- start faqs block -->
		<div class="big-block">
			<h1><?php echo Kohana::lang('ui_main.faqs'); ?></h1>
			<div id="contact_us" class="contact">
			<?php
							if ($total_items == 0)
							{
						?>
							<tr>
								<td colspan="4" class="col">
									<h3><?php echo Kohana::lang('ui_main.no_results');?></h3>
								</td>
							</tr>
							<?php	
							}
							foreach ($messages as $each_question)
							{
								$message_id = $each_question->id;
								$question = $each_question->question;
								$answer = $each_question->answer;
								?>
								<div class="question" style="font-weight:900;font-size:1.2em;">
									<p><?php echo $question; ?></p>
								</div>
								<div class="answer">
									<p><?php echo $answer; ?></p>
								</div>
							<?php
							}
							?>
			</div>
		</div>
		<!-- end faqs block -->
	</div>
</div>
