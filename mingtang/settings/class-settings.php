<?php

Class Xy_Settings {
	
	/**
	 * Properties
	 */
	public $prefix;
	protected $path;
	protected $menus;
	public $option_name;
	public $option_val;
	public $hook_suffix;
	protected $section_text;
	protected $datas_file;
	
	/**
	 * Set propreties
	 * Class arguments
	 */
	function properties() {
		$this->prefix = THEME_PREFIX;	// Set prefix
		$this->path = get_template_directory_uri() . '/settings';	// Set function files path
		$this->menus = array(		// Set menus arguments
			'top_title' => '网站设置',
			'type' => 'menu',
			'page_title' => '网站设置',
			'menu_title' => '网站设置',
			'capability' => 'manage_options',
			'menu_slug' => $this->prefix . '_theme_settings',
			'icon_url' => '',	// Only for menu
			'position' => null,	// Only for menu
			'screen_icon' => '',	// Only for menu or submenu
			'parent_slug' => ''	// Only for submneu
		);
		$this->option_name = $this->prefix . '_theme_settings';		// Set option name
		$this->datas_file = 'data.php';			// Set datas file name		
	}	
	
	/**
	 * Hooks
	 */
	function __construct() {
		// Properties
		$this->properties();
		$this->option_val = get_option( $this->option_name );
		// Hooks
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_notices', array( $this, 'update_notices' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}
	
	/**
	 * Add admin menu assign to page
	 */
	function add_admin_menu() {
		switch( $this->menus['type'] ) {
			case 'dashboard':
				$this->hook_suffix = add_dashboard_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;
			case 'posts':
				$this->hook_suffix = add_posts_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;
			case 'media':
				$this->hook_suffix = add_media_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;
			case 'links':
				$this->hook_suffix = add_links_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;
			case 'pages':
				$this->hook_suffix = add_pages_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;
			case 'comments':
				$this->hook_suffix = add_comments_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;																				
			case 'appearance':
				$this->hook_suffix = add_theme_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;
			case 'plugins':
				$this->hook_suffix = add_plugins_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;	
			case 'users':
				$this->hook_suffix = add_users_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;
			case 'tools':
				$this->hook_suffix = add_management_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;															
			case 'options':
				$this->hook_suffix = add_options_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;
			case 'menu':
				$this->hook_suffix = add_menu_page( $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ), $this->menus['icon_url'], $this->menus['position'] );
				break;
			case 'submenu':
				$this->hook_suffix = add_submenu_page( $this->menus['parent_slug'], $this->menus['page_title'], $this->menus['menu_title'], $this->menus['capability'], $this->menus['menu_slug'], array( $this, 'menu_page' ) );
				break;												
		}
		
	}
	
	/**
	 * Content on menu page
	 */
	function menu_page() {
	?>
		<div id="settings-container" class="wrap">
			<?php 
				screen_icon( $this->menus['screen_icon'] );
			?>
			<h2><?php echo $this->menus['top_title']; ?></h2>
			<form method="post" action="options.php">
			<?php $settings = $this->datas(); ?>
			<div id="tabs-wrap">
				<?php if( 1 < count( $settings ) && is_array( $settings ) ): ?>
				<ul>
					<?php 
						if( $settings ):
							$t = 1;
							foreach( $settings as $tab => $datas ): 
					?>
					<li><a href="#tabs-<?php echo $t; ?>" tab="<?php echo $t - 1; ?>"><?php echo $tab; ?></a></li>
					<?php 
								$t++;
							endforeach;
						endif; 
					?>
				</ul>
				<?php endif; ?>
				<?php
					settings_fields( $this->option_name . '_group' );
					if( $settings ) {
						$n = 1;
						foreach( $settings as $datas ) {
							echo '<div id="tabs-' . $n . '">';
							do_settings_sections( $this->menus['menu_slug'] . '-' . $n );
							echo '</div>';
							$n++;
						}
					}
					submit_button();
				?>
			</div>
			</form>
		</div>
		<br class="clear">
	<?php		
	}
	
	/**
	 * Require datas and return
	 */
	function datas() {
		require( $this->datas_file );
		return $settings;
	}
	
	/**
	 * Register settings
	 */
	function register_settings() {
		register_setting( $this->option_name . '_group', $this->option_name, array( $this, 'sanitize' ) );
		// Get datas
		$settings = $this->datas();
		if( empty( $settings ) )
			return;
		$t = 1;
		foreach( $settings as $datas ) {
			// Foreach datas to add section and field
			foreach( $datas as $section_id => $data ) {
				$section_id = $this->option_name . '_' . $section_id;
				$section_title = isset( $data['section_title'] ) ? $data['section_title'] : '';
				$this->section_text[] = isset( $data['section_text'] ) ? $data['section_text'] : '';
				add_settings_section( $section_id, $section_title, array( $this, 'section' ), $this->menus['menu_slug'] . '-' .$t );		// Add section
				$i = 1;
				if( empty( $data ) )
					continue;
				foreach( $data as $field ) {
					if( ! is_array( $field ) )
						continue;
					$label = $field['label'];
					$field[ 'label_for' ] = isset( $field['id'] ) ? $this->prefix . '-' . $field['id'] : $this->prefix . '-' . $field['name'];
					add_settings_field( $this->option_name . '_field_id_' . $i, $label, array( $this, 'fields' ), $this->menus['menu_slug'] . '-' . $t, $section_id, $field );		// Add field
					$i++;				
				}
			}
			$t++;
		}
	}
	
	/**
	 * Sanitize the option's value
	 */
	function sanitize( $input ) {
		return $input;
	}
	
	/**
	 * Settings section content
	 */
	function section() {
		static $j = 0;
		echo '<p class="section-text">' .$this->section_text[ $j ] . '</p>';
		$j++;
	}
	
	/**
	 * Add settings fields
	 */
	function fields( $args ) {
		global $th_fields;
		echo '<div class="field-wrap field-wrap-' . $args['type'] . '">';
		$th_fields->do_fields( $this->option_name, $this->option_val, $args, true );
		$tips = isset( $args['tips'] ) ? $args['tips'] : '';
		if( $tips )	 {
			echo '<img class="help" src="' . $this->path . '/images/help.png' . '" tips="' . esc_attr( $tips ) . '" />';
		}
		echo '</div>';
		$des = isset( $args['des'] ) ? $args['des'] : '';
		if( $des )
			echo '<p class="description">' . $des . '</p>';
	}
	
	/**
	 * Show notices when update
	 */	
	function update_notices() {
		global $hook_suffix;
		if( isset( $this->menus['parent_slug'] ) && 'options-general.php' == $this->menus['parent_slug'] )
			return;
		if( $hook_suffix == $this->hook_suffix && 'options' != $this->menus['type'] )
			settings_errors();
	}
	
	/**
	 * Admin enqueue scripts
	 */
	function enqueue_scripts( $hook ) {
		if( $hook != $this->hook_suffix )
			return;
		// Main style and js
		wp_enqueue_style( $this->prefix . '-settings-style', $this->path . '/scripts/style.css' );
		wp_enqueue_script( $this->prefix . '-settings-js', $this->path . '/scripts/script.js' );
		// Bubble popup
		wp_enqueue_style( $this->prefix . '-settings-bubble-popup-style', $this->path . '/scripts/jquery-bubble-popup-v3/css/jquery-bubble-popup-v3.css' );
		wp_enqueue_script( $this->prefix . '-settings-bubble-popup-js', $this->path . '/scripts/jquery-bubble-popup-v3/scripts/jquery-bubble-popup-v3.min.js', '', '', true );
		wp_localize_script( $this->prefix . '-settings-bubble-popup-js', 'bubblePopup', array( 'imagePath' => $this->path . '/scripts/jquery-bubble-popup-v3/jquerybubblepopup-themes' ) );
		// Jquery tab
		wp_enqueue_style( $this->prefix . '-settings-jquery-ui-tabs', $this->path . '/scripts/jquery.ui.tabs.css' );
		wp_enqueue_script( 'jquery-ui-tabs' );
	}
}

new Xy_Settings;