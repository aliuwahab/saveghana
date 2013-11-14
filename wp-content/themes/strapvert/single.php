<?php
/**
 * The Template for displaying all single posts.
 *
 * @package StrapVert
 */

get_header(); ?>

<div class="container">
	<div class="row" role="main">
    <?php if ( get_theme_mod( 'strapvert_layout' ) != 0 ) { ?>	
    <div class="span4">
        <?php get_sidebar(); ?>
    </div>
    <div class="span8">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>
            <?php get_template_part( 'related-content' ); ?>
			<?php strapvert_content_nav( 'nav-below' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>
        </div>
	    	
		
<?php } else { ?>

    <div class="span8">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>
            <?php get_template_part( 'related-content' ); ?>
			<?php strapvert_content_nav( 'nav-below' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>
        </div>
	    <div class="span4">
            <?php get_sidebar(); ?>
        </div>	

<?php } ?>	
		
	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>