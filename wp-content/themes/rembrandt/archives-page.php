<?php
/**
 * Template Name: Archives Template
 **/
?>

<?php get_header();?>
<div class="container" id="wrapper">
	<section class="eleven columns">
		<?php if (have_posts())  : the_post();
		?>
		<article <?php post_class('post') ?>>
			<header>
				<?php the_title('<h1 class="title">', '</h1>');?>
			</header>
            <div class="post-content">
                <ul>
    <?php
$sticky = get_option( 'sticky_posts' );
$day_check = '';
$args = array('posts_per_page' => 656, 'post__not_in' => $sticky );
query_posts($args);
while (have_posts()) : the_post();
  $day = get_the_date('m');
  if ($day != $day_check) {
    if ($day_check != '') {
      echo '</ul></li>'; 
    }
    echo '<li>'. get_the_date('F Y') . '<ul>';
  }
?>
<li><a href="<?php the_permalink() ?>"><?php echo get_the_date(); ?> - <i><?php the_title(); ?></i></a></li>
<?php
$day_check = $day;
endwhile; ?>
                </ul>
            </div>
		</article>
		<?php comments_template();?>
		<?php endif;?>
	</section>
	<?php get_sidebar();?>
</div>
<?php get_footer();?>
