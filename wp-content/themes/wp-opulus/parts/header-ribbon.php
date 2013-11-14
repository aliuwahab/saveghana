<div id="ribbon_wrap">
    <div class="row">
        <div id="ribbon" class="span12 center none">	
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <h1 class="text_logo"><a href="<?php echo get_home_url(); ?>"><?php echo nimbus_get_option('text_logo') ?></a></h1>
                        <a class="btn btn-navbar" data-toggle="collapse" data-target="#mobile_menu">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="clear"></div>
                        <?php 
                        wp_nav_menu(array('theme_location' => 'mobile', 'menu' => 'Primary Menu', 'depth' => 3, 'menu_class' => 'collapse', 'menu_id' => 'mobile_menu', 'container' => false)); 
                        ?>
                    </div>
                </div>
            </div>
            <?php 
            get_template_part('parts/logo');
            wp_nav_menu(array('theme_location' => 'primary', 'menu' => 'Primary Menu', 'depth' => 3, 'menu_id' => 'menu', 'container' => 'div', 'container_class' => 'menu' )); 
            ?>
        </div>
    </div>
</div>