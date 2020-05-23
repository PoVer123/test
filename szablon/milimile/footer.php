		</div>	
			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="wrap cf">

					<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>


				</div>
				<?php get_sidebar(); ?>

			</footer>

		
		<div class="social-media">
				<a href="mailto:kontakt@milimile.pl" id="mail">
					<!-- <img src="<?php echo get_template_directory_uri(); ?>/library/images/mail.svg" alt="mail icon"> -->
				</a>
				<a href="https://www.instagram.com/milimile.pl/" id="instagram">
					<!-- <img src="<?php echo get_template_directory_uri(); ?>/library/images/instagram.svg" alt="instagram icon"> -->
				</a>
				<a href="https://www.facebook.com/milimilepl/" id="facebook">
					<!-- <img src="<?php echo get_template_directory_uri(); ?>/library/images/facebook.svg" alt="facebook icon"> -->
				</a>
				<a href="search" id="search">
					<!-- <img src="<?php echo get_template_directory_uri(); ?>/library/images/search.svg" alt="search icon"> -->
				</a>
			</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
