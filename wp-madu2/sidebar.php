				<div id="sidebar1" class="sidebar right col300 last clearfix" role="complementary">
				
					<div class="info rounded7">
						

					<?php if ( is_active_sidebar( 'primary' ) ) : ?>

						<?php dynamic_sidebar( 'primary' ); ?>
						

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->
						
						<div class="help">
						
							<p>Please activate some Widgets.</p>
						
						</div>

					<?php endif; ?>
					</div><div class="clear">&nbsp;</div>

				</div>