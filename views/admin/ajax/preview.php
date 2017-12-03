<?php if ($file == false):?>
    <div><?php echo __("Impossible de prévisualiser car le fichier lié à ce post n'existe pas.", "solarus");?></div>
<?php else:?>
    <h1><?php echo __("Titre : ", "solarus");?></h1>
    <?php echo $title;?>
    <h1><?php echo __("Contenu : ", "solarus");?></h1>
    <?php echo $content;?>

<?php endif;?>
