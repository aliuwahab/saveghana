<?php
	/**
	 * The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'footer-showcase1'  )
		&& ! is_active_sidebar( 'footer-showcase2' )
		&& ! is_active_sidebar( 'footer-showcase3'  )
		&& ! is_active_sidebar( 'footer-showcase4'  )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>
<div id="supplementary" <?php strapvert_footer_sidebar_class(); ?>>
	<?php if ( is_active_sidebar( 'footer-showcase1' ) ) : ?>
	<div id="first" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-showcase1' ); ?>
	</div><!-- #first .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-showcase2' ) ) : ?>
	<div id="second" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-showcase2' ); ?>
	</div><!-- #second .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-showcase3' ) ) : ?>
	<div id="third" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-showcase3' ); ?>
	</div><!-- #third .widget-area -->
	<?php endif; ?>
	
	<?php if ( is_active_sidebar( 'footer-showcase4' ) ) : ?>
	<div id="fourth" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-showcase4' ); ?>
	</div><!-- #third .widget-area -->
	<?php endif; ?>
</div><!-- #supplementary -->