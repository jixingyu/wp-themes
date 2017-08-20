<?php get_header(); ?>
<?php
	global $wp_query;
	$cat_option = get_option( THEME_PREFIX . '_cat_options_' . $wp_query->queried_object_id );
	$tmp = ( is_category() && isset( $cat_option['template'] ) ) ? $cat_option['template'] : 'default';
	if ( $tmp == 'picture' ) :
?>
	
	<?php else : ?>
	
	</div>
	<?php endif; ?>
<?php get_footer(); ?>

