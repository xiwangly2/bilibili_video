<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta charset="UTF-8">
<title>DiandianTV -as</title>
<link rel="stylesheet" href="css/yzmplayer.css">
<style> 
.yzmplayer-full-icon span svg,.yzmplayer-fulloff-icon span svg{display: none;}
.yzmplayer-full-icon span,.yzmplayer-fulloff-icon span{background-size:contain!important;float: left;width: 22px;height: 22px;}
.yzmplayer-full-icon span{background: url(./img/full.png) center no-repeat;}
.yzmplayer-fulloff-icon span{background: url(./img/fulloff.webp) center no-repeat;}
#loading-box {background: #fff!important;}
#vod-title{overflow: unset;width: 285px;white-space: normal;color: #fb7299;}
#vod-title e{padding: 2px;}
.layui-layer-dialog{text-align: center;font-size: 16px;padding-bottom: 10px;}
.layui-layer-btn.layui-layer-btn-{padding: 15px 5px !important;text-align: center;}
.layui-layer-btn a{font-size: 12px;padding: 0 11px !important;}
.layui-layer-btn a:hover{border-color: #00a1d6 !important;background-color:#00a1d6 !important;color: #fff !important;}

</style>
<script src="js/yzmplayer.js"></script>
<script src="js/md5.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/hls.min.js"></script>
<script src="js/layer.js"></script>

<script>
var css ='<style type="text/css">';
var d, s ;
d = new Date();
s = d.getHours();
if(s<17 || s>23){ 
css+='#loading-box{background: #fff;}';//白天
}else{
css+='#loading-box{background: #000;}';//晚上
}
css+='</style>';
//$('head').append(css).addClass("");
</script>

</head>
<body>
<div id="player"></div>
<div class="tj"><script type="text/javascript" src="js/z_stat.js"></script></div>
<script>
    // 播放器基本设置
    var playlink ="<?php echo($_REQUEST['myurl']);?>",urlpar ='DiandianTV';
    var dmapi = '<?php echo('http://'.$_SERVER['SERVER_NAME'].'xiwangly.top/v3/');?>',vodurl = '<?php echo($_REQUEST['url']);?>',vodid="<?php echo($_REQUEST['name']);?>",vodsid="<?php echo($_REQUEST['sid']);?>",vodpic="<?php echo($_REQUEST['pic']);?>",vodname="<?php echo($_REQUEST['name']);?>",next = "<?php echo($_REQUEST['next']);?>",ym="http://v.8e.gs";
    var pic="<https://ae01.alicdn.com/kf/H222eb1400c714319a40e62c742cc834bv.jpg";
    var playnext = next ;
    var user = '<?php echo($_REQUEST['user']);?>',group = "<?php echo($_REQUEST['group']);?>",color = '#00a1d6',logo ='logo.png',autoplay = false;
    var danmuon = 1,laoding = 1,diyvodid = 0,pause_ad = 0,usernum = "17";
    //试看时间
    var trytime_f= 3;
    //违规词
    var pbgjz = ['草','操','妈','逼','滚','网址','网站','支付宝','企','q','n','o','c','m','e'];
    //弹幕库获取
    if(playlink!=''){ }else {var diyvodid = 1;};
    diyid = md5(vodurl),diysid = 0;
    //弹幕礼仪链接
    var dmrule = "https://$_SERVER[\"SERVER_NAME\"]/"
    //暂停广告
    var pause_ad_html = '<div id="player_pause" style="position:absolute;z-index:209910539;top:50%;left:50%;border-radius:5px;-webkit-transform:translate(-50%,-50%);-moz-transform:translate(-50%,-50%);transform:translate(-50%,-50%);max-width:80%;max-height:80%;"><div style=" color: #f4f4f4;position: absolute;font-size: 14px;background-color: hsla(0, 0%, 0%, 0.42);padding: 2px 4px;margin: 4px;border-radius: 3px;right: 0;">广告</div><iframe src="http://v.8e.gs/label/ad_2/" frameborder="0" width="100%" height="180" style="background-color: #f4f4f4;width: 320px;border-radius: 5px;"></iframe></div>';
    //播放结束
    function video_end() {alert("播放结束啦=。=")};
</script>
<script src="js/setting.js"></script>
<script>
</script>
</body>
</html>