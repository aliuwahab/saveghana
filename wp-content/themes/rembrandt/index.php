<?php get_header();?>
<div class="container" id="wrapper">
	<section id="content" class="eleven columns">
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
	} else { echo rembrandt_pagination();
	}
	?>
</div>
<?php get_footer();?>