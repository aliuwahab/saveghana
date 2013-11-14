<?php $do_not_duplicate = array(); ?>
<?php $featured_posts = strapvert_get_featured_posts(); ?>
<?php if ( $featured_posts->have_posts() ) : $featured_posts->the_post(); ?>
<?php if ( get_theme_mod( 'strapvert_top_featured_visibility' ) != 1 ) { ?>
<div class="featured-content">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'strapvert-featured' ); ?></a>
		</div>
		<?php endif; ?>

		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'strapvert' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php echo strapvert_featured_excerpt(); ?>
			<div class="sticky-read-more btn btn-success">
		       <a href="<?php the_permalink(); ?>">Read More &raquo;</a>
		    </div>
		</div><!-- .entry-summary -->

	</article>

</div><!-- .featured-content -->
<?php } ?>

<?php if ( $featured_posts->have_posts() ) : // more than one? ?>
<?php if ( get_theme_mod( 'strapvert_secondary_featured_visibility' ) != 1 ) { ?>
<div class="featured-content-secondary">
	<?php while ( $featured_posts->have_posts() ) : $featured_posts->the_post(); $do_not_duplicate[] = get_the_ID(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			</div>
			<?php endif; ?>

			<header class="entry-header">
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'strapvert' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php echo strapvert_secondary_featured_excerpt(); ?>
			</div><!-- .entry-summary -->
		</article>

	<?php endwhile; ?>
	
</div><!-- .featured-content-secondary -->
<?php } ?>

<?php endif; // have_posts() inner ?>
<?php endif; // have_posts() ?>
