<?php
function scm_register_post_type_team() {
	register_post_type('team',
		array(
			'capability_type' => array('team', 'teams'),
			'public'           => true,
			'has_archive'      => true,
			'hierarchical'     => false,
			'labels'           => array(
				'name'               => __('Teams', 'sportsclubmanager'),
				'singular_name'      => __('Team', 'sportsclubmanager' ),
				'all_items'          => __('All Teams', 'sportsclubmanager' ),
				'add_new'            => __('Add New', 'sportsclubmanager' ),
				'add_new_item'       => __('Add New Team', 'sportsclubmanager'),
				'edit'               => __('Edit', 'sportsclubmanager' ),
				'edit_item'          => __('Edit Team', 'sportsclubmanager' ),
				'new_item'           => __('New Team', 'sportsclubmanager' ),
				'view'               => __('View', 'sportsclubmanager' ),
				'view_item'          => __('View Team', 'sportsclubmanager' ),
				'search_items'       => __('Search Teams', 'sportsclubmanager' ),
				'not_found'          => __('No Teams found', 'sportsclubmanager' ),
				'not_found_in_trash' => __('No Teams found in Trash', 'sportsclubmanager' ),
				'parent'             => __('Parent Team', 'sportsclubmanager' ),
			),
			'menu_position'     => 20,
			'menu_icon'         => 'dashicons-group',
			'rewrite'           => array(
				'slug' => __('teams', 'sportsclubmanager'),
				'with_front' => false
			),
			'supports'          => array('title', 'editor', 'thumbnail', 'page-attributes')
		)
	);

	register_taxonomy('section', 'team',
		array(
			'hierarchical'      => true,
			'labels'            => array(
				'name'                       => __( 'Sections', 'sportsclubmanager' ),
				'singular_name'              => __( 'Section', 'sportsclubmanager' ),
				'menu_name'                  => __( 'Sections', 'sportsclubmanager'  ),
				'all_items'                  => __( 'All Sections', 'sportsclubmanager' ),
				'edit_item'                  => __( 'Edit Section', 'sportsclubmanager' ),
				'view_item'                  => __( 'View Section', 'sportsclubmanager' ),
				'update_item'                => __( 'Update Section', 'sportsclubmanager' ),
				'add_new_item'               => __( 'Add New Section', 'sportsclubmanager' ),
				'new_item_name'              => __( 'New Section Name', 'sportsclubmanager' ),
				'parent_item' 	             => __( 'Parent Section', 'sportsclubmanager' ),
				'parent_item_colon'          => __( 'Parent Section:', 'sportsclubmanager' ),
				'search_items'               => __( 'Search Sections', 'sportsclubmanager' ),
				'popular_items'              => __( 'Popular Sections', 'sportsclubmanager' ),
				'separate_items_with_commas' => __( 'Seperate sections with commas', 'sportsclubmanager' ),
				'add_or_remove_items'        => __( 'Add or remove sections', 'sportsclubmanager' ),
				'choose_from_most_used'      => __( 'Choose from the most used sections', 'sportsclubmanager' ),
				'not_found'                  => __( 'No sections found.', 'sportsclubmanager' )
			),
			'query_var'         => true,
			'rewrite'           => array(
				'slug' => __('section', 'sportsclubmanager')
			),
			'show_ui'           => true,
			'show_admin_column' => true
			
		)
	);
}
add_action('init', 'scm_register_post_type_team');

function scm_register_post_type_sponsor() {
	register_post_type('sponsor',
		array(
			'capability_type'  => array('sponsor', 'sponsors'),
			'public'           => true,
			'has_archive'      => true,
			'hierarchical'     => false,
			'labels'           => array(
				'name'               => __('Sponsors', 'sportsclubmanager'),
				'singular_name'      => __('Sponsor', 'sportsclubmanager'),
				'add_new'            => __('Add New', 'sportsclubmanager'),
				'add_new_item'       => __('Add New Sponsor', 'sportsclubmanager'),
				'edit_item'          => __('Edit Sponsor', 'sportsclubmanager'),
				'new_item'           => __('New Sponsor', 'sportsclubmanager'),
				'view_item'          => __('View Sponsor', 'sportsclubmanager'),
				'search_items'       => __('Search Sponsors', 'sportsclubmanager'),
				'not_found'          => __('No Sponsors found', 'sportsclubmanager'),
				'not_found_in_trash' => __('No Sponsors found in Trash', 'sportsclubmanager'),
				'parent_item_colon'  => __('Parent Sponsor', 'sportsclubmanager'),
				'all_items'          => __('All Sponsors', 'sportsclubmanager'),
				'archives'           => __('Sponsor Archives', 'sportsclubmanager'),
				'attributes'         => __('Page Attributes', 'sportsclubmanager'),
				'insert_into_item'   => __('Add to Sponsor', 'sportsclubmanager'),
			),
			'menu_position'     => 22,
			'menu_icon'         => 'dashicons-businessman',
			'rewrite'           => array(
				'slug' => __('sponsors', 'sportsclubmanager'),
				'with_front' => false
			),
			'supports'          => array('title', 'editor', 'thumbnail', 'page-attributes')
		)
	);

	register_taxonomy('advertising_medium', 'sponsor',
		array(
			'hierarchical' => true,
			'labels'            => array(
				'name'                       => __('Advertising media', 'sportsclubmanager'),
				'singular_name'              => __('Advertising medium', 'sportsclubmanager'),
				'menu_name'                  => __('Advertising media', 'sportsclubmanager' ),
				'all_items'                  => __('All advertising media', 'sportsclubmanager'),
				'edit_item'                  => __('Edit advertising medium', 'sportsclubmanager'),
				'view_item'                  => __('View advertising medium', 'sportsclubmanager'),
				'update_item'                => __('Update advertising medium', 'sportsclubmanager'),
				'add_new_item'               => __('Add New advertising medium', 'sportsclubmanager'),
				'new_item_name'              => __('New advertising medium name', 'sportsclubmanager'),
				'parent_item' 	             => __('Parent advertising medium', 'sportsclubmanager'),
				'parent_item_colon'          => __('Parent advertising medium:', 'sportsclubmanager'),
				'search_items'               => __('Search advertising media', 'sportsclubmanager'),
				'popular_items'              => __('Popular advertising media', 'sportsclubmanager'),
				'separate_items_with_commas' => __('Seperate advertising media with commas', 'sportsclubmanager'),
				'add_or_remove_items'        => __('Add or remove advertising media', 'sportsclubmanager'),
				'choose_from_most_used'      => __('Choose from the most used advertising media', 'sportsclubmanager'),
				'not_found'                  => __('No advertising media found.', 'sportsclubmanager')
			),
			'query_var'         => true,
			'rewrite'           => array(
				'slug' => __('advertising-medium', 'sportsclubmanager')
			),
			'show_ui'           => true,
			'show_admin_column' => true
		)
	);
}
add_action('init', 'scm_register_post_type_sponsor');

function scm_add_roles() {
	$capabilities = array(
		'edit_sponsor', 
		'read_sponsor', 
		'delete_sponsor', 
		'edit_sponsors', 
		'edit_others_sponsors', 
		'publish_sponsors',       
		'read_private_sponsors', 
		'edit_teams',
		'edit_team', 
		'read_team', 
		'delete_team', 
		'edit_teams', 
		'edit_others_teams', 
		'publish_teams',       
		'read_private_teams', 
		'edit_teams'
	);
	$admin_role = get_role('administrator');

	foreach ($capabilities as $capability) {
		$admin_role->add_cap($capability);
	}
	
	$capabilities = array(
		'edit_post'          => 'edit_sponsor', 
		'read_post'          => 'read_sponsor', 
		'delete_post'        => 'delete_sponsor', 
		'edit_posts'         => 'edit_sponsors', 
		'edit_others_posts'  => 'edit_others_sponsors', 
		'publish_posts'      => 'publish_sponsors',       
		'read_private_posts' => 'read_private_sponsors', 
		'create_posts'       => 'edit_teams',
		'edit_post'          => 'edit_team', 
		'read_post'          => 'read_team', 
		'delete_post'        => 'delete_team', 
		'edit_posts'         => 'edit_teams', 
		'edit_others_posts'  => 'edit_others_teams', 
		'publish_posts'      => 'publish_teams',       
		'read_private_posts' => 'read_private_teams', 
		'create_posts'       => 'edit_teams'
	);
	if (!wp_roles()->is_role( 'executive' )) {
		add_role( 'executive', __('Executive', 'sportsclubmanager'), $capabilities);
	}
	if (!wp_roles()->is_role( 'coach' )) {
		add_role( 'coach', __('Coach', 'sportsclubmanager'), array());
	}
}
register_activation_hook(__FILE__, 'scm_add_roles');
?>