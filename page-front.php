<?php get_header(); ?>

<div class="row">
		<?php home_featured_slider(); ?>
</div><!-- end row -->

	<div class="row">

	<div class="col-xs-12 col-sm-8">
		<?php
		if( have_posts() ) :
			while( have_posts() ): the_post(); ?>
			<?php get_template_part('content', get_post_format()); ?>
			<?php
			endwhile;
		endif;

		//Print other 2 posts not the first one
		$args = array(
				'type' => 'post',
				'posts_per_page' => 2,
				'offset' => 1,
			);
		$y = new WP_Query($args);
				if( $y->have_posts() ) :
				while( $y->have_posts() ): $y->the_post(); ?>
				<?php get_template_part('content', get_post_format()); ?>
				<?php
				endwhile;
			endif;
			wp_reset_postdata();
		?>
	</div>

	<div class="col-xs-12 col-sm-4">
		<?php get_sidebar(); ?>
	</div>

</div>
<?php get_footer(); ?>
