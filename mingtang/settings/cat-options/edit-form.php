<?php
if( isset( $_GET['action'] ) && 'edit' == $_GET['action'] ):
	$val = get_option( $this->name . '_' . $tag->term_id );
	$top_pic = isset( $val['top-pic'] ) ? $val['top-pic'] : '';
?>

	<table class="form-table">
		<tbody>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php $this->get_field_id( 'template', true ); ?>">分类模板</label></th>
				<td><?php $this->dropdown_template( $val ); ?></td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php $this->get_field_id( 'top-pic', true ); ?>">头部图像</label></th>
				<td>
					<input class="media-upload-text" name="<?php $this->get_field_name( 'top-pic', true ); ?>" id="<?php $this->get_field_id( 'top-pic', true ); ?>" type="text" style="width: 70%;" value="<?php echo esc_attr( $top_pic ); ?>"/>
					<input class="media-upload-button button-secondary" id="" type="button" value="上传" style="width:auto;"/>
					<?php wp_nonce_field( THEME_PREFIX . 'cat_options', THEME_PREFIX . '_wpnonce' ); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php wp_nonce_field( THEME_PREFIX . 'cat_options', THEME_PREFIX . '_wpnonce' ); ?>

<?php else: ?>

	<div class="form-field">
		<label for="<?php $this->get_field_id( 'template', true ); ?>">分类模板</label>
		<?php $this->dropdown_template(); ?>
	</div>
	<div class="form-field">
		<label for="<?php $this->get_field_id( 'top-pic', true ); ?>">头部图像</label>
		<input class="media-upload-text" name="<?php $this->get_field_name( 'top-pic', true ); ?>" id="<?php $this->get_field_id( 'top-pic', true ); ?>" type="text" style="width: 70%;" value=""/>
		<input class="media-upload-button button-secondary" id="" type="button" value="上传" style="width:auto;"/>
	</div>
	<?php wp_nonce_field( THEME_PREFIX . 'cat_options', THEME_PREFIX . '_wpnonce' ); ?>

<?php endif; ?>

<?php wp_enqueue_media(); ?>

<script type="text/javascript">
jQuery(document).ready(function($){
	var _custom_media = true,
		_orig_send_attachment = wp.media.editor.send.attachment;
	
	$('.media-upload-button').click(function(e) {
	  var send_attachment_bkp = wp.media.editor.send.attachment;
	  var sInput = $(this).prev( 'input' );
	  _custom_media = true;
	  wp.media.editor.send.attachment = function(props, attachment){
		if ( _custom_media ) {
		  sInput.val(attachment.url);
		} else {
		  return _orig_send_attachment.apply( this, [props, attachment] );
		};
	  }
	
	  wp.media.editor.open( $(this) );
	  return false;
	});
});
</script>
