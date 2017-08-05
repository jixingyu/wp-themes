<?php
class Hn3j_Cat_Options {
	
	/**
	 * Properties
	 */
	protected $name;
	
	/**
	 * Hook
	 */
	function __construct() {
		$this->name = THEME_PREFIX . '_cat_options';
		add_action( 'edit_category_form', array( $this, 'form' ), 1 );
		add_action( 'edit_category', array( $this, 'update' ) );
		add_action( 'create_category', array( $this, 'update' ) );
	}
	
	/**
	 * Template select
	 */
	function dropdown_template( $val = '' ) {
		$tmp = isset( $val['template'] ) ? $val['template'] : 'default';
		$options = array(
			'default' => '文字模板',
			'picture' => '图片模板'
		);
		echo '<select name="' . $this->get_field_name( 'template' ) . '" id="' . $this->get_field_id( 'template' ) . '">';
		foreach( $options as $key => $option ) {
			echo '<option value="' . $key . '" ' . selected( $key, $tmp, false ) . '>' . $option . '</option>';
		}
		echo '</select>';
	}
	
	/**
	 * Add edit category form
	 */
	function form( $tag ) {
		require_once( 'edit-form.php' );
	}
	
	/**
	 * Update category edit data
	 */
	function update( $cid ) {
		if( isset( $_POST[ THEME_PREFIX . '_wpnonce' ] ) && wp_verify_nonce( $_POST[ THEME_PREFIX . '_wpnonce' ], THEME_PREFIX . 'cat_options' ) ) {
			update_option( $this->name . '_' . $cid, $_POST[ $this->name ] );
		}
	}
	
	/**
	 * Get field id
	 */
	function get_field_id( $id, $echo = false ) {
		$id = $this->name . '_' . $id;
		if( true == $echo )
			echo $id;
		else
			return $id;
	}
	
	/**
	 * Get field name
	 */
	function get_field_name( $name, $echo = false ) {
		$name = $this->name . "[$name]";
		if( true == $echo )
			echo $name;
		else
			return $name;
	}		
	
}

new Hn3j_Cat_Options;