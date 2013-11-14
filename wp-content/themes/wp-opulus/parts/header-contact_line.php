<div id="contact_line_wrapper" class="row" >
    <div id="contact_line"  class="span12 center none">
        <?php 
        if ((nimbus_get_option('public_email') || nimbus_get_option('public_phone') || nimbus_get_option('public_fax')) != "") { 
        ?>
        <div>
            <ul>
                <?php 
                if (nimbus_get_option('public_email') != "") { 
                ?>
                    <li><a href="mailto:<?php echo nimbus_get_option('public_email') ?>"><?php echo nimbus_get_option('public_email') ?></a></li> 
                <?php 
                } 
                if (nimbus_get_option('public_fax') != "") { 
                ?>
                    <li>Fax <span><?php echo nimbus_get_option('public_fax') ?></span></li>
                <?php 
                }  
                if (nimbus_get_option('public_phone') != "") { 
                ?>
                    <li>Call us! <span><?php echo nimbus_get_option('public_phone') ?></span></li>
                <?php 
                } 
                ?>				
            </ul>
            <div class="clear"></div>
        </div>
        <?php 
        } 
        ?>
    </div>
</div>