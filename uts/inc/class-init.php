<?php

class Uts_init {

	function __construct() {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_print_footer_scripts', array( $this, 'print_footer_scripts' ) );
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
		add_action( 'wp_ajax_nopriv_xy_more_posts', array($this, 'xy_more_posts') );
		add_action( 'wp_ajax_xy_more_posts', array($this, 'xy_more_posts') );
		if (is_admin()){
			// add_action('init', array( $this, 'myprefix_unregister_tags'));
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
			'navfooter' => '底部导航',
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

	function myprefix_unregister_tags() {
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
			wp_enqueue_style( THEME_PREFIX . '-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css' );
			wp_enqueue_style( THEME_PREFIX . '-main-css', get_template_directory_uri() . '/css/main.css' );
			wp_enqueue_script( THEME_PREFIX . '-js-jquery', get_template_directory_uri() . '/js/jquery-1.10.2.min.js' );
			wp_enqueue_script( THEME_PREFIX . '-js-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js' );
			wp_enqueue_script( THEME_PREFIX . '-js-main', get_template_directory_uri() . '/js/main.js', array(), false, true);
		}
	}

	function print_footer_scripts() {
		
	}

	function xy_more_posts() {
		$response = array( 'code' => 1 );
		$paged = (int) $_GET['p'];
		$limit = (int) $_GET['l'];
		if ($limit < 1) $limit = 5;
		if ($limit > 20) $limit = 20;
		if ($paged < 1) $paged = 1;

		$args = array('cat' => (int)$_GET['cat'], 'posts_per_page' => $limit, 'paged' => $paged);
		query_posts($args);
		$result = array();
		while ( have_posts() ) {
			the_post();
			$jsonpost['id'] = get_the_ID();
			$jsonpost['title'] = get_the_title();
			$jsonpost['url'] = apply_filters('the_permalink', get_permalink());
			$jsonpost['img'] = xy_thumb();
			if (has_excerpt()) {
				$jsonpost["content"] = mb_strimwidth(strip_tags(get_the_excerpt()), 0, 400,"...", 'utf-8');
			} else{
				$jsonpost["content"] = mb_strimwidth(strip_tags(get_the_content()), 0, 400,"...", 'utf-8');
			}
			$jsonpost["date"] = get_the_time('Y-m-d');
			$jsonpost['views'] = xy_post_views('', '', 0);
			$result[] = $jsonpost;
		}
		$response['data'] = $result;
		header( 'Content-Type: application/json' );
		echo json_encode($response);
		exit;
	}
}

new Uts_init;
