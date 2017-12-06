<?php get_header();?>
<?php $sidebar = Core::get_post_meta('_sidebar', $post->ID);?>
<div id="page" class="container">
	<div class="<?php if ($sidebar):?>col-lg-9<?php else:?>col-lg-12<?php endif;?>">
		<?php while ( have_posts() ) : the_post();?>
			<h1 class="page-title"><?php echo Core::get_title();?></h1>
			<article>
				<div class="page-body">
					<div id="page-content" class="page-content">
						<?php echo Core::get_content();?>
					</div>
				</div>
			</article>
		<?php endwhile;?>
	</div>
	<?php if ($sidebar):?>
		<div class="col-lg-3">
			<div id="sidebar">
				<ul>
					<?php dynamic_sidebar($sidebar);?>
				</ul>
			</div>
		</div>
	<?php endif;?>
</div>
<?php get_footer();?>

