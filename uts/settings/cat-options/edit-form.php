<?php
if( isset( $_GET['action'] ) && 'edit' == $_GET['action'] ):
	$val = get_option( $this->name . '_' . $tag->term_id );
?>

	<table class="form-table">
		<tbody>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php $this->get_field_id( 'template', true ); ?>">分类模板</label></th>
				<td><?php $this->dropdown_template( $val ); ?></td>
			</tr>
		</tbody>
	</table>
	<?php wp_nonce_field( THEME_PREFIX . 'cat_options', THEME_PREFIX . '_wpnonce' ); ?>

<?php else: ?>

	<div class="form-field">
		<label for="<?php $this->get_field_id( 'template', true ); ?>">分类模板</label>
		<?php $this->dropdown_template(); ?>
	</div>
	<?php wp_nonce_field( THEME_PREFIX . 'cat_options', THEME_PREFIX . '_wpnonce' ); ?>

<?php endif; ?>
