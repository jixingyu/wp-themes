<?php get_header(); ?>
<?php if (get_the_ID() == 1) :?>
	<?php get_template_part('cert/cert-search'); ?>
<?php else: ?>
	<div class="wrap">
	    <div class="main">
	        <?php get_sidebar(); ?>
		   	<div class="right">
		        <div class="content">
		            <div class="right-top-title">Hainan The Third Construction <br>Engineering Co., Ltd.</div> 
		        	<?php if( get_post_type() =='post' ) : $cats = get_the_category(); ?>
		            <div class="title-nav">
		            	<div  class="title-nav-left"><span class="left-line-bold"></span><?php echo $cats[0]->name; ?></div>
		            	<div  class="title-nav-right"><?php xy_breadcrumb(); ?></span></div>
		            </div>
		            <?php endif; ?>
		            <div class="article-box">
						<?php while( have_posts() ): the_post(); ?>
							<h2><?php the_title(); ?></h2>
							<?php the_content(); ?>
						<?php endwhile; ?>
		            </div>
		        </div>
		    </div>
		    <!-- right end -->
	    </div>
	</div>
<?php endif; ?>
<?php get_footer(); ?>