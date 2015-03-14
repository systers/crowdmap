<?php 
/**
 * Private Messages view page.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Private Messages View
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
?>
			<div class="bg">
				<h2>
					<?php members::faq_subtabs("view"); ?>
				</h2>

				<!-- report-table -->
				<div class="table-holder">
					<div class="faq">
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
			</div>
