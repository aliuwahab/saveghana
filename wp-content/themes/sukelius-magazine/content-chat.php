<?php
/**
 * Chat Content Template
 *
 * Template used to show chat post format.
 *
 * @package Sukelius
 * @subpackage Template
 * @since 0.1.0
 */

do_atomic( 'before_entry' ); // sukelius_before_entry ?>

<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // sukelius_open_entry ?>

        <?php if ( is_singular() ) { ?>        

		<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
                       
                <div class="entry-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'sukelius-magazine' ), 'after' => '</p>' ) ); ?>
                </div><!-- .entry-content -->
        
		<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[post-format-link] posted on [entry-published] by [entry-author]', 'sukelius-magazine' ) . '</div>' ); ?>

        <?php } else { ?>

                <?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
                
                <?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'size' => 'large', 'width' => 610, 'height' => 202, 'image_class' => 'aligncenter') ); ?>
        
                <div class="entry-content">
                        <?php the_excerpt();  ?>
                        <?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'sukelius-magazine' ), 'after' => '</p>' ) ); ?>
                </div><!-- .entry-content -->
        
		<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[post-format-link] posted on [entry-published] by [entry-author]', 'sukelius-magazine' ) . '</div>' ); ?>

        <?php } ?>

	<?php do_atomic( 'close_entry' ); // sukelius_close_entry ?>        

</div><!-- .hentry -->

<?php do_atomic( 'after_entry' ); // sukelius_after_entry ?>