<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">
					<div class="background"><?php the_post_thumbnail('large'); ?></div>
					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); 
							global $post;
							$content = get_extended( $post->post_content );
							$excerpt = $content['main'];
							$main_content = apply_filters('the_content', $content['extended']);
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
										<img src="<?php echo get_template_directory_uri(); ?>/library/images/icons/gory.png" alt="<?php echo 'gora' ?>">
									</div>
								</div>
								 <div class="excerpt">
									<?php echo $excerpt;?>
								</div>
							</div>
							
							<div class="ratings gora">
								 	<?php 
									$post_meta = get_post_custom(get_the_ID());
									$poziom = ($post_meta['_gorameta_poziom_trudnosci'][0]);
									?>
									<div class="star-row">
										<img src="<?php echo get_template_directory_uri(); ?>/library/images/poziom.svg" alt="Ikona kategorii" class="gora-icon">
										<p>Poziom trudności:</p>
										<div class="<?php echo $poziom;?> stars"></div>
									</div>
									
									<div class="star-row ">
										<img src="<?php echo get_template_directory_uri(); ?>/library/images/dystans.svg" alt="Ikona kategorii" class="gora-icon">
										<p>Dystans:</p>
										<p><?php echo esc_html($post_meta['_gorameta_dystans'][0]); echo ' km';?></p>
									</div>
									<div class="star-row ">
										<img src="<?php echo get_template_directory_uri(); ?>/library/images/punkt.svg" alt="Ikona kategorii" class="gora-icon">
										<p>Najwyższy punkt:</p>
										<p><?php echo esc_html($post_meta['_gorameta_npunkt'][0]); echo ' m';?></p>
									</div>
									<div class="star-row">
										<img src="<?php echo get_template_directory_uri(); ?>/library/images/suma.svg" alt="Ikona kategorii" class="gora-icon">
										<p>Suma przewyższeń:</p>
										<p><?php echo esc_html($post_meta['_gorameta_sumap'][0]); echo ' m';?></p>
									</div>
									<a href="<?php echo esc_html($post_meta['_gorameta_urltrasy'][0]);?>" class="trasa-mapa">
										<img src="<?php echo esc_html($post_meta['_gorameta_trasaimage'][0]);?>" alt="obraz trasy">

									</a>
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
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
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
						</div>

						
					</main>

				</div>

			</div>

<?php get_footer(); ?>
