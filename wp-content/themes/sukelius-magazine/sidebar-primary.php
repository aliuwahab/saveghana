<?php
/**
 * Primary Sidebar Template
 *
 * Displays widgets for the Primary dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package Sukelius
 * @subpackage Template
 */

if ( is_active_sidebar( 'primary' ) ) : ?>

	<?php do_atomic( 'before_sidebar_primary' ); // sukelius_before_sidebar_primary ?>

	<div id="sidebar-primary" class="sidebar">

		<?php do_atomic( 'open_sidebar_primary' ); // sukelius_open_sidebar_primary ?>

		<?php dynamic_sidebar( 'primary' ); ?>

		<?php do_atomic( 'close_sidebar_primary' ); // sukelius_close_sidebar_primary ?>

	</div><!-- #sidebar-primary .aside -->

	<?php do_atomic( 'after_sidebar_primary' ); // sukelius_after_sidebar_primary ?>

<?php endif; ?>