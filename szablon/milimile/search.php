<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main">
						<h1 class="archive-title"><span><?php _e( 'Search Results for:', 'bonestheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>
<div id="post-results">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php get_template_part('content', 'posttile');?>

						<?php endwhile; ?>

								

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										
										<section class="entry-content">
											<p><?php _e( 'Try your search again.', 'bonestheme' ); ?></p>
										</section>
										
									</article>

							<?php endif; ?>
</div>
						</main>

							

					</div>

			</div>

<?php get_footer(); ?>
