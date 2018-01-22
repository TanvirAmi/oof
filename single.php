<?php get_header(); ?>
<div class="row">
	<div class="col-xs-12 col-sm-8">
		<?php
		if( have_posts() ) :
			while( have_posts() ): the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_title('<h1 class="entry-title">','</h1>'); ?>
				<small><?php the_category(' '); ?></small>
				<?php if(has_post_thumbnail()): ?>
				<div class="pull-right">
					<?php the_post_thumbnail('thumbnail'); ?>
				</div>
			<?php endif; ?>
			<?php the_content(); ?>

			<div class="row">
				<div class="col-xs-6 text-left">
					<?php previous_post_link(); ?>
				</div>
				<div class="col-xs-6 text-right">
					<?php next_post_link(); ?>
				</div>
			</div>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

			</article>

			<?php
			endwhile;
		endif;
		?>
</div>

	<div class="col-xs-12 col-sm-4">
		<?php get_sidebar(); ?>
	</div>

</div>
<?php get_footer(); ?>
