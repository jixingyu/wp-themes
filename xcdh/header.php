<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html> 
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
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
        } ?></title>
    <?php
        $description = '';
        $keywords = '';

        if (is_home() || is_page()) {
            $description = get_bloginfo('name');
            $keywords = get_bloginfo('name');
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
        if (empty($keywords)) {
            $keywords = get_bloginfo('name');
        }
        $description = trim(strip_tags($description));
        $keywords = trim(strip_tags($keywords));
        global $tplRootUrl;
        $tplRootUrl = get_bloginfo('template_url');
    ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <link href="<?=$tplRootUrl ?>/css/idangerous.swiper.css" type="text/css" rel="stylesheet" />
    <link href="<?=$tplRootUrl ?>/css/animate.min.css" type="text/css" rel="stylesheet" />
    <link href="<?=$tplRootUrl ?>/css/style.css" type="text/css" rel="stylesheet" />
    <link href="<?=$tplRootUrl ?>/css/inner.css" type="text/css" rel="stylesheet" />
    <link href="<?=$tplRootUrl ?>/css/iconfontnew.css" type="text/css" rel="stylesheet" />
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>" type="text/css" media="screen" />
    
    <?php
        global $th_options;
        wp_head();
    ?>

    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?5630e81704fa9d2f2bc898973246137f";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>

</head>
<body>

<!--header_wrap-->
<div class="naver-Top">
    <div class="header_wrap">
        <div class="header">
            <a class="logo" href="/"></a>
            <div class="naver-nav clearfix">
                <ul class="nav clearfix" id="nav_ul">
                    <li class="active">
                        <a href="/">首页</a>
                    </li>
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'navmain',
                            'walker' => new Xy_Navmain_Walker(),
                            'container' => '',
                            'items_wrap' => '%3$s',
                            'depth' => 1
                        ) );
                    ?>
                </ul>
                <div class="loginTop">
                </div>
            </div>
        </div>
    </div>
</div>
<!--下拉菜单-->
<div class="downlist-subnav">
    <div class="naversub-wrap">
        <?php
            wp_nav_menu( array(
                'theme_location' => 'navmain',
                'walker' => new Xy_Navmainsub_Walker(),
                'container' => '',
                'items_wrap' => '%3$s',
                'depth' => 2
            ) );
        ?>
    </div>
</div>

<!--banner-->
<div class="slide-banner">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div style="position: relative;width: 100%;height: 473px;">
                    <div class="swiper-slideBg" style="background-image:url(<?=$tplRootUrl ?>/img/banner2.jpg);background-size:cover;">
                        <div class="swiperW">
                            <a class="swiperlink" href="">
                                <p class="txt2 ani" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                    <img src="<?=$tplRootUrl ?>/img/txt2.png" />
                                </p>
                                <p class="txt3 ani" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.4s">
                                    <img src="<?=$tplRootUrl ?>/img/txt3.png" />
                                </p>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-slide">
                <div style="position: relative;width: 100%;height: 473px;">
                    <div class="swiper-slideBg" style="background-image:url(<?=$tplRootUrl ?>/img/banner1.jpg);background-size:cover;">
                        <div class="swiperW">
                            <a class="swiperlink" href="">
                                <p class="txt1 ani" swiper-animate-effect="fadeInLeft" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"><img src="<?=$tplRootUrl ?>/img/txt1.png"></p>
                                <p class="txt8 ani" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.4s">
                                    <img src="<?=$tplRootUrl ?>/img/map.png"  />
                                    <span class="map1"><i></i></span>
                                    <span class="map2"><i></i></span>
                                    <span class="map3"><i></i></span>
                                    <span class="map4"><i></i></span>
                                    <span class="map5"><i></i><i></i></span>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div style="position: relative;width: 100%;height: 473px;">
                    <div class="swiper-slideBg" style="background-image:url(<?=$tplRootUrl ?>/img/banner4.jpg);background-size: cover;">
                        <div class="swiperW">
                            <a class="swiperlink" href="">
                                <p class="txt6 ani" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                    <img src="<?=$tplRootUrl ?>/img/txt6.png" />
                                </p>
                                <p class="txt7 ani" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.4s">
                                    <img src="<?=$tplRootUrl ?>/img/txt7.png" />
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-btndow ani" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                        <div class="swiperW">
                            <a class="linkmore" href="">查看详情</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div style="position: relative;width: 100%;height: 473px;">
                    <div class="swiper-slideBg" style="background-image:url(<?=$tplRootUrl ?>/img/banner5.jpg);background-size:cover;">
                        <div class="swiperW">
                            <a class="swiperlink" href="">
                                <p class="txt6 ani" swiper-animate-effect="zoomIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                    <img src="<?=$tplRootUrl ?>/img/txt8.png" />
                                </p>
                                <p class="txt9 ani"  swiper-animate-effect="zoomIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.4s">
                                    <img src="<?=$tplRootUrl ?>/img/txt10.png" />
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-btndow ani" swiper-animate-effect="zoomIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                        <div class="swiperW">
                            <a class="linkmore" href="">查看详情</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div style="position: relative;width: 100%;height: 473px;">
                    <div class="swiper-slideBg" style="background-image:url(<?=$tplRootUrl ?>/img/banner3.jpg);background-size:cover;">
                        <div class="swiperW">
                            <a class="swiperlink" href="">
                                <p class="txt4 ani" swiper-animate-effect="zoomIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                    <img src="<?=$tplRootUrl ?>/img/txt4.png" />
                                </p>
                                <p class="txt5 ani" swiper-animate-effect="zoomIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.4s">
                                    <img src="<?=$tplRootUrl ?>/img/txt5.png" />
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
