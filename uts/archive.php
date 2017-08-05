<?php get_header(); ?>
<?php
	global $wp_query;
	$cat_option = get_option( THEME_PREFIX . '_cat_options_' . $wp_query->queried_object_id );
	$tmp = ( is_category() && isset( $cat_option['template'] ) ) ? $cat_option['template'] : 'default';
	if ( $tmp == 'picture' ) :
?>
	<div class="wrap">
	    <div class="main">
			<?php get_sidebar(); ?>
	        <div class="right">
	            <div class="content">
	                <div class="silder slider-list">
	            		<ul>
							<?php if( have_posts() ): ?>
								<?php while( have_posts() ): the_post(); $ilink = get_the_permalink();?>
	                        <li>
	                            <div class="img-up"><a href="<?php echo $ilink;?>" target="_blank"><img src="<?php echo xy_thumb();?>"></a></div>
	                            <div class="desc-text">
	                                <a href="<?php echo $ilink;?>" target="_blank"><h4><?php the_title();?></h4></a>
	                                <a href="<?php echo $ilink;?>" target="_blank"><div class="js-while-ellipsis"><?php the_excerpt();?></div></a>
	                            </div>
	                        </li>
								<?php endwhile; ?>
							<?php else: ?>
								<div class="noList">无记录</div>
							<?php endif; ?>
	                    </ul>
	                </div>
	                <?php xy_paginate();?>
	            </div>
	        </div>
		    <!-- right end -->
	    </div>
	</div>
	<script>
	    $(function(){
			$(".overimg").live("click", function(){
				location.href = $(this).parent('li').find('a').eq(0).attr('href');
			});
	        $('.silder li').hover(function(){
	            var imgover = '<div class="overimg"><span class="overimg-icon"></span><div>';
	            $(this).append(imgover);
	        },function(){
	            $(this).find('.overimg').remove();
	        });
	    });
	</script>
	<?php else : ?>
	<div class="wrap mainNews">
	    <div class="main">
			<?php get_sidebar(); ?>

		   	<div class="right">
		        <div class="content">
		            <div class="right-top-title">Hainan The Third Construction <br>Engineering Co., Ltd.</div>
		            <?php if ($wp_query->queried_object) : ?>
		            <div class="title-nav">
		            	<div  class="title-nav-left"><span class="left-line-bold"></span><?php echo $wp_query->queried_object->name; ?></div>
		            	<div  class="title-nav-right"><?php xy_breadcrumb(); ?></div>
		            </div>
		        	<?php endif; ?>
		            <div class="list-content">
						<?php if( have_posts() ): ?>
		            	<div class="th-content">
		            		<div class="newsLeftListLi">标题</div>
		            		<div class="th-content-right">发布日期</div>
		            	</div>
		            	<div class="td-content">
		            	    <ul>
								<?php while( have_posts() ): $idateformat = get_option('date_format'); the_post(); ?>
		            	    	<li>
		            	    		<div class="newsLeftListLi"><span class="radius-tip">●</span><a href="<?php the_permalink();?>" target="_blank"><?php the_title(); ?></a></div>
		            				<div class="th-content-right"><?php the_time( $idateformat ); ?></div>
		            	    	</li>
								<?php endwhile; ?>
		            	    </ul>
		            	</div>
		            </div>
					<?php else: ?>
						<div class="noList">无记录</div>
					<?php endif; ?>
		            <?php xy_paginate();?>
		        </div>
		    </div>
		    <!-- right end -->
	    </div>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>

