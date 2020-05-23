<?php
/*
 * CUSTOM POST TYPE ARCHIVE TEMPLATE
 *
 * This is the custom post type archive template. If you edit the custom post type name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is called "register_post_type( 'bookmarks')",
 * then your template name should be archive-bookmarks.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

					<div id="filters">
						<div class="filter-head">
							<h2>Dokąd chcesz pojechać?</h2>	
							<h2>Rozwiń filtry</h2>
						</div>
						<div class="filter-box">						
						<?php

								$taxonomy = 'typ-podrozy';
								$terms = get_terms($taxonomy); // Get all terms of a taxonomy

								if ( $terms && !is_wp_error( $terms ) ) :
								?>
								    <ul class="cat-icons">
								        <?php foreach ( $terms as $term ) { ?>
								            
								            <a href="<?php echo get_term_link($term->slug, $taxonomy); ?>" id="<?php echo $term->slug;?>">
								            <li>
								            <img src="<?php echo get_template_directory_uri(); ?>/library/images/icons/<?php echo $term->slug;?>.png" alt="<?php echo $term->name; ?>">
								            <?php echo $term->name; ?>
								            	
								            
								            </li>
								            </a>
								        <?php } ?>
								         <a href="wszystkie" id="wszystkie" class="allofthem">
								            <li>
								            <img src="<?php echo get_template_directory_uri(); ?>/library/images/icons/wszystkie.png" alt="Wszystkie">
								            Wszystkie
								            	
								            
								            </li>
								         </a>

								    </ul>
								<?php endif;?>

								 
								</div>
							</div>
							<div id="post-results"></div>
						</main>


				</div>

			</div>

<?php get_footer(); ?>
