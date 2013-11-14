<?php
/**
 * Status Content Template
 *
 * Template used to show posts with the 'status' post format.
 *
 * @package Sukelius
 * @subpackage Template
 * @since 0.1.0
 */

do_atomic( 'before_entry' ); // sukelius_before_entry ?>

<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // sukelius_open_entry ?>
                      
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_avatar( get_the_author_meta( 'email' ) ); ?></a>		      
		      
                <div class="entry-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'sukelius-magazine' ), 'after' => '</p>' ) ); ?>
                </div><!-- .entry-content -->

        <?php if ( is_singular() )              
		 echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[post-format-link] by [entry-author] on [entry-published] [custom_comments before=" with "]  [entry-terms before="| Tagged "]', 'sukelius-magazine' ) . '</div>' );  
	else 
		echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[post-format-link] by [entry-author] on [entry-published] [custom_comments before=" with "] [entry-permalink before="| "]', 'sukelius-magazine' ) . '</div>' );
	?>

	<?php do_atomic( 'close_entry' ); // sukelius_close_entry ?>        

</div><!-- .hentry -->

<?php do_atomic( 'after_entry' ); // sukelius_after_entry ?>