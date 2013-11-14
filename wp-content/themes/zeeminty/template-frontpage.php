<?php
/*
Template Name: Frontpage Template
*/
?>
<?php get_header('frontpage'); ?>

<?php $options = get_option('zeeminty_options'); // Get Theme Options from Database ?>

	<div id="wrap" class="container template-frontpage">
	
	<?php // Display Frontpage Intro text
	if(isset($options['themeZee_frontpage_intro_text']) and $options['themeZee_frontpage_intro_text'] != '' ) : ?>
		<div id="frontpage-intro" class="clearfix">
			<p class="frontpage-intro-text"><?php echo do_shortcode(wp_kses_post($options['themeZee_frontpage_intro_text'])); ?></p>
		</div>
	<?php endif; ?>
	
	<?php // Display Frontpage Widgets #1
	if(is_active_sidebar('frontpage-widgets-one')) : ?>
		<div id="frontpage-widgets-one" class="frontpage-widgets clearfix">
			<?php dynamic_sidebar('frontpage-widgets-one'); ?>
		</div>
	<?php endif; ?>
	
	</div>
	
<?php get_footer(); ?>	