<?php
/***********FLICKR**********/
     class rembrandt_flickr_widget extends WP_Widget {
     function rembrandt_flickr_widget() {
     $widget_ops = array( 'description' => __('Flickr gallery','rembrandt') );
     $this->WP_Widget('', 'Flickr', $widget_ops);
     $this->flick_numbers = array(
            "3" => "3",
            "4" => "4",
            "6" => "6",
            "8" => "8",
            "9" => "9",
            "10" => "10",

        );
     }
      
     function widget($args, $instance) {
     extract($args, EXTR_SKIP);
      
     $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
     $idflickr = empty($instance['idflickr']) ? ' ' : apply_filters('widget_entry_title', $instance['idflickr']);
     $numberflickr = $instance['numberflickr'];

     echo $before_widget;
     if ( $title ) echo $before_title . $title . $after_title; 
       
     echo '<div id="flickr"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$numberflickr.'&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$idflickr.'"></script><div class="clear"></div></div>';
     echo $after_widget;
     }
      
     function update($new_instance, $old_instance) {
     $instance = $old_instance;
     $instance['title'] = strip_tags($new_instance['title']);
     $instance['idflickr'] = strip_tags($new_instance['idflickr']);
     $instance['numberflickr'] =$new_instance['numberflickr'];
      
     return $instance;
     }
      
     function form($instance) {
     $instance = wp_parse_args( (array) $instance, array( 'title' => 'Flickr', 'idflickr' => '', 'numberflickr' => '6' ) );
     $title = strip_tags($instance['title']);
     $idflickr = strip_tags($instance['idflickr']);
     $numberflickr = $instance['numberflickr'];

?>
<p>
	<label for="<?php echo $this -> get_field_id('title');?>"> <?php _e('Title:', 'rembrandt');?><input class="widefat" id="<?php echo $this -> get_field_id('title');?>" name="<?php echo $this -> get_field_name('title');?>" type="text" value="<?php echo esc_attr($title);?>" /></label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('idflickr');?>">
				<?php	printf(__('"Flickr"- ID. <a href="%s" target="_blank">idgettr.com</a>', 'rembrandt'), sprintf(esc_url(__('http://idgettr.com/', 'rembrandt'))));?>
		
		<input class="widefat" id="<?php echo $this -> get_field_id('idflickr');?>" name="<?php echo $this -> get_field_name('idflickr');?>" type="text" value="<?php echo esc_attr($idflickr);?>" /></label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('numberflickr');?>"><?php _e('Number of photo to display:', 'rembrandt');?></label>
	<select name="<?php echo $this -> get_field_name('numberflickr');?>" id="<?php echo $this -> get_field_id('numberflickr');?>" class="widefat">
		<?php foreach ($this->flick_numbers as $key => $nmb) {
		?>
		<option value="<?php echo $key;?>" <?php
		if($instance['numberflickr'] == $key) { echo " selected ";
		}
		?>><?php echo $nmb;?></option>
		<?php }?>
	</select>
</p>
<?php
}
}
register_widget('rembrandt_flickr_widget');
?>
