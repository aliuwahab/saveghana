<?php
    $post_meta = nimbus_get_option('nimbus_post_meta_single');
?>

<div class="row">
    <div id="sub_title" class="span12 center none">
        <?php 
        $post_meta = nimbus_get_option('nimbus_post_meta_single');
        if (is_page()) { 
        ?>
            <h1>
            <?php  
            $title = single_post_title('',false);
            if (strlen($title) == 0) { 
                ?>Post ID <?php the_ID(); 
            } else { 
                single_post_title();
            }                              
            ?>
                </h1>
        <?php 
        } else if (is_single()) {  
            if ($post_meta['title'] == 1) { 
            ?>
                <h1>
                <?php  
                $title = single_post_title('',false);
                if (strlen($title) == 0) { 
                    ?>Post ID <?php the_ID(); 
                } else { 
                    single_post_title();
                }                              
                ?>
                </h1>
            <?php 
            }  
        } else if (is_home()) { 
        ?>    
            <h1><?php echo nimbus_get_option('blog_title') ?></h1>
        <?php 
        } else if (is_author()) { 
            $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));?> 
            <h1>Posts By: <?php echo $curauth->display_name; ?></h1>
        <?php 
        } else if (is_post_type_archive()) { 
        ?> 
            <h1><?php echo nimbus_get_option('portfolio_title') ?></h1>
        <?php 
        } else if (is_404()) { 
        ?>
            <h1>404</h1>
        <?php 
        } else if (is_archive()){ 
        ?>  
            <h1><?php single_cat_title(__( 'Currently Viewing: ', 'nimbus')); ?></h1>
        <?php 
        } 
        ?> 
    </div>    
</div>
