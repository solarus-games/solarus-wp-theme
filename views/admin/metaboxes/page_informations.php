<p class="post-attributes-label-wrapper">
    <label class="post-attributes-label" for="game_id"><?php echo __('Sidebar', 'zf');?></label>
</p>
<select name="sidebar">
    <option value="0"><?php echo __('Aucun', 'zf');?></option>
    <?php foreach ($sidebars as $sidebar):?>
        <option value="<?php echo $sidebar['id'];?>"<?php if ($currentSidebar == $sidebar['id']):?> selected="selected"<?php endif;?>"><?php echo $sidebar['name'];?></option>
    <?php endforeach;?>
</select>