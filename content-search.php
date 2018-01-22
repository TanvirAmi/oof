<article id="post-<?php echo the_id(); ?>">

	<header class="entry-header">
		<?php the_title(sprintf('<h1 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h1>'); ?>
	</header>

	<div class="row">
		<?php if( has_post_thumbnail() ): ?>
		<div class="col-xs-12 col-sm-4">
			<div class="entry-thumbnail">
				<?php the_post_thumbnail('thumbnail'); ?>
			</div>
		</div>

		<div class="col-xs-12 col-sm-8">
				<?php the_excerpt(); ?>
		</div>
		<?php else: ?>
		<div class="col-xs-12">
				<?php the_excerpt(); ?>
		</div>
		<?php endif; ?>
	</div>

</article>