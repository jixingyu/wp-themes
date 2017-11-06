<?php
/*
Template Name: 查询结果
*/
    $utsUser = Xysession::get('uts-login');
    if (empty($utsUser)) {
        if (!empty($_REQUEST['on'])) {
            require_once(ABSPATH . 'wp-content/themes/uts/inc/class-tms-api.php');
            $tmsapi = new Tms_api();
            $order_search = $_REQUEST['on'];
            $order_type = (int) $_REQUEST['ot'];
            if ($order_type != 2) {
                $order_type = 3;
            }
            $result = $tmsapi->order_list_by_admin($order_search, $order_type);
            if ($result['code'] == 0) {
                $sResult = $result['data'];
            }
        }
    } else {

    }

    get_header();
?>  <!-- banner -->
  <div class="banner">
    <img alt="" src="<?php echo empty($th_options['head-banner-img']) ? get_bloginfo('template_url') . '/img/long-banner.jpg' : $th_options['head-banner-img'];?>" class="bannerimg"/>
  </div>

  <!-- 运单查询 -->
  <div class="navbussies navbussies-case">
    <div class="bussiescont ">
      <ul>
        <li class="active">
          <a href="Javascript: void(0)">
            <h4>运单查询</h4>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <div class="search-bill">
  <?php if (empty($utsUser)) :?>
    <!-- 默认进入界面 1 -->
    <div class="search-textarea bgf5" id="searchdiv">
      <div class="userinfo">
        <a href="/uts-login" class="loginbtn dis-min">企业登录</a>
      </div>
      <form method="POST" id="searchForm">
        <div class="newsearchdiv">
          <select name="ot" id="selectorder">
            <option value="2"<?php if (isset($_REQUEST['ot']) && $_REQUEST['ot'] == 2) echo ' selected="selected"';?>>发货订单ID</option>
            <option value="3"<?php if (isset($_REQUEST['ot']) && $_REQUEST['ot'] == 3) echo ' selected="selected"';?>>客户订单编号</option>
          </select>
          <input type="text" name="on" id="order_no" placeholder="点击输入运单号" onfocus="if(placeholder=='点击输入运单号') {placeholder=''}" onblur="if (value=='') {placeholder='点击输入运单号'}" value="<?php if (isset($_REQUEST['on'])) echo htmlspecialchars($_REQUEST['on']); ?>" />
          <p class="errorlog">点击输入运单号</p>
          <div class="search-btn" id="searchBtn">开始查询</div>
        </div>
      </form>
    </div>
    <?php if (!empty($_REQUEST['on'])) : ?>
    <?php if (empty($sResult)) : ?>
    <div class="bgfff">
      <div class="bussiescont-toppart">
        <h2>- 没有查到相关订单信息 -</h2>
      </div>
    </div>
    <?php else : ?>
    <!-- 查询结果  3-->
    <div class="bgfff">
      <div class="bussiescont-toppart">
        <h2>- 查询结果 -</h2>
      </div>
    </div>
    <div class="bgfff showdetails">
      <div class="billdetails">
        <div class="havetwop">
          <p>发货订单ID：<?php echo $sResult['ORDER_ID'];?></p>
          <p class="orderstyle">订单状态：<span><?php echo $sResult['STATUS'];?></span></p>
        </div>  
        <p><span class="icons-bill icon-order"></span>订单：<?php echo $sResult['C_ORDER_NO'];?></p>
        <p><span class="icons-bill icon-from"></span><?php echo $sResult['SRC_ADDRESS'];?><span class="billtime"><?php echo $sResult['CREATED_DATE'];?></span></p>
        <p><span class="icons-bill icon-to"></span><?php echo $sResult['DEST_ADDRESS'];?></p>
        <div class="havetwop">
          <!-- <p><span class="icons-bill icon-contact"></span>张三&nbsp; 18526155155</p> -->
          <p class="detailsbtn">订单详情</p>
        </div> 
      </div>
      <div class="line-dashad"></div>
      <div class="billdetails bill-bottom">
        <p>客户ID：<?php echo $sResult['CUSTOMER_NAME'];?></p>
        <!-- <div class="havethree">
          <p>已计划：<span>0</span></p>
          <p>已提货：<span>0</span></p>
          <p>已到货：<span>0</span></p>
          <p>未计划：<span>8</span></p>
          <p>在途：<span>0</span></p>
          <p>已签收：<span>0</span></p>
        </div> -->
        <div class="stylebar">
          <ul>
            <?php foreach ($sResult['tracking'] as $tracking_row) :?>
            <li<?php if (isset($tracking_row['time'])) echo ' class="active"';?>>
              <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
              <p><?php echo $tracking_row['status_desc'];?><span><?php if (isset($tracking_row['time'])) echo $tracking_row['time']; ?></span></p>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="clear"></div>
          
      </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
    <script>
      $('#searchBtn').click(function(){
          $('#searchForm').submit();
      });
    </script>
  <?php else: ?>
    <div class="search-textarea bgf5" id="searchdiv">
      <div class="userinfo">
        <h5 class="dis-min">用户名：<?php echo $utsUser['username'];?><span class="orderAll">所有订单</span></h5> 
        <a href="javascript:void(0);" class="logoutbtn dis-min">退出</a>
      </div>
      <div class="newsearchdiv">
        <select name="ot" id="selectorder">
          <option value="2"<?php if (isset($_REQUEST['ot']) && $_REQUEST['ot'] == 2) echo ' selected="selected"';?>>发货订单ID</option>
          <option value="3"<?php if (isset($_REQUEST['ot']) && $_REQUEST['ot'] == 3) echo ' selected="selected"';?>>客户订单编号</option>
        </select>
        <input type="text" name="on" id="order_no" placeholder="点击输入运单号" onfocus="if(placeholder=='点击输入运单号') {placeholder=''}" onblur="if (value=='') {placeholder='点击输入运单号'}" value="<?php if (isset($_REQUEST['on'])) echo htmlspecialchars($_REQUEST['on']); ?>" />
        <p class="errorlog">点击输入运单号</p>
        <div class="search-btn" id="searchBtn">开始查询</div>
      </div>
      <!-- <p>可同时查询10条，以逗号、空格、回车键隔开</p> -->
    </div>
    <!-- 所有订单 4 -->
    <div id="allorders">
      <div class="bgfff">
        <div class="bussiescont-toppart">
          <h2>- 所有订单 -</h2>
          <p class="">请选择筛选条件</p>
          <div class="selectdiv">
            <span class="current" data-orderstatus="47">已回单</span>
            <span data-orderstatus="46">已签单</span>
            <span data-orderstatus="45">已到货</span>
            <span data-orderstatus="43">已提货</span>
            <span data-orderstatus="42">在途</span>
            <span data-orderstatus="40">已计划</span>
            <span data-orderstatus="20">审核</span>
            <span data-orderstatus="10">开放</span>
          </div>
        </div>
      </div>
      <div class="bgfff showdetails">
        <div class="billdetails">
          <div class="havetwop">
            <p>运单号：SP1398918921 </p> 
            <p class="orderstyle">订单状态：<span>已计划</span></p>
          </div>  
          <p><span class="icons-bill icon-order"></span>订单：M77</p>
          <p><span class="icons-bill icon-from"></span>上海市，浦东区，耀华路233号<span class="billtime">2017-09-26 23:33:00</span></p>
          <p><span class="icons-bill icon-to"></span>华山街金色阳关42-12</p>
          <div class="havetwop">
            <p><span class="icons-bill icon-contact"></span>张三&nbsp; 18526155155</p>
            <p class="detailsbtn">订单详情</p>
          </div> 
        </div>
        <div class="line-dashad"></div>
        <div class="billdetails bill-bottom">
          <p>发货订单ID：E30050108.001</p>
          <p>客户ID：某某电梯有限公司（某某电梯有限公司）</p>
          <div class="havethree">
            <p>已计划：<span>0</span></p>
            <p>已提货：<span>0</span></p>
            <p>已到货：<span>0</span></p>
            <p>未计划：<span>8</span></p>
            <p>在途：<span>0</span></p>
            <p>已签收：<span>0</span></p>
          </div>
          <div class="stylebar">
            <ul>
              <li class="active">
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>47已回单<span>2017-09-26 23:33:00</span></p>
              </li>
              <li class="active">
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>46已签收<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>45已到货<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>43已提货<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>42在途<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>40已计划<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>20审核<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span>
                <p>10开放<span>2017-09-26 23:33:00</span></p>
              </li>

            </ul>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <div class="bgfff">
        <div class="billdetails">
          <div class="havetwop">
            <p>运单号：SP1398918921 </p> 
            <p class="orderstyle">订单状态：<span>已计划</span></p>
          </div>  
          <p><span class="icons-bill icon-order"></span>订单：M77</p>
          <p><span class="icons-bill icon-from"></span>上海市，浦东区，耀华路233号<span class="billtime">2017-09-26 23:33:00</span></p>
          <p><span class="icons-bill icon-to"></span>华山街金色阳关42-12</p>
          <div class="havetwop">
            <p><span class="icons-bill icon-contact"></span>张三&nbsp; 18526155155</p>
            <p class="detailsbtn">订单详情</p>
          </div> 
        </div>
        <div class="line-dashad"></div>
        <div class="billdetails bill-bottom">
          <p>发货订单ID：E30050108.001</p>
          <p>客户ID：某某电梯有限公司（某某电梯有限公司）</p>
          <div class="havethree">
            <p>已计划：<span>0</span></p>
            <p>已提货：<span>0</span></p>
            <p>已到货：<span>0</span></p>
            <p>未计划：<span>8</span></p>
            <p>在途：<span>0</span></p>
            <p>已签收：<span>0</span></p>
          </div>
          <div class="stylebar">
            <ul>
              <li class="active">
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>47已回单<span>2017-09-26 23:33:00</span></p>
              </li>
              <li class="active">
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>46已签收<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>45已到货<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>43已提货<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>42在途<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>40已计划<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>20审核<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span>
                <p>10开放<span>2017-09-26 23:33:00</span></p>
              </li>

            </ul>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <div class="bgfff">
        <div class="billdetails">
          <div class="havetwop">
            <p>运单号：SP1398918921 </p> 
            <p class="orderstyle">订单状态：<span>已计划</span></p>
          </div>  
          <p><span class="icons-bill icon-order"></span>订单：M77</p>
          <p><span class="icons-bill icon-from"></span>上海市，浦东区，耀华路233号<span class="billtime">2017-09-26 23:33:00</span></p>
          <p><span class="icons-bill icon-to"></span>华山街金色阳关42-12</p>
          <div class="havetwop">
            <p><span class="icons-bill icon-contact"></span>张三&nbsp; 18526155155</p>
            <p class="detailsbtn">订单详情</p>
          </div> 
        </div>
        <div class="line-dashad"></div>
        <div class="billdetails bill-bottom">
          <p>发货订单ID：E30050108.001</p>
          <p>客户ID：某某电梯有限公司（某某电梯有限公司）</p>
          <div class="havethree">
            <p>已计划：<span>0</span></p>
            <p>已提货：<span>0</span></p>
            <p>已到货：<span>0</span></p>
            <p>未计划：<span>8</span></p>
            <p>在途：<span>0</span></p>
            <p>已签收：<span>0</span></p>
          </div>
          <div class="stylebar">
            <ul>
              <li class="active">
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>47已回单<span>2017-09-26 23:33:00</span></p>
              </li>
              <li class="active">
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>46已签收<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>45已到货<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>43已提货<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>42在途<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>40已计划<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span><span class="styleline"></span>
                <p>20审核<span>2017-09-26 23:33:00</span></p>
              </li>
              <li>
                <span class="icons-bill icon-style-normal"></span>
                <p>10开放<span>2017-09-26 23:33:00</span></p>
              </li>

            </ul>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>

    <script>
      $('.logoutbtn').on('click',function(){
        $.ajax({
          type: "POST",
          url: "/wp-admin/admin-ajax.php?action=xy_tms",
          data: {t:'logout'},
          dataType: "json",
          success: function(data){
            if (data.code == 0) {
              window.location.reload();
            }
          }
        });
      });
      $('#searchBtn').click(function(){
          searchOrder();
      });
      function searchOrder() {

      }
    </script>
  <?php endif; ?>
  </div>
  
  <?php get_footer(); ?>