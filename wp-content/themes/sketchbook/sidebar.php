<aside id="sidebar" class="grid_5">
	<?php if ( is_active_sidebar( 'page-widget' ) && is_page() ) :
	?>
	<ul class="widget widget_bottom">
		<?php  dynamic_sidebar('page-widget');?>
	</ul>
	<?php   else :?>
	<?php	if ( is_active_sidebar( 'sidebar-widget-area-top' ) ) {
	?>
	<ul class="widget widget_top">
		<?php  dynamic_sidebar('sidebar-widget-area-top');?>
	</ul>
	<?php  } else {?>
	<ul class="widget widget_top">
		<li id="no_bg">
			<?php  get_search_form();?>
		</li>
	</ul>
	<?php  }?>
	<?php	if ( is_active_sidebar( 'sidebar-widget-area-full' ) ) {
	?>
	<ul  class="widget widget_bottom">
		<?php  dynamic_sidebar('sidebar-widget-area-full');?>
	</ul>
	<?php  } else {?>
	<ul class="widget widget_bottom">
		<li>
			<h3><?php  _e('Categories', 'sketchbook');?></h3>
			<ul class="widget_categories">
				<?php wp_list_categories('show_count=1&title_li=&show_last_update=1&use_desc_for_title=1');?>
			</ul>
		</li>
	</ul>
	<?php }
endif;
	?>
	<div class="clear"></div>
</aside>