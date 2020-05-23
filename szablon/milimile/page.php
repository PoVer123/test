<?php get_header(); ?>

<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); 
			global $post;
			 $content = get_extended( $post->post_content );
			 $excerpt = $content['main'];
			$main_content = apply_filters('the_content', $content['extended']);
			//$main_content = the_content();
			?>
	<div id="inner-content" class="wrap cf">
		<div class="background"><?php the_post_thumbnail('large'); ?></div>
		<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

<div class="headline">
				<div class="head-image"><?php// the_post_thumbnail('large'); ?></div>
				<h1>
					<?php the_title(); ?>
				</h1>
				
			</div>
			<div class="post-content">
			

				<div class="excerpt">
					<?php echo $excerpt;?>
				</div>
			
			</div>
		</main>
		</div>

		<div class="tresc_singlepage">
				<?php
				echo $main_content;
				?>
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

		

	</div>



<?php get_footer(); ?>
