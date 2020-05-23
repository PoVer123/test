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
					<!-- <h1 class="archive-title"><?php //single_cat_title() ;?></h1> -->
					<div id="map">
						<?php
						$zmienna = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
						$term = get_term_by('id', $zmienna->term_id, $zmienna->taxonomy);
				
						?>
					</div>
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
								    <ul class="cat-icons" id="<?php echo $zmienna->slug;?>">
								    	<a href="<?php echo get_term_link('z-dzieckiem', $taxonomy); ?>" id="<?php echo 'z-dzieckiem';?>">
								            <li>
								            <div class="tax-img">
								            <img src="<?php echo get_template_directory_uri(); ?>/library/images/icons/<?php echo 'z-dzieckiem';?>.png" alt="<?php echo 'Z dzieckiem'; ?>">
								            </div>
								            <?php echo 'Z dzieckiem'; ?>
								            </li>
								            </a>
								            <a href="<?php echo get_term_link('we-dwoje', $taxonomy); ?>" id="<?php echo 'we-dwoje';?>">
								            <li>
								            <div class="tax-img">
								            <img src="<?php echo get_template_directory_uri(); ?>/library/images/icons/<?php echo 'we-dwoje';?>.png" alt="<?php echo 'We dwoje'; ?>">
								            </div>
								            <?php echo 'We dwoje'; ?>
								            </li>
								            </a>
								        <?php foreach ( $terms as $term ) { 
								        	if (strcasecmp($term->slug, 'we-dwoje')&&strcasecmp($term->slug, 'z-dzieckiem')) {

								        	?>
								           
								            <a href="<?php echo get_term_link($term->slug, $taxonomy); ?>" id="<?php echo $term->slug;?>">
								            <li>
								            <div class="tax-img">
								            <img src="<?php echo get_template_directory_uri(); ?>/library/images/icons/<?php echo $term->slug;?>.png" alt="<?php echo $term->name; ?>">
								            </div>
								            <?php echo $term->name; ?>
								            </li>
								            
								            </a>
								        <?php }
								        } ?>
								         
								         <a href="wszystkie" id="wszystkie" class="allofthem">
								            <li>
								            <div class="tax-img">
								            <img src="<?php echo get_template_directory_uri(); ?>/library/images/icons/wszystkie.png" alt="Wszystkie">
								            Wszystkie
								            </div>
								            
								            </li>
								         </a>

								    </ul>
								    
								<?php endif;?>

								 
								</div>
								<button class="dosearch">Szukaj</button>
							</div>
							<div id="post-results" class="post-listing"></div>
						</main>


				</div>

			</div>

<?php get_footer(); ?>
