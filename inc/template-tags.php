<?php
//Fetch list of all tags
function oof_tags_list() {
	// Set up empty array.
	$tags = array();
	// Retrieve available tags.
	$tags_obj = get_tags();
	// Set default/empty tag.
	$tags[''] = esc_html__( 'Select a tag &hellip;', 'oof' );
	// Display the tags.
	foreach ( $tags_obj as $tag ) {
		$tags[$tag->term_id] = esc_attr( $tag->name );
	}
	return $tags;
}

//Site logo
function oof_site_branding() {
	// Get the customizer value.
	$logo_id  = get_theme_mod('logo');
	// Check if logo available, then display it.
	if ( $logo_id ) :
		echo '<div id="logo" itemscope itemtype="http://schema.org/Brand">' . "\n";
			echo '<a class="site-logo" href="' . esc_url( get_home_url() ) . '" itemprop="url" rel="home">' . "\n";
				echo '<img itemprop="logo" src="' . esc_url( wp_get_attachment_url( $logo_id ) ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
			echo '</a>' . "\n";
		echo '</div>' . "\n";

	// If not, then display the Site Title and Site Description.
	else :
		echo '<h1 class="site-title"><a href="' . esc_url( get_home_url() ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a></h1>';
		echo '<h2 class="site-description">' . esc_attr( get_bloginfo( 'description' ) ) . '</h2>';
	endif;
}

if ( ! function_exists( 'oof_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since  1.0.0
 */
function oof_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'gomedia' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'gomedia' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">

			<?php echo get_avatar( $comment, 60 ); ?>

			<div class="comment-des">



				<div class="comment-by">
					<p class="author"><strong><?php echo get_comment_author_link(); ?></strong></p>
					<?php
						printf( '<p class="date"><a href="%1$s"><time datetime="%2$s">%3$s</time></a></p>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'gomedia' ), get_comment_date(), get_comment_time() )
						);
					?>
					<span class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'gomedia' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</span><!-- .reply -->
				</div><!-- .comment-by -->

				<section class="comment-content comment">
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'gomedia' ); ?></p>
					<?php endif; ?>
					<?php comment_text(); ?>
					<?php edit_comment_link( __( 'Edit', 'gomedia' ), '<p class="edit-link">', '</p>' ); ?>
				</section><!-- .comment-content -->

			</div><!-- .comment-des -->

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;



//home featured slider
function home_featured_slider(){?>

	<div class="col-xs-12">
	<div id="oof-carousel" class="carousel slide" data-ride="carousel">

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">

			<?php
			$enable = get_theme_mod('featured-enable');
			$tag = get_theme_mod('featured-tag');
			// Disable the posts slider by user selected in the customizer
			if ( !$enable ) {
				return;
			}
			$args = array(
				'type' => 'post',
				'posts_per_page' => 3,
			);
			// Include the tag.
			if ( $tag ) {
				$args['tag_id'] = absint( $tag );
			}
			$x = new WP_Query($args);
			if( $x->have_posts() ) :

				$count = 0;
				$bullets = '';
				while( $x->have_posts() ): $x->the_post(); ?>

			<?php //get_template_part('content','featured'); ?>

				<div class="item <?php if($count == 0): echo 'active'; endif; ?>">
						<?php the_post_thumbnail('full'); ?>
						<div class="carousel-caption">
							<?php the_title(sprintf('<h1 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h1>'); ?>
							<small><?php the_category(); ?></small>
						</div>
				</div>

					<?php
					if($count ==0):
						$bullets .= '<li data-target="#oof-carousel" data-slide-to="'.$count.'" class="active"></li>';
					else:
						$bullets .= '<li data-target="#oof-carousel" data-slide-to="'.$count.'"></li>';
					endif;
					?>

			<?php
			$count++;
			endwhile;
			endif;
			wp_reset_postdata();
		?>

		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php echo $bullets; ?>
		</ol>

		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#oof-carousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#oof-carousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	</div> <!-- col-xs-12 -->

<?php
}
