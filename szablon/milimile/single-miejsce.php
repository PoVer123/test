<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap cf">
	<?php if (have_posts()) : while (have_posts()) : the_post(); 
			global $post;
			$content = get_extended( $post->post_content );
			$excerpt = $content['main'];
			$main_content = apply_filters('the_content', $content['extended']);
			$post_meta = get_post_custom();
			$obrazek = $post_meta['_miejscemeta_miejsceimage'][0];
			?>
		<div class="background"><?php the_post_thumbnail('large'); ?></div>
		<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">


			
			<div class="headline">
				<div class="head-image"><?php// the_post_thumbnail('large'); ?></div>
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
						<?php 
						$taxonomy = 'typ-podrozy';
											$terms = get_the_terms($post->ID, $taxonomy); // Get all terms of a taxonomy

											if ( $terms && !is_wp_error( $terms ) ) :
												$counter = 0;
												foreach ( $terms as $term ) if($counter <2 ){{ ?>

											<a href="<?php echo get_term_link($term->slug, $taxonomy); ?>" id="<?php echo $term->slug;?>">
												<img src="<?php echo get_template_directory_uri(); ?>/library/images/icons/<?php echo $term->slug;?>.png" alt="<?php echo $term->name; ?>">
											</a>
											
											<?php }
											$counter +=1;
										}

										endif;
										?>
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
					
					<div class="element post-meta-item">
					<?php 
					$text = get_post_meta( get_the_ID(), '_miejscemeta_spanie', true );
					if($text){
						?>
						<div class="meta-icon">
							<h5 class="archive-title">Polecam</h5>
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/spanie.png" alt="icon for spanie">
							
						</div>
						<div class="featured"><?php
						echo apply_filters( 'the_content',$text );
					}
					?></div>
					</div>
					<div class="element post-meta-item">
					<?php 
					$text = get_post_meta( get_the_ID(), '_miejscemeta_trasa', true );
					if($text){
						?>
						<div class="meta-icon">
							<h5 class="archive-title">Polecam</h5>
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/dystans.svg" alt="icon for trasa">
							
						</div>
						<div class="featured">
						<?php
						echo apply_filters( 'the_content',$text );
					}
					?></div>
					</div>
					<div class="element post-meta-item">
					<?php 
					$text = get_post_meta( get_the_ID(), '_miejscemeta_jedzenie', true );

					if($text){
						?>
						<div class="meta-icon">
							<h5 class="archive-title">Polecam</h5>
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/jedzenie.png" alt="icon for spanie">
							
						</div>
						<div class="featured"><?php
						echo apply_filters( 'the_content',$text );
					}
					?></div>

					</div>

				<?php endwhile; ?>

			<?php else : ?>

				<article id="post-not-found" class="hentry cf">
					<p>Nie można było znaleźć</p>;
				</article>

			<?php endif; ?>
			<div class="tags">
			<?php 
			$items = get_the_terms(get_the_ID(), 'post_tag');
			foreach( $items as $term ) { 
				echo "<a href='".get_term_link($term->slug, 'post_tag')."' class='post-tag'>#"; 
				echo $term->slug; echo "</a> ";

			} ?>
			<p class="post-tag">Opublikowano: <?php echo get_the_time('j-m-Y');?></p>
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
<div class="bottom-image">
	<?php 

		if($obrazek):
	?>
	<img src="<?php echo esc_html($obrazek);?>" alt="obrazek dolny">
	<?php endif;
	?>

</div>
<?php get_footer(); ?>
