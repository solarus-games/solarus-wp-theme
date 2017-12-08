<div class="shortcode shortcode-paypal">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="business"
               value="<?php echo $atts['email'];?>">
        <input type="hidden" name="cmd" value="_donations">
        <input type="hidden" name="item_name" value="<?php echo $atts['name'];?>">
        <input type="hidden" name="item_number" value="Fall Cleanup Campaign">
        <input type="hidden" name="currency_code" value="<?php echo $atts['currency'];?>">
        <button type="submit" class="btn btn-default"><?php echo __("Donate", "solarus");?></button>
        <img alt="" width="1" height="1"
             src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

    </form>
</div>