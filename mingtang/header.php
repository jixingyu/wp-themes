<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html> 
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
    <title><?php if ( is_home() ) {
            bloginfo('name');
        } elseif ( is_category() ) {
            single_cat_title(); echo " - "; bloginfo('name');
        } elseif (is_single() || is_page() ) {
            single_post_title();
        } elseif (is_search() ) {
            echo "搜索结果 - "; bloginfo('name');
        } elseif (is_404() ) {
            echo '页面未找到!';
        } else {
            wp_title('',true);
        } ?>
    </title>
    <?php
        $description = '';
        $keywords = '';

        if (is_home() || is_page()) {
           $description = "优通";
           $keywords = "优通";
        } elseif (is_single()) {
           $description1 = get_post_meta($post->ID, "description", true);
           $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));

           // 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
           $description = $description1 ? $description1 : $description2;
           
           // 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
           $keywords = get_post_meta($post->ID, "keywords", true);
           if($keywords == '') {
              $tags = wp_get_post_tags($post->ID);    
              foreach ($tags as $tag ) {        
                 $keywords = $keywords . $tag->name . ", ";    
              }
              $keywords = rtrim($keywords, ', ');
           }
        } elseif (is_category()) {
           $description = category_description();
           $keywords = single_cat_title('', false);
        } elseif (is_tag()){
           $description = tag_description();
           $keywords = single_tag_title('', false);
        }
        $description = trim(strip_tags($description));
        $keywords = trim(strip_tags($keywords));
    ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <!-- <link rel="shortcut icon" href="favicon.ico" /> -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

    <?php
        global $th_options;
        global $tplRootUrl;
        $tplRootUrl = get_bloginfo('template_url');
        wp_head();
    ?>
</head>
<body>
  <!-- 顶部 -->

  <div class="topbg">
    <div class="container">
      <div class="row clearfix">
        <div class="col-md-12">
          <div class="navbar navbar-mingtang">
            <nav class="navbar navbar-mingtang" role="navigation">
              <div class="navbar-header">
                 <a class="navbar-brand" href="Javascript: void(0)"><div class="logo"><img src="<?php echo $tplRootUrl;?>/img/logo.png" /><img src="<?php echo $tplRootUrl;?>/img/logo-top.png" alt=""></div></a>
              </div>
              <ul class="navber-top float-r">
                <li>
                  <a href="https://weidian.com/?userid=976576791"><span class="icons icon-shop dis-mid"></span>商店</a>
                </li>
                <li>
                  <a href="http://weibo.com/p/1006061741488111/home?is_hot=1"><span class="icons icon-guanzhu  dis-mid"></span>关注我们</a>
                </li>
                <li class="share-hover">
                  <a href="Javascript: void(0)">
                    <span class="icons icon-share  dis-mid"></span>分享
                    <div class="hideshare">
                      <div class="jiathis_style_32x32">
                        <a class="jiathis_button_qzone"></a>
                        <a class="jiathis_button_tsina"></a>
                        <a class="jiathis_button_tqq"></a>
                        <a class="jiathis_button_weixin"></a>
                        <a class="jiathis_button_renren"></a>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </nav>

            <div class="collapse navbar-collapse" id="navbar-collapse">
              <?php
                wp_nav_menu( array(
                  'theme_location' => 'navmain',
                  'walker' => new Xy_Navmain_Walker(),
                  'container' => '',
                  'items_wrap' => '<ul class="nav navbar-nav navbar-right">%3$s</ul>',
                  'depth' => 2
                ) );
              ?>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>
