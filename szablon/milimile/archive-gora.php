<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap cf">

		<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

<?php
      //dodane UPDATE
			the_archive_title( '<h1 class="archive-title">', '</h1>' );
?>
      
			<div id="post-results">
				<?php
				$taxonomy = 'typ-gory';
				$terms = get_terms(array('taxonomy'=>$taxonomy, 'orderby' =>'term_order')); // Get all terms of a taxonomy


				if ( $terms && !is_wp_error( $terms ) ) :
					?>
				<ul class="cat-views">
					<?php foreach ( $terms as $term ) { 

						//$child = get_term_by( 'id', $term, $taxonomy );
						$child = $term;
						?>

						<a href="<?php echo get_term_link($child->slug, $taxonomy); ?>" id="<?php echo $child->slug;?>">
							<li>
								<div class="post-thumb element" >
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
