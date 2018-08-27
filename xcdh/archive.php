<?php get_header(); ?>

<?php
    $cat_ID = get_query_var('cat');
    $cur_cat = get_category($cat_ID);
?>
<div class="news_Container">
    <div class="newscon pageW">
        <div class="positon" ><?php xy_breadcrumb(); ?></div>
        <div class="news_wrap clearfix" style="min-height: 840px">
            <div class="newslist fl">
                <div class="newstab clearfix">
                    <ul>
                        <li class="cur"><?php echo $cur_cat->name;?></li>
                    </ul>
                </div>

                <?php if( have_posts() ): ?>
                <div class="newstabCon">
                    <div class="nc" style="display: block">
                        <ul>
                            <?php while( have_posts() ): the_post(); ?>
                            <li>
                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
                <div class="pagesize clearfix">
                  <?php xy_paginate();?>
                 <!--  <div class="arrow-left"></div>
                  <div class="page-number">1</div>
                  <div class="page-number"><a href="" class="cur">2</a></div>
                  <div class="page-number"><a href="">3</a></div>
                  <div class="arrow-right"></div> -->
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
