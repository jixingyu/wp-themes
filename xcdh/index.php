<?php get_header(); ?>
<?php
  $home_news_id = ( isset( $th_options['home-news'] ) && $th_options['home-news'] ) ? $th_options['home-news'] : '';
  $home_tech_id = ( isset( $th_options['home-tech'] ) && $th_options['home-tech'] ) ? $th_options['home-tech'] : '';
?>
<div class="c_itbox">
  <div class="menu1 wrap"><h3><span class="s1">星辰大海六大核心业务</span></h3></div>
  <div class="server wrap">
    <div class="wrap_desc server_left max_desc">
        <ul id="server_wrap">
              <li>
                 <a href="/xxsjfxm" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/1-16120F9222b54.png">
                    </div>
                    <div class="tin_desc">
                        <h6>信息数据防泄密</h6>
                        <p>信息安全、数据安全、商业秘密保护等行业解决方案</p>
                    </div>
                  </a>
                </li><li>
                 <a href="/wlaq" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/menjin.jpg">
                    </div>
                    <div class="tin_desc">
                        <h6>网络安全防护</h6>
                        <p>防火墙、防勒索、杀毒、上网行为管理、SSL VPN、数据库审计、存储备份容灾</p>
                    </div>
                  </a>
                </li><li>
                 <a href="/yunjisuan-2" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/1-16120F92Z70-L.png">
                    </div>
                    <div class="tin_desc">
                        <h6>云计算</h6>
                        <p>私有云、公有云、混合云、超融合、大数据</p>
                    </div>
                  </a>
                </li><li>
                 <a href="/wlsb" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/1-1G21Q4560VB.png">
                    </div>
                    <div class="tin_desc">
                        <h6>网络设备</h6>
                        <p>防火墙、网关、服务器、交换机、无线AP等网络设备</p>
                    </div>
                  </a>
                </li> <li>
                 <a href="/wlwh" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/1-16120F925100-L.png">
                    </div>
                    <div class="tin_desc">
                        <h6>网络建设和维护</h6>
                        <p>服务器安装、上机架、硬盘、无线AP、交换机、防火墙、设备安装调试</p>
                    </div>
                  </a>
                </li><li>
                 <a href="/it" target="_blank">
                    <div class="tin">
                        <img src="<?=$tplRootUrl ?>/img/1-16120F92923627.png">
                    </div>
                    <div class="tin_desc">
                        <h6>IT服务与外包</h6>
                        <p>网络维护、电脑维护、机房维护、远程服务、驻场服务</p>
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
        <h1 class="index-title">星辰大海为您解决什么</h1>
        <ul class="solvecon clearfix">
            <li class="solve1">
                <div class="solvecon-t">
                    <div class="soveico1 ico">
                        <i class="iconfont icon-xiangmu"></i>
                    </div>
                    <h2>防泄密软件服务</h2>
                    <p class="txt">文档安全管理、系统数据保护管理、文档安全网关</p>
                </div>
                <div class="solvecon-c">
                    <p class="intro">通过数据加密防泄漏完善的系统防止内部操作不当信息泄露、临时访客有意无意带出、外部恶意访问窃取、第三方合作伙伴恶意扩散等方式泄露公司秘密。智能识别各种截录屏行为，有效禁止针对涉密数据的各种截录屏操作。敏感数据加密保护、个人及非工作文档明文存储、防止过量加密、降低管理成本。</p>
                </div>
            </li>
            <li class="solve2">
                <div class="solvecon-t">
                    <div class="soveico2 ico">
                        <i class="iconfont icon-gongju"></i>
                    </div>
                    <h2>网络安全防护</h2>
                    <p class="txt">网络边界管控、终端安全管控、杀毒软件硬件</p>
                </div>
                <div class="solvecon-c">
                    <p class="intro">结合合企业自身特点，配合应用架构进行有针对性的整体安全设计，通过防火墙技术和网络隔离技术、加密与认证技术、网络安全漏洞扫描、网络入侵检测、 客户端的防护、 最小授权原则、远程访问控制、数据备份与恢复等技术的组合，为企业网络建立安全防护的独特屏障。</p>
                </div>
            </li>
            <li class="solve3 cur">
                <div class="solvecon-t">
                    <div class="soveico3 ico">
                        <i class="iconfont icon-icon-test"></i>
                    </div>
                    <h2>IT外包服务</h2>
                    <p class="txt">网络维护、电脑维护、机房维护、远程服务、驻场服务</p>
                </div>
                <div class="solvecon-c">
                    <p class="intro">已在全国范围内拥有注册工程师超过20000名，可以为各大企业的全国性、突发性IT维护提供专业、及时的技术支持，提供标准规范的IT服务内容包括电脑、服务器、网络设备、监控系统、无线网络、POS系统、办公设备等的上门售后安装维护，及调试、定期巡检、验收等综合IT技术服务。</p>
                </div>
            </li>
        </ul>
    </div>
</div>
<!--advantage-->
<div class="index-advantage">
    <div class="trangler"></div>
    <div class="pageW">
        <h1 class="index-title">星辰大海的优势是什么</h1>
        <div class="advantage-con">
            <div class="advantage-list">
                <span class="advanico">
                    
                    <i class="iconfont icon-youpinwangtubiaozhonggou-"></i> 
                </span>
                <h2>全国范围的技术支持</h2>
                <p class="into">全国范围本地化的技术支撑优势，全国海量的IT认证技术工程师和经验丰富的项目实施精英，拥有各大厂商的认证资质，多项全国领先资质，并可通过现场工程师与远程工程师无缝协作的高效模式，快速解决企业复杂、繁琐的IT系统突发状况。</p>
                <!-- <p class="tag">海量、认证、实战</p> -->
            </div>
            <div class="advantage-list">
                <span class="advanico">
                   
                    <i class="iconfont icon-zongcai"></i>
                </span>
                <h2>全面的解决方案</h2>
                <p class="into">全面的网络安全防护方案体系，预防、治疗、抢救全套的防护体系对数据库、文件、重要业务系统等服务器进行保护，构建网络、数据、主机三层防御体系，全网设备智能联动；构建服务器、PC端全网防御体系，更高级别更全面的安全防护。</p>
                <!-- <p class="tag">跨地域、无边界、支付便捷</p> -->
            </div>
            <div class="advantage-list">
                <span class="advanico">
                    
                    <i class="iconfont icon-kefu"></i>
                </span>
                <h2>专业高效的客服</h2>
                <p class="into">专业、高效是星辰大海每一位客服的服务宗旨，以丰富的IT知识和服务经验，为客户提供统一管控、统一服务、统一标准的品质服务，星辰大海IT服务平台致力于通过更细致、更优化的前端流程规划，最大程度减免企业客户与IT服务工程师或第三方客户之间的繁琐环节。</p>
                <!-- <p class="tag">统一管理、统一服务、统一标准</p> -->
            </div>
        </div>
    </div>
</div>
<div class="index-advantage" style="background-color:#fff;">
    <div class="pageW">
        <h1 class="index-title">星辰大海代理资质</h1>
        <div class="advantage-con">
            <div class="advantage-list">
               <img src="<?=$tplRootUrl ?>/img/img-shouquan.jpg" alt="授权书">
            </div>
            <div class="advantage-list">
               <img src="<?=$tplRootUrl ?>/img/img-shouquan2.jpg" alt="授权书">
            </div>
            <!-- <div class="advantage-list">
               <img src="<?=$tplRootUrl ?>/img/img-shouquan.jpg" alt="授权书">
            </div> -->
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
                <div class="cooperation-div"><img src="<?=$tplRootUrl ?>/img/link1.png" /></div>
            </li>
            <li>
                <div class="cooperation-div"><img src="<?=$tplRootUrl ?>/img/link2.png" /></div>
            </li>
            <li>
                <div class="cooperation-div"><img src="<?=$tplRootUrl ?>/img/link3.png" /></div>
            </li>
            <li>
                <div class="cooperation-div"><img src="<?=$tplRootUrl ?>/img/link4.png" /></div>
            </li>
            <li>
                <div class="cooperation-div"><img src="<?=$tplRootUrl ?>/img/link5.png" /></div>
            </li>
        </ul>
    </div>
</div>
<?php get_footer(); ?>