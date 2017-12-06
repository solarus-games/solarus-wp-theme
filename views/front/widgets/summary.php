<ul>
    <?php $count = 0;?>
    <?php foreach($summary as $item):?>
        <li><a data-toggle="scroll-summary" data-target="<?php echo $count;?>" href="#" title="<?php echo $item;?>"><?php echo $item;?></a></li>
        <?php $count++;?>
    <?php endforeach;?>
</ul>