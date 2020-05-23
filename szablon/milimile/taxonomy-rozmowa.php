<?php
/*
 * CUSTOM POST TYPE TAXONOMY TEMPLATE
 *
 * This is the custom post type taxonomy template. If you edit the custom taxonomy name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom taxonomy is called "register_taxonomy('shoes')",
 * then your template name should be taxonomy-shoes.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates#Displaying_Custom_Taxonomies
*/
?>

<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap cf">

		<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<h1 class="archive-title h2"><?php single_cat_title(); ?></h1>

			<?php

			
			$zmienna = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			
			$terms = get_term_children($zmienna->term_id, $zmienna->taxonomy);
			
			if ( $terms && !is_wp_error( $terms ) ) :
				?>
			<ul class="cat-views">
				<?php foreach ( $terms as $term ) { 
					
					$child = get_term_by( 'id', $term, $zmienna->taxonomy );?>
					<a href="<?php echo get_term_link($child->slug, $zmienna->taxonomy); ?>" id="<?php echo $child->slug;?>">
						<li>
							<div class="post-thumb">
								<?php  
								$image = get_field('cat_img', $child);
								$size = 'full'; // (thumbnail, medium, large, full or custom size)
								if( $image ) {
									echo wp_get_attachment_image( $image, $size );
								}
								?>
							</div>
							<p>
								<?php echo $child->name; ?>
							</p>
						</li>
					</a>
					<?php
					} ?>


</ul>
<?php endif;?>


</div>

</main>


</div>

</div>

<?php get_footer(); ?>
