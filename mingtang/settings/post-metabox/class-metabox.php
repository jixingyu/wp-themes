<?php

class _Meta_Box {
	
	/**
	 * Properties
	 */
 	protected $prefix;
	// add_meta_box arguments
	protected $id = '';
	protected $title = '';
	protected $type = '';
	protected $context = '';
	protected $priority = '';
	protected $key = '';	// Post meta key
	
	/**
	 * Init
	 */
	function init() {		
	}
	
	/**
	 * Hook
	 */
	function __construct() {
		$this->prefix = THEME_PREFIX;
		$this->id = $this->prefix . '-' . $this->id;
		$this->key = '_' . $this->prefix . '_' . $this->key;		
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'metabox_enqueue_scripts' ) );
	}
	
	/**
	 * Add meta box
	 */
	function add_meta_box() {
		$this->init();
		add_meta_box( $this->id, $this->title, array( $this, 'meta_form' ), $this->type, $this->context, $this->priority );
	}
	
	/**
	 * Save meta data
	 */
	function save( $post_id ) {
		if( !current_user_can( 'edit_' . $this->type, $post_id ) )
			return;
		if( !isset( $_POST[ $this->id . '_wpnonce'] ) || !wp_verify_nonce( $_POST[ $this->id . '_wpnonce'], $this->id . '_nonce_action' ) )
			return;
		// Update
		update_post_meta( $post_id, $this->key, $_POST[ $this->key ] );
	}
	
	/**
	 * Meta form
	 */
	function meta_form( $post ) {
		wp_nonce_field( $this->id . '_nonce_action', $this->id . '_wpnonce' );
		$pid = $post->ID;
		$value = get_post_meta( $pid, $this->key, true );
		$name = $this->key;
		require_once( 'data.php' );
		$this->do_fields( $name, $value, $datas );
	}	
	
	/**
	 * Do fields
	 */
	function do_fields( $name, $value, $datas ) {
		global $th_fields;
		if( $datas ) {
			foreach( $datas as $data ) {
				echo '<p class="dx-metabox-item">';
			if( ! isset( $data['id'] ) || empty( $data['id'] ) )
				$id = $this->prefix . '-' . $data['name'];
			else
				$id = $this->prefix . '-' . $id;
			echo '<label for="' . $id . '">' . $data['label'] . ': </label>';
			$th_fields->do_fields( $name, $value, $data );
			echo '</p>';
			}
		}
	}
	
	/**
	 * Load Metabox enqueue scripts
	 */
	function metabox_enqueue_scripts( $hook_suffix ) {
		global $post_type;
		if( $this->type == $post_type && ( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) ) {
			wp_enqueue_style( $this->prefix . 'post-metabox-css', get_template_directory_uri() . '/functions/post-metabox/style.css' );
		}
	}
	
}

class _Post_Meta_Box extends _Meta_Box {
	/**
	 * Properties
	 */
 	protected $prefix;
	protected $id = 'top-pic';
	protected $title = '';
	protected $type = 'post';
	protected $context = 'normal';
	protected $priority = 'high';
	protected $key = 'top_pic';
	
	/**
	 * Init
	 */
	function init() {	
		$this->title = '头部图像';	
	}	
}

new _Post_Meta_Box;