<?php get_header();?>
<div id="page" class="container">
	<div class="col-lg-12">
		<?php while ( have_posts() ) : the_post();?>
			<h1 class="page-title"><?php echo Core::get_title();?></h1>
			<article>
				<div class="page-body">
					<div class="page-content">
						<?php echo Core::get_content();?>
					</div>
				</div>
			</article>
		<?php endwhile;?>
	</div>
</div>
<?php get_footer();?>

