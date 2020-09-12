    if( diyvodid > 0)
	{var dmid=diyid,dmsid=diysid;}
	else
	{
	var dmid=vodid,dmsid=vodsid;
	}
        if( laoding > 0){}else{ var css ='<style type="text/css">';css+='#loading-box{display: none;}';css+='</style>';$('body').append(css).addClass("");}    // 加载播放器
    if( danmuon > 0){
	var dp = new yzmplayer({autoplay: autoplay,element: document.getElementById('player'),theme: color,logo: logo,video: {url: vodurl,pic: vodpic,type: 'auto',},danmaku: {id: dmid,api: dmapi,user: user,}});
	}else{$('body').addClass("danmu-off");
	var dp = new yzmplayer({autoplay: autoplay,element: document.getElementById('player'),theme: color,logo: logo,video: {url: vodurl,pic: vodpic,type: 'auto',},});}
    // 弹出框
    //function alert_back(text) {$(".alert_back").html(text).show();setTimeout(function () { $(".alert_back").fadeOut('slow'); },1200)}
    // 通用点击
	add('.yzmplayer-list-icon',".yzmplayer-danmu",'show');
	function add(div1,div2,div3,div4) {$(div1).click(function() {$(div2).toggleClass(div3);$(div4).remove();});}
    //秒转分秒
    function formatTime(seconds) {return [parseInt(seconds / 60 / 60),parseInt(seconds / 60 % 60),parseInt(seconds % 60)].join(":").replace(/\b(\d)\b/g, "0$1");}
	//设置浏览器缓存项值，参数：项名,值,有效时间(小时)
	function setCookie(c_name, value, expireHours) {var exdate = new Date();exdate.setHours(exdate.getHours() + expireHours);document.cookie = c_name + "=" + escape(value) + ((expireHours === null) ? "" : ";expires=" + exdate.toGMTString());}
	//获取浏览器缓存项值，参数：项名
	function getCookie(c_name) {if (document.cookie.length > 0) {c_start = document.cookie.indexOf(c_name + "=");if (c_start !== -1) {c_start = c_start + c_name.length + 1;c_end = document.cookie.indexOf(";", c_start);if (c_end === -1) {c_end = document.cookie.length;};return unescape(document.cookie.substring(c_start, c_end));}}return "";}
	dp.on("loadedmetadata", function () {loadedmetadataHandler();});
    dp.on("ended", function () {endedHandler();});
    var playtime= Number(getCookie("time_"+ vodurl));
    var ctime= formatTime(playtime);
    function loadedmetadataHandler() {
        if ( playtime > 0 && dp.video.currentTime < playtime) {
                   setTimeout(function () {video_con_play() }, 1 * 1000);
        } else { dp.notice("视频已准备就绪，即将为您播放");setTimeout(function () {video_play() }, 1 * 1000);}
                   dp.on("timeupdate", function () {timeupdateHandler();});
	}
	//播放进度回调  	
    function timeupdateHandler() {setCookie("time_"+ vodurl,dp.video.currentTime,24);}
    //播放结束回调		
    function endedHandler() {
    setCookie("time_"+ vodurl,"",-1);
    if (next!='') {dp.notice("5s后,将自动为您播放下一集");setTimeout(function () {video_next();}, 5 * 1000);
         } else{dp.notice("视频播放已结束");setTimeout(function () {video_end();}, 2 * 1000); }}
    if (next!=''){ }else {$(".icon-xj").remove();};
    function video_next() {top.location.href = playnext;}
    function video_seek() {dp.seek(playtime);}
    $(".yzmplayer-showing").on("click", function () {dp.play();$(".vod-pic").remove();});
    //个性化弹幕框		
	$(".yzmplayer-comment-setting-color input").on("click", function () {
    var textcolor = $(this).attr("value"); 
    setTimeout(function (){$('.yzm-yzmplayer-comment-input').css({"color":textcolor});}, 100);
    });
    $(".yzmplayer-comment-setting-type input").on("click", function () {
    var texttype = $(this).attr("value"); 
    setTimeout(function (){$('.yzm-yzmplayer-comment-input').attr("dmtype",texttype);}, 100);
    });
    $("#dmset").on("click", function () {
    $(".yzmplayer-comment-icon").trigger("click");
    $(".yzmplayer-comment-setting-box").toggleClass("yzmplayer-comment-setting-open") 
    $("#yzmplayer").toggleClass("yzmplayer-hide-controller") 
    });

    $(".yzm-yzmplayer-send-icon").on("click", function () {
    var inputtext = document.getElementById("dmtext");
    var sendtexts = inputtext.value;
    var sendtype =$('.yzm-yzmplayer-comment-input').attr("dmtype");
    var sendcolor = $('.yzmplayer-comment-input').css("color"); 
    var sendtext = sendtexts.replace(new RegExp(pbgjz.join('|'),'img'),'*');
    if(sendtext.length < 1){dp.notice("要输入弹幕内容啊喂！");return;
    }else{dp.danmaku.send({text: sendtext,color: sendcolor,type: sendtype,});
    };
    $(".yzm-yzmplayer-comment-input").val("");
    })
dp.danmaku.opacity(1);
    //弹幕列表获取
	
$(".yzmplayer-list-icon,.yzm-yzmplayer-send-icon").on("click", function () {		   
	$(".list-show").empty();
	$.ajax({
    url:dmapi+"?id="+dmid,
    success:function (data) {
            if (data.code == 0) {
                var danmaku = data.danmaku;
                $(".danmuku-num").text(danmaku.length)
                $(danmaku).each(function(index, item) {
                    var dammulist = `<d class="danmuku-list" time="${item[0]}"><li>${formatTime(item[0])}</li><li title="${item[4]}">${item[4]}</li><li title="用户：${item[3]}">${item[5]}</li></d>`
                    $(".list-show").append(dammulist);
                })
            }
            $(".danmuku-list").on("click", function() {dp.seek($(this).attr("time"))})
    }
	});
});
         setTimeout(function () {$("#link1").fadeIn();}, 1 * 500);
         setTimeout(function () {$("#link2").fadeIn();}, 1 * 1000);
         setTimeout(function () {$("#link3,#span").fadeIn();}, 2 * 1000);
         $(".yzmplayer-fulloff-icon").on("click", function () {dp.fullScreen.cancel();})
    //播放loading元素		
function video_play() {
         $("#link3").text("视频已准备就绪，即将为您播放");
         setTimeout(function () {dp.play();$("#loading-box").remove();}, 1 * 1500);
	};
function video_con_play() {
        if( laoding > 0)
        {
         var conplayer = ` <e>已播放至${ctime}，继续上次播放？</e><d class="conplay-jump">是 <i id="num">10</i>s</d><d class="conplaying">否</d>`
         $("#link3").html(conplayer);
         //setTimeout(function () {$("#laoding-pic,.memory-play-wrap,#loading-box").remove();dp.play();}, 15 * 1000);
         var span = document.getElementById('num');
         var num = span.innerHTML;
         var timer = null;
         setTimeout( function(){
		timer = setInterval(function(){
			num--;	
			span.innerHTML = num;
			if(num == 0){
			clearInterval(timer);video_seek();dp.play();$("#laoding-pic,.memory-play-wrap,#loading-box").remove();
		}
		},1000);
	},1 );
	}else{dp.play();}
         var cplayer = `<div class="memory-play-wrap"><div class="memory-play"><span class="close">×</span><span>上次看到 </span><span>${ctime}</span><span class="play-jump">跳转播放</span></div></div>`
             $(".yzmplayer-cplayer").append(cplayer);
             $(".close").on("click", function () {$(".memory-play-wrap").remove();});
             setTimeout(function () {$(".memory-play-wrap").remove();}, 20 * 1000);
         $(".conplaying").on("click", function () {clearTimeout(timer);$("#laoding-pic,#loading-box").remove();dp.play();});
         $(".conplay-jump,.play-jump").on("click", function () {clearTimeout(timer);video_seek();$("#laoding-pic,.memory-play-wrap,#loading-box").remove();dp.play();});
	};
