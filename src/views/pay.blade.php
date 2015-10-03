<!doctype html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>微信安全支付</title>
    <script type="text/javascript">

      //调用微信JS api 支付
      function jsApiCall()
      {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            <?php echo $jsApiParameters ?>,
            function(res){
              WeixinJSBridge.log(res.err_msg);


              if(res.err_msg == 'get_brand_wcpay_request:ok'){
                //redirect to xx page
              }else if(res.err_msg == 'get_brand_wcpay_request:cancel'){
                //redirect to xx page
              }else if(res.err_msg == 'get_brand_wcpay_request:fail'){
                //redirect to xx page
              }else{
                alert(res.err_code+res.err_desc+res.err_msg);
              }

              window.location.href = "<?php echo $return_url ?>";
            }
        );
      }


      function callPay()
      {
        if (typeof (WeixinJSBridge) == "undefined"){
          if( document.addEventListener ){
             document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
          }else if (document.attachEvent){
            document.attachEvent('WeixinJSBridgeReady', jsApiCall);
            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
          }
        }else{
          jsApiCall();
        }
      }

      callPay(); //直接调用支付接口，如果有需要也可以在 body 显示一些订单相关或其他信息，或在body里添加按钮触发支付接口

    </script>
  </head>

  <body>
  </body>

</html>
