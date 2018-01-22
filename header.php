<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title><?php bloginfo( 'name' ); ?><?php the_title(' | '); ?></title>
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<?php wp_head(); ?>
	</head>

	<?php
		if(is_front_page()){
			$custom_class = array('oof-class','my-class');
		}
		else{
			$custom_class = array('no-oof-class');
		}
	?>
	<body <?php body_class($custom_class); ?>>
	<div class="container">
  	<div class="row">
    <div class="navbar-header">
    <?php oof_site_branding(); ?>
    </div>

    <nav id="primary-nav" class="main-navigation" role="navigation">
    	<div class="container clearfix">
				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'         => '',
					'menu_id'	=> 'primary-menu',
					//'container_class'   => 'collapse navbar-collapse',
					//'container_id'      => 'bs-example-navbar-collapse-1',
					'fallback_cb'       => '',
					'menu_class' => 'sf-menu left',
					//'walker' => new Custom_Walker()
					));
				?>
	</div>
	</nav>
	</div> <!--row -->

	<div class="col-xs-10">
	<div class="search-form-container">
		<?php get_search_form(); ?>
	</div>
	</div>
