<h1><?php echo __("Réglages Solarus", "solarus");?></h1>
<?php if ($update):?>
    <div class="updated settings-error notice is-dismissible">
        <p><strong><?php echo __("Options solarus mises à jour.", 'solarus');?></strong></p>
        <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
    </div>
<?php endif;?>
<form method="post">
    <input type="hidden" name="action" value="update">
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><label for="solarus_path_data"><?php echo __("Chemin vers les fichiers");?></label></th>
                <td><input name="solarus_path_data" type="text" id="solarus_path_data" value="<?php echo $solarus_path_data;?>" class="regular-text"></td>
            </tr>
        </tbody>
    </table>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo __("Sauvegarder", "solarus");?>"></p>
</form>