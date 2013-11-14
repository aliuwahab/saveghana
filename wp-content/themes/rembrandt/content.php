<?php if (have_posts()) : the_post();
?>
<section id="content" class="eleven columns">
    <?php rembrandt_breadcrumb(); ?>
    <article <?php post_class('post') ?>>
        <header>
            <?php  	the_title('<h1>', '</h1>'); ?>
            <?php
            if (comments_open() && !post_password_required()) :
                comments_popup_link(__('0', 'rembrandt'), __('1', 'rembrandt'), __('%', 'rembrandt'), 'post-comments', __('Comments are off for this post', 'rembrandt'));
            endif;
            ?>
            <?php  	rembrandt_posted_on(); ?>
        </header>
        <div class="post-content">
        <?php /******IMAGE**********/
            if (has_post_format('image')) {

                if (has_post_thumbnail())
                    the_post_thumbnail('large');
            } else {
                if (has_post_thumbnail()) {
                    the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
                }
            }
        ?>            
            <?php  	edit_post_link(__('Edit This', 'rembrandt')); ?>
            <?php  	the_content(__('Continue reading &rarr;', 'rembrandt')); ?>
        </div>
        <footer>
            <?php  	wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'rembrandt'), 'after' => '</div>')); ?>
            <?php   rembrandt_posted_footer(); ?>
            <?php  	rembrandt_author_info(); ?>
        </footer>
    </article>
    <?php comments_template('', true); ?>
</section>
<?php  endif; ?>
<?php get_sidebar(); ?>