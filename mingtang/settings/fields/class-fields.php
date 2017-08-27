<?php

class Xy_Fields {
	
	/**
	 * Hook
	 */
	function __construct() {
		$this->prefix = THEME_PREFIX;		// Set prefix
		$this->page_hooks = array( 'toplevel_page_' . $this->prefix . '_theme_settings', 'post.php', 'post-new.php' );		// Set all admin page hooks (array)
		$this->path = get_template_directory_uri() . '/settings/fields';		// Set function files path
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}
	
	/**
	 * Make all fields in form
	 */
	function do_fields( $option_name, $option_val, $data, $multi = true ) {
		/* require_once( 'data.php' ); */
		if( empty( $data ) )
			return;
		// Extract and merge $data and $default
		$default = array(
			'type' => 'text',
			'name' => '',
			'id' => '',
			'value' => '',
			'maxlength' => '',
			'class' => '',
			'key' => '',
			'values' => array(),
			'args' => array(),
			'output_id' => 'off'
		);
		$data = wp_parse_args( $data, $default );
		extract( $data );
		// Id and class
		if( empty( $id ) )
			$id = $this->prefix . '-' . $name;
		else
			$id = $this->prefix . '-' . $id;
		if( ! empty( $class ) )
			$class = ' ' . $class;
		// Option name and value filter
		if( true == $multi ) {
			$option_val = isset( $option_val[ $name ] ) ? $option_val[ $name ] : NULL;
			$name = $option_name . '[' . $name . ']';
		}		
		// Edit $value and $option		
		if( 'radio' == $type || 'checkbox' == $type ) {
			$option = ( isset( $checked ) ) ? $checked : '';
			$option = isset( $option_val ) ? $option_val : $option;
		} elseif( in_array( $type, array( 'select', 'multiple', 'page', 'user', 'category', 'tag', 'link', 'nav', 'format', 'taxonomy' ) ) ) {
			$option = ( isset( $selected ) ) ? $selected : '';
			$option = isset( $option_val ) ? $option_val : $option;
		} else {
			$value = isset( $option_val ) ? $option_val : $value;
		}
		// Require fields.php file
		require( 'fields.php' );
	}
	
	/**
	 * Load enqueue scripts
	 */
	function admin_enqueue_scripts( $hook ) {
		if( in_array( $hook, $this->page_hooks ) ) {
			// Fields js
			wp_enqueue_script( $this->prefix . '-fields', $this->path . '/scripts/fields-script.js' );
			// Wp color picker
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			// media upload scripts		
			wp_enqueue_media();
		}
	}
	
}

$th_fields = new Xy_Fields;