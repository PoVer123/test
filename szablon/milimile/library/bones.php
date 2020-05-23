<?php


function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */

// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} // end better title

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function bones_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  if (!is_admin()) {

		// modernizr (without media query polyfill)
		wp_register_script( 'bones-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

		// register main stylesheet
		wp_register_style( 'bones-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );

		// ie-only style sheet
		wp_register_style( 'bones-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		  wp_enqueue_script( 'comment-reply' );
    }

		//adding scripts file in the footer
		wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );
		wp_register_script( 'responsiveslides', get_stylesheet_directory_uri() . '/library/js/libs/responsiveslides.min.js', array( 'jquery' ), '', true );

		// enqueue styles and scripts
		wp_enqueue_script( 'bones-modernizr' );
		//maps
		wp_enqueue_script(
		'twentyfifteen-maps-google-maps',
		'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAKB9ZyWvzHKr8B2qzfly0x-bYdJbwkaVQ',
		array(),
		'1.0.0',
		true
	);
		wp_enqueue_style( 'bones-stylesheet' );
		wp_enqueue_style( 'bones-ie-only' );

		$wp_styles->add_data( 'bones-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

		/*
		I recommend using a plugin to call jQuery
		using the google cdn. That way it stays cached
		and your site will load faster.
		*/
		//for maps
		$zmienna = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if($zmienna!=null){
			$term = get_term_by('id', $zmienna->term_id, $zmienna->taxonomy);
			if($term!=null){
				$dataToBePassed = array(
				    'latitude' => get_field('latitude', $term),
				    'longtitude' => get_field('longtitude', $term),
				    'zoom' => get_field('zoom', $term)
				);
				wp_localize_script( 'bones-js', 'php_vars', $dataToBePassed );
			}
			
		}
		

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bones-js' );
		if(is_home())
			wp_enqueue_script( 'responsiveslides' );
		
		//ajax assets
    	wp_enqueue_script( 'ajax-pagination',  get_stylesheet_directory_uri() . '/library/js/ajax-pagination.js', array( 'jquery' ), '1.0', true );
		global $wp_query;
		wp_localize_script( 'ajax-pagination', 'ajaxpagination', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		));
		
		}
}
// ajax stuff :
add_action( 'wp_ajax_nopriv_ajax_pagination', 'my_ajax_pagination' );
add_action( 'wp_ajax_ajax_pagination', 'my_ajax_pagination' );

function my_ajax_pagination() {
	$name = $_POST['page'];
	$country = $_POST['country'];
	$optionTypes = array();
	if(in_array('gory', $name)){
		$optionTypes = array('miejsce', 'gora');
	}else{
		$optionTypes = array('miejsce');
	}
   	$args = array(
   		'post_type' => $optionTypes,
   		'posts_per_page' => -1,
   		'paged' => $paged,
   		'tax_query' => array(
   			'relation' => 'AND',
	        array(
	            'taxonomy' => 'typ-podrozy',
	            'field' => 'slug', 
	            'terms' =>  $name,
	            'operator' => 'OR'
	        ),
	        array(
	        	'taxonomy' => 'kategoria-miejsca',
	        	'field' => 'slug',
	        	'terms' => $country
	      	)
	    )
	    
   	);
    $posts = new WP_Query( $args );
    $allposts = new WP_Query(array(
    	'post_type' => array('miejsce', 'gora'), 
    	'posts_per_page'=> -1,
    	'paged' => $paged, 
    	'tax_query' => array(array(
    		'taxonomy' => 'kategoria-miejsca',
	        	'field' => 'slug',
	        	'terms' => $country
    		)
    	))
    );


    
    	if(!in_array('wszystkie', $name)){
	        while ( $posts->have_posts() ) { 
	            $posts->the_post();
	            get_template_part( 'content', 'posttile' );
    
	        }
	     }else if (in_array('wszystkie', $name)){

	     		while ( $allposts->have_posts() ) { 
		            $allposts->the_post();
		            get_template_part( 'content', 'posttile' );
		            

		        }
	     }else{
    		echo 'Nie ma postów spełniających wymagania!';
    	
	     }
    
    

    die();
}
function be_load_more_js() {
	global $wp_query;
	$args = array(
		'url'   => admin_url( 'admin-ajax.php' ),
		'query' => $wp_query->query,
	);
			
	wp_enqueue_script( 'be-load-more', get_stylesheet_directory_uri() . '/library/js/load-more.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'be-load-more', 'beloadmore', $args );
	
}
add_action( 'wp_enqueue_scripts', 'be_load_more_js' );
function be_ajax_load_more() {

	$name = $_POST['name'];
	$pages =  $_POST['page'];
	
	$args = array('post_type' => array('miejsce', 'gora', 'rozmowa', 'gadzet'),
			'paged' => esc_attr( $pages ),
			'posts_per_page' => 18
			);
	
	$taxonomytype = $_POST['taxname'];
	$termname = $_POST['termname'];
	$argspart = array('post_type' => $name,
			'paged' => esc_attr( $pages ),
			'posts_per_page' => 18,
			'tax_query' => array(
								array(
									'taxonomy' => $taxonomytype,
	            					'field' => 'slug', 
	            					'terms' =>  $termname,
								)
								));
		
		
	ob_start();
	$loop = new WP_Query( $args );
	$loopart = new WP_Query($argspart);
	if(!strcmp($name, 'main')){

		if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post();
			get_template_part('content','posttile');
		endwhile; endif; wp_reset_postdata();
		$data = ob_get_clean();
		wp_send_json_success( $data );
	}else{
		if( $loopart->have_posts() ): while( $loopart->have_posts() ): $loopart->the_post();
			get_template_part('content','posttile');
		endwhile; endif; wp_reset_postdata();
		$data = ob_get_clean();
		wp_send_json_success( $data );
	}
	wp_die();
}
add_action( 'wp_ajax_be_ajax_load_more', 'be_ajax_load_more' );
add_action( 'wp_ajax_nopriv_be_ajax_load_more', 'be_ajax_load_more' );
// end ajax stuff
/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(1500, 1000, true);



	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'bonestheme' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'bonestheme' ) // secondary nav in footer
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

} /* end bones theme support */


/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using bones_related_posts(); )
function bones_related_posts() {
	echo '<ul id="bones-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'bonestheme' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_postdata();
	echo '</ul>';
} /* end bones related posts function */

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function bones_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '&larr;',
    'next_text'    => '&rarr;',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
function grd_custom_archive_title( $title ) {
	// Remove any HTML, words, digits, and spaces before the title.
	return preg_replace( '#^[\w\d\s]+:\s*#', '', strip_tags( $title ) );
}
add_filter( 'get_the_archive_title', 'grd_custom_archive_title' );

function wpse28145_add_custom_types( $query ) {
    if( is_tag() && $query->is_main_query() ) {

        // this gets all post types:
        $post_types = get_post_types();

        // alternately, you can add just specific post types using this line instead of the above:
        // $post_types = array( 'post', 'your_custom_type' );

        $query->set( 'post_type', $post_types );
    }
}
add_filter( 'pre_get_posts', 'wpse28145_add_custom_types' );

// This removes the annoying […] to a Read More link
// function bones_excerpt_more($more) {
// 	global $post;
// 	// edit here if you like
// 	return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'bonestheme' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'bonestheme' ) .'</a>';
// }




?>
