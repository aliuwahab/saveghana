<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package StrapVert
 */
?>

	</div><!-- #main -->
<div class="container">
	<footer id="colophon"  class="site-footer" role="contentinfo">
	    <?php get_sidebar( 'footer' ); ?>
		<div class="site-info">
			<?php do_action( 'strapvert_credits' ); ?>
			<p class="strapvert-scroll-top"><a href="#scroll-top" class="top">Return to the top</a></p>
            <p class="strapvert-copyright"><?php echo 'Copyright &copy; ' . date( 'Y' ); ?> <?php bloginfo( 'name' ); ?></p>
		    <p class="strapvert-powered-by"><a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'strapvert' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'strapvert' ), 'WordPress' ); ?></a>
		    <span class="sep"> | </span>
		    <?php printf( __( 'Theme: %1$s by %2$s.', 'strapvert' ), 'StrapVert', '<a href="http://www.wpstrapcode.com/" rel="designer">WP Strap Code</a>' ); ?></p>
	    </div><!-- .site-info -->
	</footer><!-- #colophon -->
	
</div>
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>