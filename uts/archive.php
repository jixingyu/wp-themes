<?php get_header(); ?>

<?php
  $hot_cat_id = ( isset( $th_options['news-hot'] ) && $th_options['news-hot'] ) ? $th_options['news-hot'] : '';
  global $wp_query;
  $cat_option = get_option( THEME_PREFIX . '_cat_options_' . $wp_query->queried_object_id );
  $tmp = ( is_category() && isset( $cat_option['template'] ) ) ? $cat_option['template'] : 'default';
  $cat_ID = get_query_var('cat');
  $cur_cat = get_category($cat_ID);
  if ( $tmp == 'picture' ) :
?>
  <style>
    @media screen and (max-width: 450px) {
      .pagination>li>a, .pagination>li>span{
        padding:6px 7px;
      }
    }
  </style>
<?php endif; ?>

<!-- banner -->
<div class="banner">
  <h3>极速物流·完整供应链·助力智慧物流</h3>
  <img alt="" src="<?php echo empty($th_options['head-banner-img']) ? get_bloginfo('template_url') . '/img/long-banner.jpg' : $th_options['head-banner-img'];?>" class="bannerimg"/>
</div>
<div class="navbussies navbussies-case">
  <div class="bussiescont ">
    <ul>
      <li class="active">
        <a href="Javascript: void(0)">
          <h4><?php echo $cur_cat->name;?></h4>
        </a>
      </li>
    </ul>
  </div>
</div>
<div class="clear"></div>
<?php if ( $tmp == 'picture' ) : ?>
  <?php if( have_posts() ): ?>
    <div class="bussiescont-case">
      <ul>
        <?php while( have_posts() ): the_post(); ?>
        <li>
          <div class="caselistdiv">
            <img src="<?php echo xy_thumb();?>" title="<?php the_title(); ?>">
            <a href="<?php the_permalink();?>" target="_blank"><div class="casetitle"><?php the_title(); ?></div></a>
          </div>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>
    <div class="col-md-12 center pagefooter">
      <?php xy_paginate();?>
    </div>
  <?php endif;?>
<?php else : ?>
    <?php if( have_posts() ): ?>
    <div class="bgf8"> 
      <div class="bussiescont newslist">
          <ul id="newslist">
          </ul>
          <div class="center loading" >
            <img src="<?php bloginfo('template_url');?>/img/loading.gif" alt="" />
          </div>
          <div class="getmore" id="getmore">
            <span class="iconspng icon-down"></span>
          </div>
      </div>
    </div> 
    <div class="hotlist">
      <div class="hotnews">
        <h5>热门新闻</h5>
        <ol>
          <?php xy_most_viewed_format($hot_cat_id);?>
        </ol>
      </div>
    </div>
    <?php endif; ?>
<?php endif; ?>

<script>
(function(){
  var p=1,pz=5;html="",data={},hasMore=true;
  // 获取新闻列表
  getNewslist(p);
  $('#getmore').on('click',function(){
    p++;
    getNewslist(p);
  });

  function getNewslist(p){
    if (!hasMore) {
      return;
    }
    $.ajax({
     type: "GET",
     url: "http://local.uts.com/wp-admin/admin-ajax.php?action=xy_more_posts&cat=<?php echo $cat_ID;?>&l=" + pz + "&p="+p,
     dataType: "json",
     success: function(data){
        if(data.data.length > 0){
          $.each(data.data,function(i,item){
            var url = item.url,
                imgsrc = item.img,
                title = item.title,
                time = item.date, 
                view = 2200,
                content = item.content.substr(0,55)+"...";

            html+='<li><a href="'+url+'" target="_blank"><img src="'+imgsrc+'" alt=""  class="float-l"><div class="list-r-text"><h4 class="ellipsis">'+title+'</h4><div class="list-text-b"><span class="float-l pulishtime">发布时间：'+time+'</span><span class="float-l">阅读量：'+view+'</span></div><div class="list-text-con">'+content+'</div></div></a></li>';
          });
          $('.loading').show();
          if (data.data.length < pz) {
            $('#getmore').hide();
          }
          setTimeout(function(){
            $('.loading').hide();
            $('#newslist').html(html);
          },500)
        } else {
          $('#getmore').hide();
        }
      }
    });
  }
})();
</script>
<?php get_footer(); ?>



