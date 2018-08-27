<?php
switch( $type ) {	
	case 'text':
		echo '<input type="text" id="' . $id . '" class="form-text' . $class . '" name="' . $name . '" value="' . esc_attr( $value ) . '" maxlength="' . $maxlength . '" />'; 
		break;
	case 'textarea':
		echo '<textarea type="textarea" id="' . $id . '" class="form-textarea' . $class . '" name="' . $name . '" >' . $value . '</textarea>'; 
		break;			
	case 'hidden':
		echo '<input type="hidden" id="' . $id . '" class="form-hidden' . $class . '" name="' . $name . '" value="' . esc_attr( $value ) . '" />';
		break;
	case 'password':
		echo '<input type="password" id="' . $id . '" class="form-password' . $class . '" name="' . $name . '" value="' . esc_attr( $value ) . '" maxlength="' . $maxlength . '" />'; 
		break;
	case 'radio':
		foreach( $values as $val => $text ) {
			echo '<input type="radio" id="' . $id . '" class="form-radio' . $class . '" name="' . $name . '" value="' . esc_attr( $val ) . '" ' . checked( $val, $option, false ) . '/> <span class="radio-span">' . $text . '</span> ';
		}
		break;
	case 'checkbox':
		foreach( $values as $val => $text ) {
			echo '<input type="checkbox" id="' . $id . '" class="form-checkbox' . $class . '" name="' . $name . '[]" value="' . esc_attr( $val ) . '" ' . checked( in_array( $val, (array) $option ), true, false ) . '/> <span class="checkbox-span">' . $text . '</span> '; 
		}
		break;
	case 'select':
		if( $values ) {
			echo '<select id="' . $id . '" class="form-select' . $class . '" name="' . $name . '">';
			foreach( $values as $val => $text ) {
				echo '<option value="' . esc_attr( $val ) . '" ' . selected( $val, $option , false ) . '>' . $text . '</option>';
			}
			echo '</select>';
		}
		break;
	case 'multiple':
		if( $values ) {
			echo '<select id="' . $id . '" class="form-multiple' . $class . '" name="' . $name . '[]" multiple>';
			foreach( $values as $val => $text ) {
				echo '<option value="' . esc_attr( $val ) . '" ' . selected( in_array( $val, (array) $option ), true , false ) . '>' . $text . '</option>';
			}
			echo '</select>';
		}
		break;
	case 'page':
		$args = array_merge( array( 
			'name' => $name,
			'id' => $id,
			'selected' => $option,
			'show_option_no_change' => '不显示',
			'echo' => false
		), $args );
		echo str_replace( '<select', '<select class="form-select dropdown-pages' . $class . '"', wp_dropdown_pages( $args ) );
		break;
	case 'user':
		$args = array_merge( array(
			'name' => $name,
			'id' => $id,
			'class' => 'form-select dropdown-users' . $class,
			'show_option_none' => '不显示',
			'show_option_all' => '所有',
			'selected' => $option
		), $args );
		wp_dropdown_users( $args );
		break;
 	case 'category':
		$args = array_merge( array( 
			'name' => $name,
			'id' => $id,
			'class' => 'form-select dropdown-categories' . $class,
			'show_option_none' => '不显示',
			'show_option_all' => '所有',
			'selected' => $option,
			'hide_empty' => false,
			'hierarchical' => true,
			'hide_if_empty' => true
		), $args );
		wp_dropdown_categories( $args );	
		break;
 	case 'tag':
		$args = array_merge( array( 
			'name' => $name,
			'id' => $id,
			'class' => 'form-select dropdown-tags' . $class,
			'show_option_all' => '所有',
			'show_option_none' => '不显示',
			'selected' => $option,
			'hide_empty' => false,
			'hierarchical' => true,
			'hide_if_empty' => true,
			'taxonomy' => 'post_tag'
		), $args );
		wp_dropdown_categories( $args );	
		break;
 	case 'bookmark':
		$args = array_merge( array( 
			'name' => $name,
			'id' => $id,
			'class' => 'form-select dropdown-links' . $class,
			'show_option_all' => '所有',
			'show_option_none' => '不显示',
			'selected' => $option,
			'hide_empty' => false,
			'hierarchical' => true,
			'hide_if_empty' => true,
			'taxonomy' => 'link_category'
		), $args );
		wp_dropdown_categories( $args );	
		break;
 	case 'nav':
		$args = array_merge( array( 
			'name' => $name,
			'id' => $id,
			'class' => 'form-select dropdown-navs' . $class,
			'show_option_all' => '所有',
			'show_option_none' => '不显示',
			'selected' => $option,
			'hide_empty' => false,
			'hierarchical' => true,
			'hide_if_empty' => true,
			'taxonomy' => 'nav_menu'
		), $args );
		wp_dropdown_categories( $args );	
		break;
 	case 'format':
		$args = array_merge( array( 
			'name' => $name,
			'id' => $id,
			'class' => 'form-select dropdown-formats' . $class,
			'show_option_all' => '默认',
			'show_option_none' => '不显示',
			'selected' => $option,
			'hide_empty' => false,
			'hierarchical' => true,
			'hide_if_empty' => true,
			'taxonomy' => 'post_format'
		), $args );
		wp_dropdown_categories( $args );	
		break;
 	case 'taxonomy':
		if( ! taxonomy_exists( $taxonomy ) )
			return;
		$args = array_merge( array( 
			'name' => $name,
			'id' => $id,
			'class' => 'form-select dropdown-taxonomies' . $class,
			'show_option_all' => '所有',
			'show_option_none' => '不显示',
			'selected' => $option,
			'hide_empty' => false,
			'hierarchical' => true,
			'hide_if_empty' => true,
			'taxonomy' => $taxonomy
		), $args );
		wp_dropdown_categories( $args );	
		break;
	case 'editor':
		$args = array_merge( array(
			'textarea_name' => $name,
			'editor_class' => $class,
			'textarea_rows' => 5
		), $args );
		wp_editor( $value, $id, $args );
		break;
	case 'color':
		echo '<input type="text" id="' . $id . '" class="wp-color-picker' . $class . '" name="' . $name . '" value="' . esc_attr( $value ) . '" maxlength="7" />'; 
		break;
	case 'upload':
		echo '<input type="text" id="' . $id . '" class="media-upload-text form-text' . $class . '" name="' . $name . '" value="' . esc_attr( $value ) . '" maxlength="' . $maxlength . '" />&nbsp;<input id="' . $id . '-button" class="media-upload-button button-secondary" type="button" value="添加" />';
		break;
}