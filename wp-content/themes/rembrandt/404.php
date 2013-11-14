<?php get_header();?>
<div class="container">
	<section class="sixteen columns error">
		<article>
			<h1><?php _e('Error 404 - Not Found', 'rembrandt');?></h1>	
		<p>
			<?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'rembrandt');?>
		</p>
		<?php get_search_form(); ?> 
		</article>
	</section>
</div>
<?php wp_footer();?>
</body>
</html>