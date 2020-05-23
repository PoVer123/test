<?php $child = get_term_by( 'id', $term, $zmienna->taxonomy );?>
<a href="<?php echo get_term_link($child->slug, $zmienna->taxonomy); ?>" id="<?php echo $child->slug;?>">
	<li>
		<div class="post-thumb">
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
