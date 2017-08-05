<?php

class Uts_init {

	function __construct() {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_print_footer_scripts', array( $this, 'print_footer_scripts' ) );
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
		if (is_admin()){
			// add_action('init', array( $this, 'myprefix_unregister_tags'));
			// add_action('wp_dashboard_setup', array( $this, 'remove_dashboard_widgets' ));
			// add_action('admin_menu', array( $this, 'remove_menus'));
			// add_action('admin_init', array( $this, 'remove_submenu'));
		 //    add_filter('screen_options_show_screen', array( $this, 'remove_screen_options'));
		 //    add_filter('contextual_help', array( $this, 'remove_help'), 999, 3 );
		 //    add_filter("mce_buttons_3", array( $this, 'enable_more_buttons'));
		} else {
			// add_action('init', array( $this, 'my_init_method'));
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
		wp_deregister_script( 'jquery' );
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
	        __('Pages'),
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
			wp_enqueue_script( THEME_PREFIX . '-js-main', get_template_directory_uri() . '/js/main.js' );
		}
	}

	function print_footer_scripts() {
		$pic = isset( $th_options['index-pic'] ) ? true : false;
		if( is_home() && $pic ):
	?>
			<script>
			    $(function(){
			        //回调函数计数
			        <?php if ($pic) : ?>
			        $('.silder-box-3').mySilder({
			            width:250, //容器的宽度 必选参数!!!!!!
			            height:317, //容器的高度 必选参数!!!!!!
			            direction:'x',//滚动方向,默认X方向
			            few:1,//一次滚动几个，默认滚动1张
			            showFew:4, //显示几个,就不用调css了,默认显示一个
			            clearance:10, //容器之间的间隙，默认为 0
			            silderMode:'easeInBack' ,//滚动方式
			            timeGap:650,//动画间隙，完成一次动画需要多长时间，默认700ms
			            auto:false,//是否自动滚动 
			            autoTime:5, //自动滚动时，时间间隙，即多长滚动一次
			            buttonPre:'.silder-button.btl',//上一个，按钮
			            buttonNext:'.silder-button.btr',//下一个，按钮
			            jz:true //点击时，是否等待动画完成
			        });
					$(".overimg").live("click", function(){
						location.href = $(this).parent('li').find('a').eq(0).attr('href');
					});
			        $('.silder li').hover(function(){
			            var imgover = '<div class="overimg"><span class="overimg-icon"></span><div>';
			            $(this).append(imgover);
			        },function(){
			            $(this).find('.overimg').remove();
			        });
			        <?php endif; ?>
			    });
			</script>
	<?php
		endif;	
	}
}

new Uts_init;
