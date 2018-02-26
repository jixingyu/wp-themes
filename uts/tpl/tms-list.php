<?php
/*
Template Name: 查询列表
*/
  get_header();
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
    <div class="search-textarea">
      <div class="userinfo"><h5 class="dis-min">用户名：13500000000</h5> <a href="logout" class="logoutbtn dis-min">退出</a></div>
      <textarea  id="billsNo" name="billsNo" placeholder="点击输入运单号" onfocus="if(placeholder=='点击输入运单号') {placeholder=''}" onblur="if (value=='') {placeholder='点击输入运单号'}"></textarea>
      <p class="errorlog">请输入运单号</p>
      <div class="search-btn" id="search-btn">开始查询</div>
      <p>可同时查询10条，以逗号、空格、回车键隔开</p>
    </div>
    <div class="search-list bgf8">
      <div class="bussiescont-toppart">
        <h2>查询结果</h2>
      </div>
      <div class="search-list-table">
        <table>
          <tr id="tableth">
            <td class="first-td">
              运单号
            </td>
            <td class="second-td">
              订单号
            </td>
            <td class="third-td">
              订单状态
            </td>
            <td class="fourth-td"> 
              订单详情
            </td>
          </tr>
         
          <tr>
            <td class="first-td">
              SP1709090015
            </td>
            <td class="second-td">
              FHC-4
            </td>
            <td class="third-td type01">
              配送中
            </td>
            <td class="fourth-td"> 
              起点：上海市上海市西畴路376号<br>
              终点：玉兰路88号2-201大金售后<br>
              收货人：李二 18900000000
            </td>
          </tr>
          <tr>
            <td class="first-td">
              SP1709090015
            </td>
            <td class="second-td">
              FHC-4
            </td>
            <td class="third-td type02">
              已签收
            </td>
            <td class="fourth-td"> 
              起点：上海市上海市西畴路376号<br>
              终点：玉兰路88号2-201大金售后<br>
              收货人：李二 18900000000
            </td>
          </tr>
          <tr>
            <td class="first-td">
              SP1709090015
            </td>
            <td class="second-td">
              FHC-4
            </td>
            <td class="third-td type01">
              配送中
            </td>
            <td class="fourth-td"> 
              起点：上海市上海市西畴路376号<br>
              终点：玉兰路88号2-201大金售后<br>
              收货人：李二 18900000000
            </td>
          </tr>
          <tr>
            <td class="first-td">
              SP1709090015
            </td>
            <td class="second-td">
              FHC-4
            </td>
            <td class="third-td type02">
              已签收
            </td>
            <td class="fourth-td"> 
              起点：上海市上海市西畴路376号<br>
              终点：玉兰路88号2-201大金售后<br>
              收货人：李二 18900000000
            </td>
          </tr>
        </table>
        <div class="center loading" >
          <img src="<?php bloginfo('template_url');?>/img/loading.gif" alt="" />
        </div>
        <div class="getmore" id="getmorebill">
          <span class="iconspng icon-down"></span>
        </div>
        
      </div>
    
    </div>

  </div>
  <script>
  (function(){
    // 查询运单
    var bills=[],billsNo='';

    $('#search-btn').on('click',function(){
      var data={};
      // 
      billsNo = $.trim($('#billsNo').val());
      console.log(billsNo);

      !billsNo && $('#billsNo').next().text('请输入运单号').show();
      
      return false;
      
      
      data.bills = billsNo;
      // 提交到后台

      // $.ajax({
      //  type: "POST",
      //  url: "#",
      //  data: data,
      //  dataType: "json",
      //  success: function(data){
      //     restbillarea();
      
      //   }
      // });
    })
    function restbillarea(){
      $('#billsNo').val('').blur();;
      $('#search-btn .errorlog').text('');
    }



    // 运单列表
    var p=1,pz=5,htmlBill="",data={},hasMore=true;

    $('#getmorebill').on('click',function(){
      p++;
      getBillslist(p);
    });
    function getBillslist(p){
      if (!hasMore) {
        return;
      }
      $.ajax({
       type: "GET",
       url: "/wp-admin/admin-ajax.php?action=xy_more_posts&cat=<?php echo $cat_ID;?>&l=" + pz + "&p="+p,
       dataType: "json",
       success: function(data){
          if(data.data.length > 0){
            console.log(data);
            $.each(data.data,function(i,item){

              // var url = item.url,
              //     imgsrc = item.img,
              //     title = item.title,
              //     time = item.date; 
                  // view = item.views
                  // content = item.content;
                  // if(content.length>55){
                  //   content = item.content.substr(0,55)+"...";
                  // }

              htmlBill+='<tr><td class="first-td">SP1709090015</td><td class="second-td">FHC-4</td><td class="third-td type01">配送中</td><td class="fourth-td"> 起点：上海市上海市西畴路376号<br>终点：玉兰路88号2-201大金售后<br>收货人：李二 18900000000</td></tr>';
            
            });
            $('.loading').fadeIn();
            
            setTimeout(function(){
              if (data.data.length < pz) {
              console.log("小于所有内容条数~");
              $('#getmorebill').fadeOut();
              $('#totop').fadeIn();
              }else{
                $('#getmorebill').fadeIn();
              }

              $('.loading').fadeOut();
              
              $('#tableth').after(htmlBill);
            },500)
          } else {
            hasMore = false;
            console.log("没有更多了~");
            $('#getmorebill').fadeOut();
            $('#totop').fadeIn();
          }
        }
      });
    }
  });
  </script>
  
  <?php get_footer(); ?>