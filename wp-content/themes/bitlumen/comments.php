<?php if( !defined('ABSPATH')) exit; // deny direct access ?>

<?php if( post_password_required() ) : ?>
	<p class="no-comments">This post is password protected. Enter the password to view any comments.</p> 
<?php return; endif; ?>

<?php if( have_comments() ) : ?>
    <h6 id="comments">
		<?php printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number() ), get_comments_number(), '<span>' . get_the_title() . '</span>' ); ?>
    </h6>

    <?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div class="navigation">
        <div class="previous"><?php previous_comments_link( '&#8249; Older comments' ); ?></div><!-- end of .previous -->
        <div class="next"><?php next_comments_link( 'Newer comments &#8250;' ); ?></div><!-- end of .next -->
    </div><!-- end of.navigation -->
    <?php endif; ?>

    <ol class="commentlist">
        <?php wp_list_comments( 'avatar_size=60&type=comment' ); ?>
    </ol>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div class="navigation">
        <div class="previous"><?php previous_comments_link( '&#8249; Older comments' ); ?></div><!-- end of .previous -->
        <div class="next"><?php next_comments_link( 'Newer comments &#8250;' ); ?></div><!-- end of .next -->
    </div><!-- end of.navigation -->
    <?php endif; ?>

<?php else : ?>

<?php endif; ?>

<?php
if ( !empty( $comments_by_type['pings'] ) ) : // let's seperate pings/trackbacks from comments

    $count = count( $comments_by_type['pings'] );
	if( $count !== 1 ) 
		$txt = 'Pings&#47;Trackbacks';
?>

    <h6 id="pings"><?php echo $count . ' ' . $txt; ?>for &ldquo;<?php the_title(); ?>&rdquo;</h6>

    <ol class="commentlist">
        <?php wp_list_comments( 'type=pings&max_depth=<em>' ); ?>
    </ol>


<?php endif; ?>

<?php if( comments_open() ) : ?>

    <?php
    $fields = array(
        'author' => '<p class="comment-form-author">' . '<label for="author">' . 'Name' . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>',
		
        'email' => '<p class="comment-form-email">' . '<label for="email">' .'E-mail' . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" /></p>',
		
        'url' => '<p class="comment-form-url"><label for="url">' . 'Website' . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>' );

    $defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', $fields ) );

    comment_form( $defaults ); ?>

    <?php endif; ?>