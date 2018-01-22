<article id="post-<?php echo the_id(); ?>">

	<?php if(has_post_thumbnail()): ?>
	<div class="thumbnail">
				<?php the_post_thumbnail('thumbnail'); ?>
	</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title(sprintf('<h1 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h1>'); ?>
	</header>

</article>