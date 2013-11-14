<?php 
if (nimbus_get_option('image_logo') == "") { 
?>
    <h1 class="hidden-phone text_logo"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo nimbus_get_option('text_logo') ?></a></h1>
<?php 
} else { 
?> 	
    <a class="hidden-phone" href="<?php echo esc_url(home_url('/')); ?>"><img id="image_logo" src="<?php echo nimbus_get_option('image_logo'); ?>" alt="<?php echo get_bloginfo('name', 'display'); ?>" /></a>
<?php 
}
?>

