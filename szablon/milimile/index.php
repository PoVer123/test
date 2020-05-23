<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">
						<ul class="rslides">
							  <?php 
							 $args = array( 'post_type' => array('miejsce', 'rozmowa', 'gadzet', 'gora'), 'posts_per_page' => 4, 'tag'=>'wyróżniony', 'orderby' => 'post_date',
									'order' => 'DESC' );
							  $loop = new WP_Query( $args );
							  if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>
							  		<li>
							  		
						            <div class="slide">
						            		<a href="<?php the_permalink();?>" class="image">
						            		<?php echo get_the_post_thumbnail($post->ID, 'full');?>
						            		<h1><?php echo the_title(); ?></h1>
						            		</a>
						            	</div>
						            </li>
						            <?php
							        endwhile;
							        endif;
								  ?>
							</ul>
						<main id="main" class="m-all t-2of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<h1 class="cat-title">Ostatnie posty</h1>
							<div class="latest-posts main-post-panel">
								
								<?php 
								$args = array( 'post_type' => array('miejsce', 'rozmowa', 'gadzet', 'gora'), 'posts_per_page' => 6, 'orderby' => 'post_date',
									'order' => 'DESC' );
								$loop = new WP_Query( $args );
								if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>

									
									<?php get_template_part( 'content', 'posttile' ); ?>
								<?php endwhile; ?>


								<?php else : ?>

										<div id="post-not-found" class="hentry cf">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
											
										</div>

								<?php endif; ?>
							</div>
							<h1 class="cat-title">Popularne posty</h1>
							<div class="featured-posts main-post-panel">
							
								<?php 
								$args = array( 'post_type' => array('miejsce', 'rozmowa', 'gadzet', 'gora'), 'posts_per_page' => 6, 'tag'=>'special', 'orderby' => 'post_date',
									'order' => 'DESC' );
								$loop = new WP_Query( $args );
								if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>

								<?php get_template_part( 'content', 'posttile' ); ?>

								<?php endwhile; ?>


								<?php else : ?>

										<div id="post-not-found" class="hentry cf">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
											
										</div>

								<?php endif; ?>
							</div>
							
						</main>

						<?php echo do_shortcode('[instagram-feed]');?>
				</div>

			</div>
<script>
  jQuery(function() {
    jQuery(".rslides").responsiveSlides({
    	pager: true
    });
  });
</script>

<?php get_footer(); ?>
