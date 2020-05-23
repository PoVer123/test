<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">
 
					<div class="background"><?php the_post_thumbnail('full'); ?></div>

					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); 
							global $post;
							$content = get_extended( $post->post_content );
							$excerpt = $content['main'];
							$main_content = apply_filters('the_content', $content['extended']);
							$post_meta = get_post_custom();
							$obrazek = $post_meta['_rozmowameta_miejsceimage'][0];

						?>
							<div class="headline">
								<div class="head-image"><?php //the_post_thumbnail('large'); ?></div>
								<h1>
									<?php the_title(); ?>
								</h1>
								<h2>
									<?php the_excerpt();?>
								</h2>
							</div>
							<div class="post-content">
							<div class="post-features">
								<div class="post-meta">
									<div class="data">
										<span id="day"><?php echo get_the_time('j');?></span>
										<span id="month"><?php echo get_the_time('M');?></span>
									</div>
									<div class="cats">
										<img src="<?php echo get_template_directory_uri(); ?>/library/images/rozmowa.svg" alt="<?php echo 'rozmowa' ?>">
									       
									</div>
								</div>
								 <div class="excerpt">
									<?php echo $excerpt;?>
								</div>
							</div>
							
							
							<div class="tresc">
								<?php
									echo $main_content;
								?>
							</div>
							<div>


							</div>
						
							


						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Nie znaleziono', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Nie znaleziono.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'To jest wynik błędu na stronie.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>
									<div class="tags">
			<?php 
			$items = get_the_terms(get_the_ID(), 'post_tag');
			foreach( $items as $term ) { 
				echo "<a href='".get_term_link($term->slug, 'post_tag')."' class='post-tag'>#"; 
				echo $term->slug; echo "</a> ";

			} ?>
			</div>
			<div class="element sharing" >
				<?php echo do_shortcode('[lana_fb_share]');?>
			</div>

			<h2 class="archive-title" style="font-size: 1em">Może cię zainteresować:</h2>
			<div id="post-results">
				<?php  
					$related = get_field('related_posts');
					if($related){
						foreach( $related as $idelem){
							$post = get_post($idelem);
							get_template_part( 'content', 'posttile' );
						}
					}
				?>
			</div>
			<div class="element sharing" >
				<?php echo do_shortcode('[Heateor-SC]');?>
			</div>
			

						</div>

			
					</main>

				</div>

			</div>
			<div class="bottom-image">
	<?php 

		if($obrazek):
	?>
	<img src="<?php echo esc_html($obrazek);?>" alt="obrazek dolny">
	<?php endif;
	?>

</div>


<?php get_footer(); ?>
