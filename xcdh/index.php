<?php get_header(); ?>
<?php
  $home_news_id = ( isset( $th_options['home-news'] ) && $th_options['home-news'] ) ? $th_options['home-news'] : '';
  $home_tech_id = ( isset( $th_options['home-tech'] ) && $th_options['home-tech'] ) ? $th_options['home-tech'] : '';
?>
<div class="c_itbox">
  <div class="menu1 wrap"><h3><span class="s1">全国</span>&nbsp;&nbsp;<span>六大核心业务</span></h3></div>
  <div class="server wrap">
    <div class="wrap_desc server_left max_desc">
        <ul id="server_wrap">
              <li>
                 <a href="/itwaibao.html" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/1-16120F9222b54.png">
                    </div>
                    <div class="tin_desc">
                        <h6>IT外包服务</h6>
                        <p>企业IT外包服务、电脑维护、远程服务、到场服务、驻场服务</p>
                    </div>
                  </a>
                </li><li>
                 <a href="/buxian.html" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/1-16120F92Z70-L.png">
                    </div>
                    <div class="tin_desc">
                        <h6>综合布线</h6>
                        <p>管道预埋、线缆铺设、机柜安装、端口标签、线缆测试</p>
                    </div>
                  </a>
                </li><li>
                 <a href="/jiankong.html" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/1-1G21Q4560VB.png">
                    </div>
                    <div class="tin_desc">
                        <h6>监控设备</h6>
                        <p>摄像头布线安装调试、故障检测、监控设备解决方案</p>
                    </div>
                  </a>
                </li><li>
                 <a href="/internet.html" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/1-16120F92923627.png">
                    </div>
                    <div class="tin_desc">
                        <h6>网络设备</h6>
                        <p>路由器、防火墙、交换机、无线设备安装调试维护、检测维修</p>
                    </div>
                  </a>
                </li><li>
                 <a href="/menjin.html" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/menjin.jpg">
                    </div>
                    <div class="tin_desc">
                        <h6>门禁系统</h6>
                        <p>门禁安装服务、现场勘测、产品选型、图纸设计、故障检测</p>
                    </div>
                  </a>
                </li> <li>
                 <a href="/fuwuqi.html" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/1-16120F925100-L.png">
                    </div>
                    <div class="tin_desc">
                        <h6>服务器</h6>
                        <p>服务器系统安装、服务器上机架、硬盘、内存等安装</p>
                    </div>
                  </a>
                </li>     
        </ul>
    </div>
    <div class="wrap_desc server_right min_desc">
        <img src="<?=$tplRootUrl ?>/img/server.png">
    </div>
  </div>
</div>
<!--solve-->
<div class="index-solve">
    <div class="pageW">
        <h1 class="index-title">我们可以为您解决什么</h1>
        <ul class="solvecon clearfix">
            <li class="solve1">
                <div class="solvecon-t">
                    <div class="soveico1 ico">
                        <i class="iconfont icon-gongju"></i>
                    </div>
                    <h2>售后技术服务</h2>
                    <p class="txt">覆盖全国，标准规范，价格透明</p>
                </div>
                <div class="solvecon-c">
                    <p class="intro">在E客平台上，（E客）已在全国范围内拥有注册工程师超过15000名，可以为各大企业的全国性、突发性IT维护提供专业、及时的技术支持，平台上标准规范的IT服务内容包括电脑、服务器、网络设备、监控系统、无线网络、POS系统、办公设备等的上门售后安装维护，及调试、定期巡检、验收等综合IT技术服务。</p>
                </div>
            </li>
            <li class="solve2">
                <div class="solvecon-t">
                    <div class="soveico2 ico">
                        <i class="iconfont icon-xiangmu"></i>
                    </div>
                    <h2>项目实施</h2>
                    <p class="txt">网络工程，设备升级，技术整改</p>
                </div>
                <div class="solvecon-c">
                    <p class="intro">多年来，我们累积了丰富的多地区、并发量大的IT项目实施经验，为众多商城及连锁门店成功搭建网络工程和企业IT基础架构，从结构，系统，服务，管理四个方面提供一个成本合理、以及高效、安全的企业IT环境，通过模块化的、灵活性的、可靠性极高的布线网络和高效快速地上门维护服务，使得整个企业信息系统稳定可靠地运行，保证各类信息通讯畅通无阻。</p>
                </div>
            </li>
            <li class="solve3 cur">
                <div class="solvecon-t">
                    <div class="soveico3 ico">
                        <i class="iconfont icon-shizhong"></i>
                    </div>
                    <h2>IT即时下单服务</h2>
                    <p class="txt">最快10秒响应、1小时上门</p>
                </div>
                <div class="solvecon-c">
                    <p class="intro">E客IT服务平台已实现集WEB页面、微信、APP端，兼容IOS及Android的多端口即时下单功能，为客户突发、紧急的IT维修需求提供极速的响应和快速的IT上门服务。同时，平台上还具备7*24小时自动下单功能，客户可随时随地报修下单，客服将以最快速度给予反馈。</p>
                </div>
            </li>
        </ul>
    </div>
</div>
<!--advantage-->
<div class="index-advantage">
    <div class="trangler"></div>
    <div class="pageW">
        <h1 class="index-title">我们的优势是什么</h1>
        <div class="advantage-con">
            <div class="advantage-list">
                <span class="advanico">
                    <!-- <img src="<?=$tplRootUrl ?>/img/advan-ico1.png" /> -->
                    <i class="iconfont icon-youpinwangtubiaozhonggou-"></i> 
                </span>
                <h2>工程师</h2>
                <p class="into">E客是业内极少数，已汇聚全国海量的IT认证技术工程师和经验丰富的项目实施精英的IT服务平台，拥有各大厂商的认证资质，近二十万单的服务运营经验，并可通过现场工程师与远程工程师无缝协作的高效模式，快速解决企业复杂、繁琐的IT系统突发状况。</p>
                <p class="tag">海量、认证、实战</p>
            </div>
            <div class="advantage-list">
                <span class="advanico">
                    <!-- <img src="<?=$tplRootUrl ?>/img/advan-ico2.png" /> -->
                    <i class="iconfont icon-zongcai"></i>
                </span>
                <h2>平台</h2>
                <p class="into">“互联网+IT服务”的创新平台模式，实现了跨地域、无边界、简流程，报修快，易支付等普通线下IT外包服务公司无法实现的诸多优势，使得企业不再为维护成本高、维护覆盖范围小、技术资源匮乏、出差时效性差等而担忧。</p>
                <p class="tag">跨地域、无边界、支付便捷</p>
            </div>
            <div class="advantage-list">
                <span class="advanico">
                    <!-- <img src="<?=$tplRootUrl ?>/img/advan-ico3.png" /> -->
                    <i class="iconfont icon-kefu"></i>
                </span>
                <h2>客服</h2>
                <p class="into">专业、高效是E客每一位客服的服务宗旨，以丰富的IT知识和服务经验，为客户提供统一管控、统一服务、统一标准的品质服务，E客IT服务平台致力于通过更细致、更优化的前端流程规划，最大程度减免企业客户与IT服务工程师或第三方客户之间的繁琐环节。</p>
                <p class="tag">统一管理、统一服务、统一标准</p>
            </div>
        </div>
    </div>
</div>
<!--passageway-->
<div class="index-passageway">
    <div class="passagewaycon pageW clearfix">
        <div class="passagefl fl">
            <h1 class="index-title">快速报修通道</h1>
            <div class="passway-txt">
                <p>一键下单，全程服务无忧</p>
                <p>异地极速响应</p>
                <p>最快1小时内到达</p>
            </div>
            <p class="phone"><img src="<?=$tplRootUrl ?>/img/phone-c.png" /></p>
            <div class="arror"><img src="<?=$tplRootUrl ?>/img/arror.png" /></div>
        </div>
        <div class="passagerl fl">
            <div class="passcirl animate1"></div>
            <div class="passcir2 animate2"></div>
            <div class="passcir3"></div>
            <div class="passcir-small">
                <a class="indexlight cirl1" href="/home/index/baoxiu.html?catalogCode=5">
                    <!-- <img class="replce-pic" src="<?=$tplRootUrl ?>/img/index3-hover.png" /> -->
                    <span class="iconWrap"><i class="iconfont icon-jiankong"></i><p>监控</p></span>
                </a>
                <a class="indexlight cirl2" href="/home/index/baoxiu.html?catalogCode=8">
                    <!-- <img src="<?=$tplRootUrl ?>/img/index4-hover.png" /> -->
                    <span class="iconWrap"><i class="iconfont icon-icon-test"></i><p>定制保修</p></span>
                </a>
                <a class="indexlight cirl3" href="/home/index/baoxiu.html?catalogCode=1">
                    <!-- <img src="<?=$tplRootUrl ?>/img/index5-hover.png" /> -->
                    <span class="iconWrap"><i class="iconfont icon-dayinji"></i><p>办公设备</p></span>
                </a>
                <a class="indexlight cirl4" href="/home/index/baoxiu.html?catalogCode=7">
                    <!-- <img src="<?=$tplRootUrl ?>/img/index6-hover.png" /> -->
                    <span class="iconWrap"><i class="iconfont icon-posji"></i><p>POS系统</p></span>
                </a>
                <a class="indexlight cirl5" href="/home/index/baoxiu.html?catalogCode=6">
                    <!-- <img src="<?=$tplRootUrl ?>/img/index7-hover.png" /> -->
                    <span class="iconWrap"><i class="iconfont icon-wuxian"></i><p>网络设备</p></span>
                </a>
                <a class="indexlight cirl6" href="/home/index/baoxiu.html?catalogCode=4">
                    <!-- <img src="<?=$tplRootUrl ?>/img/index8-hover.png" /> -->
                    <span class="iconWrap"><i class="iconfont icon-diannao"></i><p>电脑维护</p></span>
                </a>
                <a class="indexlight cirl7" href="/home/index/baoxiu.html?catalogCode=3">
                    <!-- <img src="<?=$tplRootUrl ?>/img/index1-hover.png" /> -->
                    <span class="iconWrap"><i class="iconfont icon-msnui-server"></i><p>服务器</p></span>
                </a>
                <a class="indexlight cirl8" href="/home/index/baoxiu.html?catalogCode=2">
                    <!-- <img src="<?=$tplRootUrl ?>/img/index2-hover.png" /> -->
                    <span class="iconWrap"><i class="iconfont icon-menjinguanli"></i><p>门禁系统</p></span>
                </a>
            </div>
            <div class="passcir-arround">
                <div class="passcir4 anround">
                    <div class="passcir5"></div>
                </div>
                <div class="passcir6 "></div>
                <div class="passcir7 anround"></div>
                <div class="passcir8 anround"></div>
            </div>
        </div>
    </div>
</div>


<div class="index-news">
    <div class="pageW clearfix">
        <?php if ($home_news_id != -1) :?>
        <div class="indexnews_lf fl">
            <h2 class="title">最新动态</h2>
            <ul>
                <?php
                    $query = new WP_Query( array(
                        'cat' => $home_news_id,
                        'posts_per_page' => 3,
                        'ignore_sticky_posts' => true
                    ) );
                    $i = 0;
                    while( $query->have_posts() ):
                        $i++;
                        $query->the_post();
                        $iimg = xy_thumb();
                ?>
                <li>
                    <a class="clearfix" href="<?php the_permalink();?>">
                        <?php if (!empty($iimg)) :?>
                        <div class="pic">
                          <img style="width: 100px;width: 100px;" src="<?=$iimg ?>" />
                        </div>
                        <?php endif; ?>
                        <div class="intro">
                            <p class="t"><?php the_title();?></p>
                            <p class="intr"><?php echo get_the_excerpt();?></p>
                            <p class="time"><?php the_time('Y-m-d H:i');?></p>
                        </div>
                    </a>
                </li>
                <?php endwhile;?>
            </ul>
            <a class="more" href="<?php echo get_category_link($home_news_id); ?>">更多新闻</a>
        </div>
        <?php endif; ?>
        <?php if ($home_tech_id != -1) :?>
        <div class="technical-txt  fr">
            <h2 class="title">技术文档</h2>
            <ul>
                <?php
                    $query = new WP_Query( array(
                        'cat' => $home_tech_id,
                        'posts_per_page' => 6,
                        'ignore_sticky_posts' => true
                    ) );
                    $i = 0;
                    while( $query->have_posts() ):
                        $i++;
                        $query->the_post();
                ?>
                <li>
                    <a class="clearfix" href="<?php the_permalink();?>">
                        <span class="pic"><img src="<?=$tplRootUrl ?>/img/technical.png" /></span>
                        <span class="tec-txt"><?php the_title();?></span>
                    </a>
                </li>
                <?php endwhile;?>
            </ul>
            <a class="more" href="<?php echo get_category_link($home_news_id); ?>">更多文档</a>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="index-cooperation">
    <div class="pageW">
        <h1 class="title"></h1>
        <ul class="cooperation-list">
            <li>
                <div class="cooperation-div"><a href=""><img src="<?=$tplRootUrl ?>/img/link1.jpg" /></a></div>
            </li>
            <li>
                <div class="cooperation-div"><a href=""><img src="<?=$tplRootUrl ?>/img/link2.jpg" /></a></div>
            </li>
            <li>
                <div class="cooperation-div"><a href=""><img src="<?=$tplRootUrl ?>/img/link3.jpg" /></a></div>
            </li>
            <li>
                <div class="cooperation-div"><a href=""><img src="<?=$tplRootUrl ?>/img/link4.jpg" /></a></div>
            </li>
            <li>
                <div class="cooperation-div"><a href=""><img src="<?=$tplRootUrl ?>/img/link5.jpg" /></a></div>
            </li>
        </ul>
    </div>
</div>
<?php get_footer(); ?>