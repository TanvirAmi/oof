
	<footer>
		<p>This is my footer</p>
		<?php wp_nav_menu( array('theme_location' => 'secondary')); ?>

		// Display the data
	<?php
	echo '<p class="copyright">' . get_theme_mod('footer-text') . '</p>';
	?>
	</footer>
	</div> <!--container-->
	<?php wp_footer(); ?>

	</body>
</html>
