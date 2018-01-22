<?php
/*
	Template Name: Portfolio template
*/
?>
<?php get_header(); ?>
<?php get_header(); ?>

		<?php 
		$args = array('post_type' => 'portfolio', 'posts_per_page' => 4);
		$query = new WP_Query($args);

		if ( $query->have_posts() ) : ?>


				<?php /* Start the Loop */ ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>

					<?php get_template_part('content', 'archive'); ?>

				<?php endwhile; ?>


		<?php endif; ?>

<?php get_footer(); ?>