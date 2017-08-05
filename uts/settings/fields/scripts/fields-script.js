jQuery(document).ready(function($){
	
	/* media upload */
	var _custom_media = true,
		_orig_send_attachment = wp.media.editor.send.attachment;
	
	$( '.media-upload-button' ).live( 'click', function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var sInput = $(this).prev( 'input.media-upload-text' );
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				sInput.val(attachment.url);		// Insert url
				if( 'on' == sInput.attr( 'output_id' ) ) {
					var sAttHidden = '<input type="hidden" name="' + sInput.attr( 'name' ).replace( ']', '-id]' ) + '" value="' + attachment.id + '"/>';
					sInput.after( sAttHidden );		// Insert id
				}
			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}	
		wp.media.editor.open( $(this) );
		return false;
	});
	$('.add_media').on('click', function(){
		_custom_media = false;
	});	
	
	/* color picker */
	$('.wp-color-picker').wpColorPicker();
	
});