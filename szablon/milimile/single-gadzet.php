
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
							$obrazek = $post_meta['_gadzetmeta_miejsceimage'][0];

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
									

									       	
									            <img src="<?php echo get_template_directory_uri(); ?>/library/images/gadzet.svg" alt="<?php echo 'gadzet' ?>">
									       
									       
									      
									</div>
								</div>
								 <div class="excerpt">
									<?php echo $excerpt;?>
								</div>
							</div>
							
							<div class="ratings">
								 	<?php 
									$post_meta = get_post_custom(get_the_ID());
									$wyglad = ($post_meta['_gadzetmeta_radio_inline1'][0]);
									$jakosc = ($post_meta['_gadzetmeta_radio_inline2'][0]);
									$funkcjonalnosc = ($post_meta['_gadzetmeta_radio_inline3'][0]);
									$cena = ($post_meta['_gadzetmeta_radio_inline4'][0]);

									?>
									<div class="star-column">
										<div class="star-row">
											<p>Wygląd:</p>
											<div class="<?php echo $wyglad;?> stars"></div>
										</div>
										<div class="star-row">
											<p>Jakość:</p>
											<div class="<?php echo $jakosc;?> stars"></div>
										</div>
										<div class="star-row">
											<p>Funkcjonalność:</p>
											<div class="<?php echo $funkcjonalnosc;?> stars"></div>
										</div>
										<div class="star-row">
											<p>Cena:</p>
											<div class="<?php echo $cena;?> stars"></div>
										</div>
									</div>
									<div class="ocena">
										<p id="ocena"><?php echo esc_html($post_meta['_gadzetmeta_textsmall'][0]);?></p>
									</div>
								 </div>
								 <div class="lista">
								 	<div class="listy">
									 	<ul id="pros">
									 		<?php 
									 		$text = get_post_meta( get_the_ID(), 'gadzet_pros_group_zalety', true );
									 		foreach($text as $item){?>
									 			<li><?php echo esc_html($item['title']);?></li>
									 			<?php
									 		}
									 		?>
									 	</ul>
									 	<ul id="cons">
									 		<?php 
									 		$text = get_post_meta( get_the_ID(), 'gadzet_cons_group_wady', true );
									 		foreach($text as $item){?>
									 			<li><?php echo esc_html($item['title']);?></li>
									 			<?php
									 		}
									 		?>
									 	</ul>
									 </div>
								 </div>
							<div class="tresc">
								<?php
									echo $main_content;
								?>
							</div>
							<div>


							</div>
							<h2 class="archive-title">Gdzie kupić</h2>
							<div class="post-meta-item">
								<?php 
								$text = get_post_meta( get_the_ID(), '_gadzetmeta_textarea', true );
								if($text){
									?>
									<div class="meta-icon">
										<h5 class="archive-title">Sklep</h5>
										<img src="<?php echo get_template_directory_uri(); ?>/library/images/sklep.png" alt="icon for sklep">
									</div>
								<div class="featured"><?php
								echo apply_filters( 'the_content',$text );
						}

								?>
								</div>
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
