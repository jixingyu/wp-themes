<?php

class Xy_init {

	function __construct() {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_print_footer_scripts', array( $this, 'print_footer_scripts' ) );
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
		add_filter( 'wp_trim_excerpt', array( $this, 'new_excerpt_more' ) );

		if (is_admin()){
			// add_action('init', array( $this, 'my_admin_init'));
			// add_action('wp_dashboard_setup', array( $this, 'remove_dashboard_widgets' ));
			// add_action('admin_menu', array( $this, 'remove_menus'));
			// add_action('admin_init', array( $this, 'remove_submenu'));
		 //    add_filter('screen_options_show_screen', array( $this, 'remove_screen_options'));
		 //    add_filter('contextual_help', array( $this, 'remove_help'), 999, 3 );
		 //    add_filter("mce_buttons_3", array( $this, 'enable_more_buttons'));
		} else {
			add_action('init', array( $this, 'my_init_method'));
		}
	}

	function setup() {
		add_theme_support( 'post-thumbnails' );

		register_nav_menus( array(
			'navmain' => '头部导航',
			'navfooter' => '友情链接',
			'navfooterother' => '底部其它链接',
		) );
	}

	function my_init_method() {
		// wp_deregister_script( 'jquery' );
	}

	function enable_more_buttons($buttons) {
		$buttons[] = 'fontsizeselect';
		return $buttons;
	}

	function remove_menus() {
	    global $menu;
	    $restricted = array(
	        __('Dashboard'),
	        // __('Posts'),
	        // __('Media'),
	        __('Links'),
	        // __('Pages'),
	        // __('Appearance'),
	        __('Tools'),
	        // __('Users'),
	        // __('Settings'),
	        __('Comments'),
	        __('Plugins')
	    );
	    foreach ($menu as $key => $value) {
	    	$menu_name = $value[0];
	    	if ($p = strpos($menu_name, '<')) {
	    		if (in_array(substr($menu_name, 0, $p), $restricted)) {
	    			unset($menu[$key]);
	    		}
	    	} elseif (in_array($menu_name, $restricted)) {
    			unset($menu[$key]);
    		}
	    }
	}

	function remove_submenu() {
	    remove_submenu_page('options-general.php', 'options-discussion.php');
	    remove_submenu_page('options-general.php', 'options-writing.php');
	    remove_submenu_page('options-general.php', 'options-media.php');
	}

	function remove_screen_options(){
		return false;
	}
    function remove_help($old_help, $screen_id, $screen){
	    $screen->remove_help_tabs();
	    return $old_help;
	}

	function excerpt_length( $len ) {
		return 200;
	}

	function new_excerpt_more($excerpt) {
		return str_replace('[&hellip;]', '', $excerpt);
	}

	function my_admin_init() {
		add_post_type_support('page', array('excerpt'));
	    unregister_taxonomy_for_object_type('post_tag', 'post');
	}

	function remove_dashboard_widgets() {
		// Globalize the metaboxes array, this holds all the widgets for wp-admin
		global $wp_meta_boxes;

		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	}

	/**
	 * frontend enqueue scripts 
	 */
	function enqueue_scripts() {
		if ( ! is_admin() ) {
		}
	}

	function print_footer_scripts() {
		
	}
}

new Xy_init;
