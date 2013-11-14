<?php
/**
 * @subpackage StrapVert
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php strapvert_entry_meta(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_home() || is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
	    <?php if (has_post_thumbnail()) { ?>
		<div class="summary-thumbnail">
		   <a href="<?php the_permalink(); ?>">
			 <?php the_post_thumbnail( ); ?>
		   </a>	
	    </div>
		<?php } ?>
		<?php the_excerpt(); ?>
		<div class="read-more btn btn-success">
		   <a href="<?php the_permalink(); ?>">Read More &raquo;</a>
		</div>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
	    <?php get_template_part("strapvert-thumbs"); ?>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'strapvert' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'strapvert' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'strapvert' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'This Post Is Tagged %1$s', 'strapvert' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'strapvert' ), __( '1 Comment', 'strapvert' ), __( '% Comments', 'strapvert' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'strapvert' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	
</article><!-- #post-## -->
