<?php
define( 'THEME_PREFIX', 'uts' );
$th_options = get_option( THEME_PREFIX.'_theme_settings' );

// add_action('admin_init', 'xy_author_upload_image_limit');
// function xy_author_upload_image_limit(){
// 	//除管理员以外，其他用户都限制
// 	// if( !current_user_can( 'manage_options') )
// 		add_filter( 'wp_handle_upload_prefilter', 'xy_upload_image_limit' );
// }
// function xy_upload_image_limit( $file ){
// 	// 检测文件的类型是否是图片
// 	$mimes = array( 'image/jpeg', 'image/png', 'image/gif' );
// 	// 如果不是图片，直接返回文件
// 	if( !in_array( $file['type'], $mimes ) )
// 		return $file;
// 	if ( $file['size'] > 2097152 )
// 		$file['error'] = '图片太大了，请不要超过2M';
// 	return $file;
// }

add_filter('pre_site_transient_update_core',    create_function('$a', "return null;"));
add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;"));
add_filter('pre_site_transient_update_themes',  create_function('$a', "return null;"));
remove_action('admin_init', '_maybe_update_core');
remove_action('admin_init', '_maybe_update_plugins');
remove_action('admin_init', '_maybe_update_themes');

remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'publish_future_post', 'check_and_publish_future_post', 10, 1 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_footer', 'wp_print_footer_scripts' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

require_once( 'inc/class-session.php' );
require_once( 'inc/class-init.php' );
require_once( 'inc/class-nav-walker.php' );
require_once( 'settings/class-settings.php' );
require_once( 'settings/fields/class-fields.php' );
require_once( 'settings/cat-options/class-cat-options.php' );

function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2&d=mm" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');

function coolwp_remove_open_sans_from_wp_core() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style('open-sans','');
}
add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );

if (is_admin()) {
	add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');
	function add_featured_image_instruction( $content ) {
		return $content .= '<p>特色图像将用来作为缩略图，请务必选择超过 300*300 的图片。</p>';
	}
}

function xy_breadcrumb($theme_location = 'navmain', $separator = '') {

	$locations = get_nav_menu_locations();
	if (isset($locations[$theme_location])) {
	    $items = wp_get_nav_menu_items($locations[$theme_location]);
	    _wp_menu_item_classes_by_context( $items ); // Set up the class variables, including current-classes
	    $crumbs = array();

	    $item_array = array();
	    $match_item = false;
	    foreach($items as $item) {
	        if ($item->current_item_ancestor) {
	            $crumbs[] = "<li><a href=\"{$item->url}\">{$item->title}</a></li>";
	        } elseif ($item->current) {
	            $crumbs[] = "<li><a href=\"{$item->url}\">{$item->title}</a></li>";
	            break;
	        }
	        if ($item->current_item_parent == true) {
	        	$match_item = $item;
	        }
        	$item_array[$item->ID] = $item;
	    }
	    if (empty($crumbs) && $match_item) {
	    	while ($match_item->ID != $match_item->menu_item_parent) {
	    		array_unshift($crumbs, "<li><a href=\"{$match_item->url}\">{$match_item->title}</a></li>");
	    		if (!$match_item->menu_item_parent) {
	    			break;
	    		}
	    		$match_item = $item_array[$match_item->menu_item_parent];
	    	}
	    }
	    if (empty($crumbs)) {
	    	echo sprintf('<li><span class="left-line dis-min"></span>当前位置：<a href="%s">首页</a></li>', home_url());
	    } else {
	    	echo sprintf('<li><span class="left-line dis-min"></span>当前位置：<a href="%s">首页</a></li>%s%s', home_url(), $separator, implode($separator, $crumbs));
	    }
	}
}

function xy_paginate( $pages = false ) {
	$big = 999999999;
	$args = array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'type' => 'array',
	);
	if ($pages) {
		$args['total'] = $pages;
	}
	$pages_array = paginate_links($args);
	if( is_array( $pages_array ) ) {
        echo '<nav aria-label="Page navigation"><ul class="pagination">';
        foreach ( $pages_array as $page ) {
            echo "<li>$page</li>";
        }
        echo '</ul></nav>';
    }
}

function xy_thumb( $args = array() ) {
	global $post;
	$defaults = array(
		'size' => 'thumbnail',	// Image size, same to function the_post_thumbnail() $size argument
		'pid' => $post->ID,		// Post id
		'order' => 'ASC',	// ASC or DESC
		'orderby' => 'ID',	// Id or rand
		'content' => $post->post_content,	// content for preg_match()
		'output' => 'src',	// Show img html tag or src attribute
		'num' => -1	// Show images number ( -1 : get first image(strig); 1 : get one image by order and orderby arguments; 0 : get all images; numeric : get specified images )
	);
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	$child_args = array( 
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'post_parent' => $pid,
		'order' => 'ASC',
		'orderby' => 'ID'
	);
	// Get thumbnails
	if( -1 == $num ) {
		// Get one image
		$res = '';
		if( has_post_thumbnail( $pid ) ) {		// First to get post thumbnail
			if( 'src' == $output ) {
				$src = wp_get_attachment_image_src( get_post_thumbnail_id( $pid ), $size );
				if( isset( $src[0] ) && $src[0] )
					$res = $src[0];			
			} else {
				$res = get_the_post_thumbnail( $pid, $size );
			}
		} elseif( $att_images = get_children( $child_args ) ) {		// Second to get attachment image
			$attachment_id = key( $att_images );
			if( 'src' == $output ) {
				$src = wp_get_attachment_image_src( $attachment_id, $size );
				if( isset( $src[0] ) && $src[0] )
					$res = $src[0];			
			} else {
				$res = wp_get_attachment_image( $attachment_id, $size );
			}
		} else {		// Last to get content img
			if( 'src' == $output ) {
				preg_match( '/<img.*?src=["\'](.*?)["\'].*?>/i', $content, $matches );
				if( isset( $matches[1] ) && $matches[1] )
					$res = $matches[1];	
			} else {
				preg_match( '/<img.*?>/i', $content, $matches );
				if( isset( $matches[0] ) && $matches[0] )
					$res = $matches[0];		
			}
		}
	} else {
		// Get many images
		$res = array();
		if( $att_images = get_children( $child_args ) ) {		// Attachment
			foreach( $att_images as $attachment_id => $att_image ) {
				if( 'src' == $output ) {
					$src = wp_get_attachment_image_src( $attachment_id, $size );
					if( isset( $src[0] ) && $src[0] )
						$res[] = $src[0];						
				} else {
					$res[] = wp_get_attachment_image( $attachment_id, $size );
				}
			}
		} else {	// Content
			if( 'src' == $output ) {
				preg_match_all( '/<img.*?src=["\'](.*?)["\'].*?>/i', $content, $matches );
				if( isset( $matches[1] ) && $matches[1] )
					$res = $matches[1];	
			} else {
				preg_match_all( '/<img.*?>/i', $content, $matches );
				if( isset( $matches[0] ) && $matches[0] ) {
					$res = $matches[0];
				}
			}				
		}		 
	}
	// Set order, orderby and num
	if( 'DESC' == $order && is_array( $res ) && ! empty( $res ) ){
		$res = array_reverse( $res );
	}
	if( 'rand' == $orderby && is_array( $res ) && ! empty( $res ) ) {
		shuffle( $res );
	}
	if( is_array( $res ) && ! empty( $res ) && -1 != $num && 0 != $num ) {
		$res = array_slice( $res, 0, $num );
	}
	if( is_array( $res ) && ! empty( $res ) && 1 == $num ) {
		$res = $res[0];
	}	
	// Return
	return $res;
}

//文章页上一篇下一篇导航
function xy_post_nav(){

	$previous = get_previous_post_link( '<p class="float-l">%link</p>', '上一篇：%title', true );
	$next = get_next_post_link( '<p class="float-r">%link</p>', '下一篇：%title', true );

	if ( ( ! $next && ! $previous ) || is_attachment() ) {
		return;
	}

	?><div class="preornext">
		<?php echo $previous . $next;?>
	</div><?php
}

/* 访问计数 */
function xy_record_visitors()
{
	if (is_singular()) {
		global $post;
		$post_ID = $post->ID;
		if ($post_ID) {
			$post_views = (int)get_post_meta($post_ID, 'views', true);
			if (!update_post_meta($post_ID, 'views', ($post_views+1))) {
				add_post_meta($post_ID, 'views', 1, true);
			}
		}
	}
}
add_action('wp_head', 'xy_record_visitors');
/// 函数作用：取得文章的阅读次数
function xy_post_views($before = '', $after = '', $echo = 1)
{
	global $post;
	$post_ID = $post->ID;
	$views = (int)get_post_meta($post_ID, 'views', true);
	if ($echo) echo $before, number_format($views), $after;
	else return $views;
}

function xy_most_viewed_format($term_id = 0, $echo = true, $limit = 5, $mode = '') {
	global $wpdb, $post;
	$output = '';
	$mode = ($mode == '') ? 'post' : $mode;
	$type_sql = ($mode != 'both') ? "AND post_type='$mode'" : '';
	$term_sql = (is_array($term_id)) ? "AND $wpdb->term_taxonomy.term_id IN (" . join(',', $term_id) . ')' : ($term_id != 0 ? "AND $wpdb->term_taxonomy.term_id = $term_id" : '');
	$term_sql.= $term_id ? " AND $wpdb->term_taxonomy.taxonomy != 'link_category'" : '';
	$inr_join = $term_id ? "INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)" : '';

	// database query
	$most_viewed = $wpdb->get_results("SELECT ID, post_date, post_title, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) $inr_join WHERE post_status = 'publish' AND post_password = '' $term_sql $type_sql AND meta_key = 'views' GROUP BY ID ORDER BY views DESC LIMIT $limit");
	if ($most_viewed) {
		foreach ($most_viewed as $viewed) {
			$post_ID    = $viewed->ID;
			$post_title = esc_attr($viewed->post_title);
			$post_permalink = esc_attr(get_permalink($post_ID));
            $output .= sprintf('<li><a href="%s" target="_blank" class="ellipsis">%s</a></li>', $post_permalink, $post_title);
		}
	}
	if ($echo) {
		echo $output;
	} else {
		return $output;
	}
}

?>