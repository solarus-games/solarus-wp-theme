<?php if (count($summary) > 0):?>
    <?php echo $args['before_widget']; ?>
    <?php if ( $title ) {
        echo $args['before_title'] . $title . $args['after_title'];
    } ?>
    <ul>
        <?php $count = 0;?>
        <?php foreach($summary as $item):?>
            <li><a data-toggle="scroll-summary" data-target="<?php echo $count;?>" href="#" title="<?php echo $item;?>"><?php echo $item;?></a></li>
            <?php $count++;?>
        <?php endforeach;?>
    </ul>
    <?php echo $args['after_widget']; ?>
<?php endif;?>
