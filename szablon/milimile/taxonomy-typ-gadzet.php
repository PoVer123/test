<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap cf">

		<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<h1 class="archive-title h2"><?php post_type_archive_title(); ?></h1>
							<div id="post-results" >
							<?php 
							$args = array('post_type' => 'gadzet',
							'posts_per_page' => 3,
							'tax_query' => array(
								array(
									'taxonomy' => get_queried_object()->taxonomy,
	            					'field' => 'slug', 
	            					'terms' =>  get_queried_object()->slug,
								)
								)
							);
							
							$loop = new WP_Query( $args );

							if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>

								<?php get_template_part('content', 'posttile');?>


							<?php endwhile; endif;?>
							</div>
							<div class="post-listing" id="<?php echo get_post_type(); ?>" data-tax="<?php echo get_queried_object()->taxonomy;?>" data-term="<?php echo get_queried_object()->slug;?>"></div>
							
						</main>

</div>

</div>

<?php get_footer(); ?>
