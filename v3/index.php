<?php
//ini_set("display_errors", "On");
//error_reporting(E_ALL);

require_once('init.php');
require_once('class/danmu.class.php');


$d = new danmu();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $d_data = json_decode(file_get_contents('php://input'),true);
    // 限制发送频率
    $lock = 1;
    $ip = get_ip();
    $data = sql::查询_发送弹幕次数($ip);
    
    if (empty($data)){
        sql::插入_发送弹幕次数($ip);
        $lock = 0;
    } else {
        $data = $data[0];
        
        if ($data['time'] + $_config['限制时间'] > time()){
            if($data['c'] < $_config['限制次数']){$lock = 0 ; sql::更新_发送弹幕次数($ip);};
        }
        
        if ($data['time'] + $_config['限制时间'] < time()){
           sql::更新_发送弹幕次数($ip,time());
           $lock = 0;
        }
    }
    
    

    
    if($lock === 0){
        $d->添加弹幕($d_data);
        showmessage(0,true);
    } else {
        showmessage(-2,"你tm发送的太频繁了,请问你单身几年了？");
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $id = $_GET['id'] ?: showmessage(-1,null);
    $data = $d->弹幕池($id) ?: showmessage(0,[]);
    showmessage(0,$data);
}



