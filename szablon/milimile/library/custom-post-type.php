<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}


	
// Miejsca:
		// let's create the function for the custom type
function custom_post_miejsce() { 
	// creating (registering) the custom type 
	register_post_type( 'miejsce', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Miejsca', 'milimile' ), /* This is the Title of the Group */
			'singular_name' => __( 'Miejsce', 'milimile' ), /* This is the individual type */
			'all_items' => __( 'Wszystkie miejsca', 'milimile' ), /* the all items menu item */
			'add_new' => __( 'Dodaj nowe', 'milimile' ), /* The add new menu item */
			'add_new_item' => __( 'Dodaj nowe miejsce', 'milimile' ), /* Add New Display Title */
			'edit' => __( 'Edytuj', 'milimile' ), /* Edit Dialog */
			'edit_item' => __( 'Edytuj miejsce', 'milimile' ), /* Edit Display Title */
			'new_item' => __( 'Nowe miejsce', 'milimile' ), /* New Display Title */
			'view_item' => __( 'Zobacz miejsce', 'milimile' ), /* View Display Title */
			'search_items' => __( 'Szukaj miejsca', 'milimile' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nie znaleziono nic.', 'milimile' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nie znaleziono nic w koszu.', 'milimile' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Posty z opisami odwiedzonych miejsc.', 'milimile' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'miejsca', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'miejsca', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
						/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'miejsce' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'miejsce' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_miejsce');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'kategoria-miejsca', 

		array('miejsce', 'gora'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */

		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Kategorie miejsc', 'milimile' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Kategoria dla miejsca', 'milimile' ), /* single taxonomy name */
				'search_items' =>  __( 'Szukaj kategorii', 'milimile' ), /* search title for taxomony */
				'all_items' => __( 'Wszystkie kategorie miejsc', 'milimile' ), /* all title for taxonomies */
				'parent_item' => __( 'Nadrzędna kategoria', 'milimile' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Nadrzędna kategoria:', 'milimile' ), /* parent taxonomy title */
				'edit_item' => __( 'Edytuj', 'milimile' ), /* edit custom taxonomy title */
				'update_item' => __( 'Aktualizuj', 'milimile' ), /* update title for taxonomy */
				'add_new_item' => __( 'Dodaj nową', 'milimile' ), /* add new title for taxonomy */
				'new_item_name' => __( 'Dodaj nazwę kategorii', 'milimile' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'miejsce' ),
		)
	);
	register_taxonomy( 'typ-podrozy', 
		array('miejsce', 'gora'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */

		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Typy podróży', 'milimile' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Typ podróży', 'milimile' ), /* single taxonomy name */
				'search_items' =>  __( 'Szukaj typu', 'milimile' ), /* search title for taxomony */
				'all_items' => __( 'Wszystkie typy podróży', 'milimile' ), /* all title for taxonomies */
				//'parent_item' => __( 'Nadrzędny typ', 'milimile' ), /* parent title for taxonomy */
				//'parent_item_colon' => __( 'Nadrzędna kategoria:', 'milimile' ), /* parent taxonomy title */
				'edit_item' => __( 'Edytuj', 'milimile' ), /* edit custom taxonomy title */
				'update_item' => __( 'Aktualizuj', 'milimile' ), /* update title for taxonomy */
				'add_new_item' => __( 'Dodaj nowy', 'milimile' ), /* add new title for taxonomy */
				'new_item_name' => __( 'Dodaj nazwę typu', 'milimile' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'typ-podrozy' ),
		)
	);

	add_action( 'cmb2_init', 'cmb2_miejsce_metaboxes' );
//metaboxy do gór
function cmb2_miejsce_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_miejscemeta_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'polecenia',
		'title'         => __( 'Polecane: ', 'cmb2' ),
		'object_types'  => array( 'miejsce', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$cmb->add_field( array(
		'name'       => esc_html__( 'Polecam nocleg', 'cmb2' ),
		'id'         => $prefix . 'spanie',
		'type'       => 'wysiwyg',
		
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Polecam trasę', 'cmb2' ),
		'id'         => $prefix . 'trasa',
		'type'       => 'wysiwyg',
		
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Polecam jedzenie', 'cmb2' ),
		'id'         => $prefix . 'jedzenie',
		'type'       => 'wysiwyg',
		
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Dla dzieci', 'cmb2' ),
		'id'         => $prefix . 'dladzieci',
		'type'       => 'wysiwyg',
		
	) );
	$cmb->add_field( array(

		'name'       => esc_html__( 'Szerokość geograficzna znacznika', 'cmb2' ),
		'id'         => $prefix . 'latitude',
		'type'       => 'text_small',
		
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Długość geograficzna znacznika', 'cmb2' ),
		'id'         => $prefix . 'longtitude',
		'type'       => 'text_small',
		
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Podpis do obrazka', 'cmb2' ),
		'id'         => $prefix . 'capt',
		'type'       => 'text_small',
		
	) );
	$cmb->add_field( array(
		'name' => esc_html__( 'Obraz dolny', 'cmb2' ),
		'desc' => esc_html__( 'Dodaj obraz z galerii', 'cmb2' ),
		'id'   => $prefix . 'miejsceimage',
		'type' => 'file',
	) );
	
}
	
	//Rozmowy
	function custom_post_rozmowa() { 
	// creating (registering) the custom type 
	register_post_type( 'rozmowa', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Rozmowy', 'milimile' ), /* This is the Title of the Group */
			'singular_name' => __( 'Rozmowa', 'milimile' ), /* This is the individual type */
			'all_items' => __( 'Wszystkie rozmowy', 'milimile' ), /* the all items menu item */
			'add_new' => __( 'Dodaj nową', 'milimile' ), /* The add new menu item */
			'add_new_item' => __( 'Dodaj nową rozmowę', 'milimile' ), /* Add New Display Title */
			'edit' => __( 'Edytuj', 'milimile' ), /* Edit Dialog */
			'edit_item' => __( 'Edytuj rozmowę', 'milimile' ), /* Edit Display Title */
			'new_item' => __( 'Nowa rozmowa', 'milimile' ), /* New Display Title */
			'view_item' => __( 'Zobacz rozmowę', 'milimile' ), /* View Display Title */
			'search_items' => __( 'Szukaj rozmowy', 'milimile' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nie znaleziono nic.', 'milimile' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nie znaleziono nic w koszu.', 'milimile' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Posty z zapisami rozmów.', 'milimile' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'rozmowy', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'rozmowy', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt')

		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'miejsce' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'rozmowa' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_rozmowa');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'typ-rozmowy', 
		array('rozmowa'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Kategorie rozmów', 'milimile' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Kategoria dla rozmowy', 'milimile' ), /* single taxonomy name */
				'search_items' =>  __( 'Szukaj kategorii', 'milimile' ), /* search title for taxomony */
				'all_items' => __( 'Wszystkie kategorie rozmów', 'milimile' ), /* all title for taxonomies */
				'parent_item' => __( 'Nadrzędna kategoria', 'milimile' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Nadrzędna kategoria:', 'milimile' ), /* parent taxonomy title */
				'edit_item' => __( 'Edytuj', 'milimile' ), /* edit custom taxonomy title */
				'update_item' => __( 'Aktualizuj', 'milimile' ), /* update title for taxonomy */
				'add_new_item' => __( 'Dodaj nową', 'milimile' ), /* add new title for taxonomy */
				'new_item_name' => __( 'Dodaj nazwę kategorii', 'milimile' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'typ-rozmowy' ),
		)
	);
add_action( 'cmb2_init', 'cmb2_rozmowa_metaboxes' );
function cmb2_rozmowa_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_rozmowameta_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'polerozmowy',
		'title'         => __( 'Pole dodatkowe: ', 'cmb2' ),
		'object_types'  => array( 'rozmowa', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	
	
	$cmb->add_field( array(
		'name' => esc_html__( 'Obraz dolny', 'cmb2' ),
		'desc' => esc_html__( 'Dodaj obraz z galerii', 'cmb2' ),
		'id'   => $prefix . 'miejsceimage',
		'type' => 'file',
	) );
	
}

	// Gadżety
	function custom_post_gadzet() { 
	// creating (registering) the custom type 
	register_post_type( 'gadzet', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Gadżety', 'milimile' ), /* This is the Title of the Group */
			'singular_name' => __( 'Gadżet', 'milimile' ), /* This is the individual type */
			'all_items' => __( 'Wszystkie gadżety', 'milimile' ), /* the all items menu item */
			'add_new' => __( 'Dodaj nowy', 'milimile' ), /* The add new menu item */
			'add_new_item' => __( 'Dodaj nowy gadżet', 'milimile' ), /* Add New Display Title */
			'edit' => __( 'Edytuj', 'milimile' ), /* Edit Dialog */
			'edit_item' => __( 'Edytuj gadżet', 'milimile' ), /* Edit Display Title */
			'new_item' => __( 'Nowy gadżet', 'milimile' ), /* New Display Title */
			'view_item' => __( 'Zobacz gadżety', 'milimile' ), /* View Display Title */
			'search_items' => __( 'Szukaj gadżetów', 'milimile' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nie znaleziono nic.', 'milimile' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nie znaleziono nic w koszu.', 'milimile' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Posty z recenzjami gadżetów.', 'milimile' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 6, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'gadzety', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'gadzety', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'miejsce' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'gadzet' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_gadzet');

	//metabox

	add_action( 'cmb2_init', 'cmb2_gadzet_metaboxes' );

	register_taxonomy( 'typ-gadzet', 
		array('gadzet'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Kategorie gadżetów', 'milimile' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Kategoria dla gadżetu', 'milimile' ), /* single taxonomy name */
				'search_items' =>  __( 'Szukaj kategorii', 'milimile' ), /* search title for taxomony */
				'all_items' => __( 'Wszystkie kategorie gadżetów', 'milimile' ), /* all title for taxonomies */
				'parent_item' => __( 'Nadrzędna kategoria', 'milimile' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Nadrzędna kategoria:', 'milimile' ), /* parent taxonomy title */
				'edit_item' => __( 'Edytuj', 'milimile' ), /* edit custom taxonomy title */
				'update_item' => __( 'Aktualizuj', 'milimile' ), /* update title for taxonomy */
				'add_new_item' => __( 'Dodaj nową', 'milimile' ), /* add new title for taxonomy */
				'new_item_name' => __( 'Dodaj nazwę kategorii', 'milimile' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'typ-gadzet' ),
		)
	);
/**
 * Define the metabox and field configurations.
 */
function cmb2_gadzet_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_gadzetmeta_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'recenzja',
		'title'         => __( 'Oceny', 'cmb2' ),
		'object_types'  => array( 'gadzet', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	// Regular text field
	$cmb->add_field( array(
		'name'       => esc_html__( 'Wygląd', 'cmb2' ),
		'id'         => $prefix . 'radio_inline1',
		'type'       => 'radio',
		'options'          => array(
			'oneStar' => esc_html__( '1', 'cmb2' ),
			'twoStar'   => esc_html__( '2', 'cmb2' ),
			'threeStar'   => esc_html__( '3', 'cmb2' ),
			'fourStar'   => esc_html__( '4', 'cmb2' ),
			'fiveStar'     => esc_html__( '5', 'cmb2' ),
		),
	) );

	$cmb->add_field( array(
		'name'       => esc_html__( 'Jakość', 'cmb2' ),
		'id'         => $prefix . 'radio_inline2',
		'type'       => 'radio',
		'options'          => array(
			'oneStar' => esc_html__( '1', 'cmb2' ),
			'twoStar'   => esc_html__( '2', 'cmb2' ),
			'threeStar'   => esc_html__( '3', 'cmb2' ),
			'fourStar'   => esc_html__( '4', 'cmb2' ),
			'fiveStar'     => esc_html__( '5', 'cmb2' ),
		),
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Funkcjonalność', 'cmb2' ),
		'id'         => $prefix . 'radio_inline3',
		'type'       => 'radio',
		'options'          => array(
			'oneStar' => esc_html__( '1', 'cmb2' ),
			'twoStar'   => esc_html__( '2', 'cmb2' ),
			'threeStar'   => esc_html__( '3', 'cmb2' ),
			'fourStar'   => esc_html__( '4', 'cmb2' ),
			'fiveStar'     => esc_html__( '5', 'cmb2' ),
		),
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Cena', 'cmb2' ),
		'id'         => $prefix . 'radio_inline4',
		'type'       => 'radio',
		'options'          => array(
			'oneStar' => esc_html__( '1', 'cmb2' ),
			'twoStar'   => esc_html__( '2', 'cmb2' ),
			'threeStar'   => esc_html__( '3', 'cmb2' ),
			'fourStar'   => esc_html__( '4', 'cmb2' ),
			'fiveStar'     => esc_html__( '5', 'cmb2' ),
		),
	) );
	
	$cmb->add_field( array(
		'name'       => esc_html__( 'Ocena', 'cmb2' ),
		'id'         => $prefix . 'textsmall',
		'type'       => 'text_small',
		
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Gdzie kupić', 'cmb2' ),
		'id'         => $prefix . 'textarea',
		'type'       => 'wysiwyg',
		
	) );
	$cmb->add_field( array(
		'name' => esc_html__( 'Obraz dolny', 'cmb2' ),
		'desc' => esc_html__( 'Dodaj obraz z galerii', 'cmb2' ),
		'id'   => $prefix . 'miejsceimage',
		'type' => 'file',
	) );

}
	
add_action( 'cmb2_init', 'gadzet_pros_repeatable_group_field_metabox' );
add_action( 'cmb2_init', 'gadzet_cons_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function gadzet_pros_repeatable_group_field_metabox() {
	$prefix = 'gadzet_pros_group_';

	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'zalety_metabox',
		'title'        => esc_html__( 'Lista zalet', 'cmb2' ),
		'object_types' => array( 'gadzet', ),
	) );
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'zalety',
		'type'        => 'group',
		'description' => esc_html__( 'Pozycje na liście zalet', 'cmb2' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Pozycja na liście: {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Dodaj nową pozycję', 'cmb2' ),
			'remove_button' => esc_html__( 'Usuń pozycję', 'cmb2' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );
	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Opis:', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
		//'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );
}
function gadzet_cons_repeatable_group_field_metabox() {
	$prefix = 'gadzet_cons_group_';

	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'wady_metabox',
		'title'        => esc_html__( 'Lista wad', 'cmb2' ),
		'object_types' => array( 'gadzet', ),
	) );
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'wady',
		'type'        => 'group',
		'description' => esc_html__( 'Pozycje na liście wad', 'cmb2' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Pozycja na liście: {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Dodaj nową pozycję', 'cmb2' ),
			'remove_button' => esc_html__( 'Usuń pozycję', 'cmb2' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );
	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Opis:', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
		//'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );
}

// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_gory');

// Góry
function custom_post_gory() { 
	// creating (registering) the custom type 
	register_post_type( 'gora', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Góry', 'milimile' ), /* This is the Title of the Group */
			'singular_name' => __( 'Góra', 'milimile' ), /* This is the individual type */
			'all_items' => __( 'Wszystkie góry', 'milimile' ), /* the all items menu item */
			'add_new' => __( 'Dodaj nową', 'milimile' ), /* The add new menu item */
			'add_new_item' => __( 'Dodaj nową górę', 'milimile' ), /* Add New Display Title */
			'edit' => __( 'Edytuj', 'milimile' ), /* Edit Dialog */
			'edit_item' => __( 'Edytuj górę', 'milimile' ), /* Edit Display Title */
			'new_item' => __( 'Nowa góra', 'milimile' ), /* New Display Title */
			'view_item' => __( 'Zobacz górę', 'milimile' ), /* View Display Title */
			'search_items' => __( 'Szukaj gór', 'milimile' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nie znaleziono nic.', 'milimile' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nie znaleziono nic w koszu.', 'milimile' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Posty z opisami tras górskich.', 'milimile' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 6, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'gory', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'gory', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt',  'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'miejsce' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'gora' );
}
add_action( 'cmb2_init', 'cmb2_gory_metaboxes' );

register_taxonomy( 'typ-gory', 
		array('gora'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Kategorie góry', 'milimile' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Kategoria dla góry', 'milimile' ), /* single taxonomy name */
				'search_items' =>  __( 'Szukaj kategorii', 'milimile' ), /* search title for taxomony */
				'all_items' => __( 'Wszystkie kategorie gór', 'milimile' ), /* all title for taxonomies */
				'parent_item' => __( 'Nadrzędna kategoria', 'milimile' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Nadrzędna kategoria:', 'milimile' ), /* parent taxonomy title */
				'edit_item' => __( 'Edytuj', 'milimile' ), /* edit custom taxonomy title */
				'update_item' => __( 'Aktualizuj', 'milimile' ), /* update title for taxonomy */
				'add_new_item' => __( 'Dodaj nową', 'milimile' ), /* add new title for taxonomy */
				'new_item_name' => __( 'Dodaj nazwę kategorii', 'milimile' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'typ-gory' ),
		)
	);
//metaboxy do gór
function cmb2_gory_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_gorameta_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'opisgory',
		'title'         => __( 'Oceny', 'cmb2' ),
		'object_types'  => array( 'gora', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	// Regular text field
	$cmb->add_field( array(
		'name'       => esc_html__( 'Poziom trudnosci', 'cmb2' ),
		'id'         => $prefix . 'poziom_trudnosci',
		'type'       => 'radio',
		'options'          => array(
			'oneStar' => esc_html__( '1', 'cmb2' ),
			'twoStar'   => esc_html__( '2', 'cmb2' ),
			'threeStar'   => esc_html__( '3', 'cmb2' ),
			'fourStar'   => esc_html__( '4', 'cmb2' ),
			'fiveStar'     => esc_html__( '5', 'cmb2' ),
		),
	) );
	
	$cmb->add_field( array(
		'name'       => esc_html__( 'Dystans', 'cmb2' ),
		'id'         => $prefix . 'dystans',
		'type'       => 'text_small',
		
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Najwyższy punkt', 'cmb2' ),
		'id'         => $prefix . 'npunkt',
		'type'       => 'text_small',
		
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Suma przewyższeń', 'cmb2' ),
		'id'         => $prefix . 'sumap',
		'type'       => 'text_small',
		
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Url trasy', 'cmb2' ),
		'id'         => $prefix . 'urltrasy',
		'type'       => 'text_url',
		
	) );
	$cmb->add_field( array(
		'name' => esc_html__( 'Screen z mapą', 'cmb2' ),
		'desc' => esc_html__( 'Dodaj printscreen z trasą (wielkość dopasuje się automatycznie)', 'cmb2' ),
		'id'   => $prefix . 'trasaimage',
		'type' => 'file',
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Szerokość geograficzna znacznika (opcjonalnie)', 'cmb2' ),
		'id'         => $prefix . 'latitude',
		'type'       => 'text_small',
		
	) );
	$cmb->add_field( array(
		'name'       => esc_html__( 'Długość geograficzna znacznika (opcjonalnie)', 'cmb2' ),
		'id'         => $prefix . 'longtitude',
		'type'       => 'text_small',
		
	) );
	$cmb->add_field( array(
		'name' => esc_html__( 'Obraz dolny', 'cmb2' ),
		'desc' => esc_html__( 'Dodaj obraz z galerii', 'cmb2' ),
		'id'   => $prefix . 'miejsceimage',
		'type' => 'file',
	) );

}
	
?>
