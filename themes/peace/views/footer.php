			</div>
		</div>
		<!-- / main body -->

	</div>
	<!-- / wrapper -->

	<!-- footer -->
	
	<!-- JP: added footer wrapper and container -->

	<div id="footer-container">

		<div class="wrapper floatholder rapidxwpr">

			<div id="footer" class="clearingfix">

				<div id="underfooter"></div>

				<!-- footer content -->
				<div class="wrapper floatholder rapidxwpr">

					<!-- footer credits -->
					<div class="footer-credits">
						Powered by the &nbsp;
						<a href="http://www.ushahidi.com/">
							<img src="<?php echo url::file_loc('img'); ?>media/img/footer-logo.png" alt="Ushahidi" class="footer-logo" />
						</a>
						&nbsp; Platform
					</div>
					<!-- / footer credits -->

					<!-- footer menu -->
					<div class="footermenu">

						<!-- JP: We'll use a table (rather than an inline list) so that the items will be vertically centered. -->

						<table class="clearingfix">
							<tr>
								<td>
									<a class="item1" href="<?php echo url::site(); ?>"><?php echo Kohana::lang('ui_main.home'); ?></a>
								</td>

								<?php if (Kohana::config('settings.allow_reports')): ?>
								<td>
									<a href="<?php echo url::site()."reports/submit"; ?>"><?php echo Kohana::lang('ui_main.submit'); ?></a>
								</td>
								<?php endif; ?>

								<?php if (Kohana::config('settings.allow_alerts')): ?>
								<td>
									<a href="<?php echo url::site()."alerts"; ?>"><?php echo Kohana::lang('ui_main.alerts'); ?></a>
								</td>
								<?php endif; ?>
								
								<?php if (Kohana::config('settings.allow_opportunities')): ?>
                                                                <td>
                                                                        <a href="<?php echo url::site()."opportunities"; ?>"><?php echo Kohana::lang('ui_main.opportunities'); ?></a>
                                                                </td>
                                                                <?php endif; ?>								

								<?php if (Kohana::config('settings.site_contact_page')): ?>
								<td>
									<a href="<?php echo url::site()."contact"; ?>"><?php echo Kohana::lang('ui_main.contact'); ?></a>
								</td>
								<?php endif; ?>

								<?php
								// Action::nav_main_bottom - Add items to the bottom links
								Event::run('ushahidi_action.nav_main_bottom');
								?>

								<!-- JP: Add the languages bar to the footer (since it's not up at the top of the theme). -->

								<td>
									<a id="languages"><?php echo $languages; ?></a>
								</td>

							</tr>
						</table>

						<?php if ($site_copyright_statement != ''): ?>
	      				<p><?php echo $site_copyright_statement; ?></p>
		      			<?php endif; ?>

					</div>
					<!-- / footer menu -->


				</div>
				<!-- / footer content -->

			</div>

		</div>

	</div>
	<!-- / footer -->

	<?php
	echo $footer_block;
	// Action::main_footer - Add items before the </body> tag
	Event::run('ushahidi_action.main_footer');
	?>
</body>
</html>
