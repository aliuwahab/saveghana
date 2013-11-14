<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package StrapVert
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( get_theme_mod( 'strapvert_page_title_visibility' ) != 1 ) { ?>
	    <header class="entry-header">
		    <h1 class="entry-title"><?php the_title(); ?></h1>
	    </header><!-- .entry-header -->
    <?php } ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'strapvert' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'strapvert' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
