<?php	get_header();?>
<div class="container" id="wrapper">
	<section id="content" class="eleven columns">		
    <?php if (is_day()) : ?>
    <h1><?php printf(__('Daily Archives: <span>%s</span>', 'rembrandt'), get_the_date()); ?></h1>
    <?php elseif (is_month()) : ?>
    <h1><?php   printf(__('Monthly Archives: <span>%s</span>', 'rembrandt'), get_the_date('F Y')); ?></h1>
    <?php elseif (is_year()) : ?>
    <h1><?php   printf(__('Yearly Archives: <span>%s</span>', 'rembrandt'), get_the_date('Y')); ?></h1>
    <?php elseif (is_category()) : ?>  
    <h1><?php   printf(__('Categotry Archives: <span>%s</span>', 'rembrandt'), single_cat_title('', false)); ?></h1>
    <?php
        if (category_description())
            echo category_description();
 ?>
    <?php elseif (is_tag()) : ?>
    <h1><?php   printf(__('Tag Archives: <span>%s</span>', 'rembrandt'), single_tag_title('', false)); ?></h1>
    <?php
        if (tag_description())
            echo tag_description();
 ?> 
    <?php elseif ( is_tax() ) : ?>
    <h1><?php single_term_title(); ?></h1>
    <?php echo term_description('', get_query_var('taxonomy')); ?>
    <?php elseif ( is_author() ) : ?>
        <?php $user_id = get_query_var('author'); ?>
            <div id="author-info" class="vcard">    
                <h1 class="fn n"><?php the_author_meta('display_name', $user_id); ?></h1>                               
                <?php 
                if ( get_the_author_meta( 'description', $user_id  ) ) : ?>
                <?php echo get_avatar(get_the_author_meta('user_email', $user_id)); ?>  
                <p>
                    <?php the_author_meta('description', $user_id); ?>
                </p>
                <?php endif; ?>
            </div> 
    <?php elseif ( is_post_type_archive() ) : ?>
    <h1><?php post_type_archive_title(); ?></h1>    
    <?php elseif ( is_archive() ) : ?>
     <h1><?php _e('Archives', 'rembrandt'); ?></h1>
    <?php endif; ?>    

<?php rembrandt_breadcrumb(); ?>
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('loop', get_post_format());
            endwhile;
        else :
            get_template_part('loop', 'none');
        endif;
        ?>
	</section>
	<?php get_sidebar();?>
	<?php
	if (function_exists('wp_pagenavi')) { wp_pagenavi();
	} else {  rembrandt_pagination();
	}
	?>
</div>
<?php get_footer();?>
