<div id="sidebar">
	<ul>
		<?php bitLumen_special_index_type( $post ); ?>
		<?php if( !dynamic_sidebar( 'primary-sidebar' ) ) bitLumen_default_sidebar(); ?>
	</ul>
</div><!-- /#sidebar -->