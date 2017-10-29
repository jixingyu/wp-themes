<?php
/*
Template Name: 单订单查询
*/
    get_header();

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
?>
  <!-- banner -->
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
    <div class="search-textarea bgf5">
      <!-- <div class="userinfo"><h5 class="dis-min">用户名：13500000000<span class="orderAll">所有订单</span></h5> <a href="logout" class="logoutbtn dis-min">退出</a></div> -->
        <form method="POST" id="searchForm">
          <div class="newsearchdiv">
            <select name="ot" id="selectorder">
              <option value="2"<?php if (isset($_REQUEST['ot']) && $_REQUEST['ot'] == 2) echo ' selected="selected"';?>>发货订单ID</option>
              <option value="3"<?php if (isset($_REQUEST['ot']) && $_REQUEST['ot'] == 3) echo ' selected="selected"';?>>客户订单编号</option>
            </select>
            <input type="text" name="on" id="order_no" placeholder="点击输入运单号" onfocus="if(placeholder=='点击输入运单号') {placeholder=''}" onblur="if (value=='') {placeholder='点击输入运单号'}" value="<?php if (isset($_REQUEST['on'])) echo htmlspecialchars($_REQUEST['on']); ?>" />
            <p class="errorlog">请输入运单号</p>
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
    <div class="bgfff">
      <div class="bussiescont-toppart">
        <h2>- 查询结果 -</h2>
      </div>
    </div>
    <div class="bgf5">
      <div class="billdetail">
        <div class="havetwop">
          <p>发货订单ID：<?php echo $sResult['ORDER_ID'];?></p>
          <p class="orderstyle">订单状态：<span><?php echo $sResult['STATUS'];?></span></p>
        </div>  
        <p><span class="icons-bill icon-order"></span>订单：<?php echo $sResult['C_ORDER_NO'];?></p>
        <p><span class="icons-bill icon-from"></span><?php echo $sResult['SRC_ADDRESS'];?><span class="billtime"><?php echo $sResult['CREATED_DATE'];?></span></p>
        <p><span class="icons-bill icon-to"></span><?php echo $sResult['DEST_ADDRESS'];?></p>
        <!-- <p><span class="icons-bill icon-contact"></span>张三&nbsp; 18526155155</p> -->
      </div>
      <div class="line-dashad"></div>
      <div class="billdetail">
        <!-- <p>发货订单ID：E30050108.001</p> -->
        <p>客户ID：<?php echo $sResult['CUSTOMER_NAME'];?></p>
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
  </div>

<script>
    $('#searchBtn').click(function(){
        $('#searchForm').submit();
    })
</script>

  <?php get_footer(); ?>