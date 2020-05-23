<?php
$terms = get_the_terms(get_the_ID(), 'typ-podrozy');
$taxonomy = 'typ-podrozy';
$marker = array(
	'lat' => get_post_meta( get_the_ID(), '_miejscemeta_latitude', true ),
	'lng' => get_post_meta( get_the_ID(), '_miejscemeta_longtitude', true )
	);

if($marker['lat']===''){
	$marker = array(
	'lat' => get_post_meta( get_the_ID(), '_gorameta_latitude', true ),
	'lng' => get_post_meta( get_the_ID(), '_gorameta_longtitude', true )
	);
}
$type = get_post_type();
if(!strcmp($type, 'gora')){
	$type = 'Góry';
}else if(!strcmp($type, 'gadzet')){
	$type = 'gadżety';
}else if(!strcmp($type, 'rozmowa')){
	$type = 'rozmowy';
}else if(!strcmp($type, 'miejsce')){
	$ter = get_the_terms(get_the_ID(), 'kategoria-miejsca');
	$type = $ter[0] ->name;
}
?>

	<div class="element post-views <?php foreach( $terms as $term ) { echo $term->slug; echo " ";} ?>" id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> data-lat="<?php echo $marker['lat'];?>" data-lng="<?php echo $marker['lng'];?>">
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
			<div class="post-thumb"><?php the_post_thumbnail( 'bones-thumb-600' ); ?>
				<div class="tax-title"><?php echo $type;?></div>
			</div>
			<h3 class="h2 entry-title"><?php the_title(); ?></h3>
			
			<div class="exc">
				<?php the_excerpt();?>
			</div>
		</a>
		<div class="tags">
		<?php 
		$items = get_the_terms(get_the_ID(), 'post_tag');
		foreach( $items as $term ) { 
			echo "<a href='".get_term_link($term->slug, 'post_tag')."' class='post-tag'>#"; 
			echo $term->slug; echo "</a> ";

		} ?>
		</div>
		<ul class="post-icons">
				<?php 
				$count = 0;
				$type = get_post_type();
				if(!strcmp($type, 'miejsce')){
					foreach ( $terms as $term ) { 
						//$count +=1;
						//if($count <=3){
					?>

					<a href="<?php echo get_term_link($term->slug, $taxonomy); ?>" id="<?php echo $term->slug;?>">
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/icons/<?php echo $term->slug;?>.png" alt="<?php echo $term->name; ?>">
						</li>
					</a>
				<?php  } }else if(!strcmp($type, 'gora')){ ;?>
					
					<li>
						<img src="<?php echo get_template_directory_uri(); ?>/library/images/icons/gory.png" alt="gory">
						<?php 
										$taxonomy = 'typ-podrozy';
										$terms = get_the_terms($post->ID, $taxonomy); // Get all terms of a taxonomy

											if ( $terms && !is_wp_error( $terms ) ) :
												
												foreach ( $terms as $term ) { if (!strcasecmp($term->slug, 'we-dwoje')||!strcasecmp($term->slug, 'z-dzieckiem')){?>

											<a href="<?php echo get_term_link($term->slug, $taxonomy); ?>" id="<?php echo $term->slug;?>">
												<img src="<?php echo get_template_directory_uri(); ?>/library/images/icons/<?php echo $term->slug;?>.png" alt="<?php echo $term->name; ?>">
											</a>
											
											<?php }}
											

										endif;
										?>
					</li>
				

				<?php 
					}else if(!strcmp($type, 'rozmowa')){ ?>
					<li>
						<img src="<?php echo get_template_directory_uri(); ?>/library/images/rozmowa.svg" alt="rozmowa">
					</li>
				<?php 
					}else if(!strcmp($type, 'gadzet')){ ?>
					<li>
						<img src="<?php echo get_template_directory_uri(); ?>/library/images/gadzet.svg" alt="gadzet" style="height: 2em;">
					</li>
				<?php

			}

				;?>


			</ul>
		

	</div>
