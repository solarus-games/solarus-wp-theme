<p class="post-attributes-label-wrapper">
    <label class="post-attributes-label" for="game_id"><?php echo __('Jeu', 'zf');?></label>
</p>
<select name="game_id">
    <option value="0"><?php echo __('Aucun', 'zf');?></option>
    <?php foreach ($games as $game):?>
        <option value="<?php echo $game->ID;?>"<?php if ($currentGame == $game->ID):?> selected="selected"<?php endif;?>"><?php echo $game->post_title;?></option>
    <?php endforeach;?>
</select>