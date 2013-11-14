<aside id="sidebar" class="five columns">
	<?php	if ( is_active_sidebar( 'sidebar-widget-area-top' ) ) {
	?>
	<ul class="widget full">
		<?php dynamic_sidebar('sidebar-widget-area-top');?>
	</ul>
	<?php } else {?>
	<div class="widget full">
		<?php get_search_form();?>
	</div>
	<?php }?>

	<?php	if ( is_active_sidebar( 'sidebar-widget-area-full' ) ) {
	?>	
	<ul class="widget full">
		<?php dynamic_sidebar('sidebar-widget-area-full');?>
	</ul>
	<?php }?>

	<?php	if ( is_active_sidebar( 'sidebar-widget-area-bottom' ) ) {
	?>
	<ul class="widget">
		<?php dynamic_sidebar('sidebar-widget-area-bottom');?>
	</ul>
	<?php }?>
</aside>