<?php
// Fired when the plugin is activated
function activate( $network_wide ) {
	if ( function_exists( 'is_multisite' ) && is_multisite() ) {
		if ( $network_wide  ) {
			// Get all blog ids
			$blog_ids = get_blog_ids();
			foreach ( $blog_ids as $blog_id ) {
				switch_to_blog( $blog_id );
				single_activate();
			}
			restore_current_blog();
		} else {
			single_activate();
		}
	} else {
		single_activate();
	}
}
// Fired when the plugin is deactivated
function deactivate( $network_wide ) {
	if ( function_exists( 'is_multisite' ) && is_multisite() ) {
		if ( $network_wide ) {
			// Get all blog ids
			$blog_ids = self::get_blog_ids();
			foreach ( $blog_ids as $blog_id ) {
				switch_to_blog( $blog_id );
				single_deactivate();
			}
			restore_current_blog();
		} else {
			single_deactivate();
		}
	} else {
		single_deactivate();
	}
}

// Fired when a new site is activated with a WPMU environment
function activate_new_site( $blog_id ) {
	if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
		return;
	}
	switch_to_blog( $blog_id );
	single_activate();
	restore_current_blog();
}

// Get all blog ids of blogs in the current network that are active
function get_blog_ids() {
	global $wpdb;
	// get an array of blog ids
	$sql = "SELECT blog_id FROM $wpdb->blogs WHERE archived = '0' AND spam = '0' AND deleted = '0'";
	return $wpdb->get_col( $sql );
}

// Fired for each blog when the plugin is activated
function single_activate() {
	add_option('insert_youversion_settings_defaults', 'NIV.new', '', 'no');
}

// Fired for each blog when the plugin is deactivated
function single_deactivate() {
	// May need this down the road
}

// Set up the shortcode
function insert_youversion_shortcode_func($atts) {
	// Get values from the shortcode
	extract( shortcode_atts( array(
		'ref'=>'NIV.gen.1.1',
		'target'=>''
	), $atts) );
	// Get the global arrays
	$versions = Insert_YouVersion_Versions();
	$books = Insert_YouVersion_Books();
	// Get the defined defaults from options (0=version, 1=target)
	$defaults = explode('.', get_option('insert_youversion_settings_defaults', 'NIV.new'));
	// Split up the ref (0=version, 1=book, 2=chapter, 3=verse(s))
	$ref = explode('.',$ref);
	// Version in all caps
	$version = strtoupper($ref[0]);
	// Set the target
	if($target == '') {
		$target = $defaults[1];
	}
	if($target == 'new') {
		$target = 'target="_blank"';
	} elseif($target == 'self') {
		$target = 'target="_self"';
	}
	$show = '<a href="https://bible.com/'.$versions[$version]['yvid'].'/'.$ref[1].'.'.$ref[2].'.'.$ref[3].'.'.strtolower($versions[$version]['Short']).'" '.$target.'>'.$books[$ref[1]].' '.$ref[2].':'.$ref[3].'</a>';
	return $show;
}
add_shortcode( 'insert-youversion', 'insert_youversion_shortcode_func' );

?>