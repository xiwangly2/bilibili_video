<?php
class sql {
    public static $sql ;
    private static $type ;
    
    function __construct($type) {
        global $_config ;
        self::$type = $type;
        if ($type === 'mysql') {
            
            self::mysql数据库连接($_config['数据库']['地址'],$_config['数据库']['用户名'],$_config['数据库']['密码'],$_config['数据库']['名称']);
        } 
        
        if ($type === 'sqlite') {
            self::sqlite数据库连接($_config['数据库']['地址']);
        }
        
    }

    private static function mysql数据库连接($hostname,$username,$password,$db) {
        try {
            $sql = new PDO("mysql:host=$hostname;dbname=$db;", $username, $password);
            $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$sql = $sql ;
        } catch (PDOException $e) {
            showmessage(-1,'数据库错误:'.$e->getMessage());
        }
    }
    
    private static function sqlite数据库连接($path) {
        try {
            $sql = new PDO("sqlite:$path");
            $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$sql = $sql ;
        } catch (PDOException $e) {
            showmessage(-1,'数据库错误:'.$e->getMessage());
        }
    }
    
    public static function 插入_弹幕($data){
        try {
            $query = null;
            if (self::$type == 'sqlite') $query = ' OR';
            $stmt = self::$sql->prepare("INSERT{$query} IGNORE INTO danmaku_list (id, type, text, color, videotime, time) VALUES (:id, :type, :text, :color, :videotime, :time)");
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':type', $data['type']);
            $stmt->bindParam(':text', $data['text']);
            $stmt->bindParam(':color', $data['color']);
            $stmt->bindParam(':videotime', $data['time']);
            @$stmt->bindParam(':time', time());
            $stmt->execute();
        } catch (PDOException $e) {
            showmessage(-1,'数据库错误:'.$e->getMessage());
        }
        
    }
    
    public static function 插入_发送弹幕次数($ip){
        try {
            $query = null;
            if (self::$type == 'sqlite') $query = ' OR';
            $stmt = self::$sql->prepare("INSERT{$query} IGNORE INTO danmaku_ip (ip, time) VALUES (:ip, :time)");
            $stmt->bindParam(':ip', $ip);
            @$stmt->bindParam(':time', time());
            $stmt->execute();
        } catch (PDOException $e) {
            showmessage(-1,'数据库错误:'.$e->getMessage());
        }
    }
    
    public static function 查询_弹幕池($id){
        try {
            $stmt = self::$sql->prepare("SELECT * FROM danmaku_list WHERE id=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data = $stmt->fetchAll();
            return $data;
        } catch (PDOException $e) {
            showmessage(-1,'数据库错误:'.$e->getMessage());
        }
    }
    
    public static function 查询_发送弹幕次数($ip){
        try {
            $stmt = self::$sql->prepare("SELECT * FROM danmaku_ip WHERE ip=:ip LIMIT 1");
            $stmt->bindParam(':ip', $ip);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data = $stmt->fetchAll();
            return $data;
        } catch (PDOException $e) {
            showmessage(-1,'数据库错误:'.$e->getMessage());
        }
    }
    
    public static function 更新_发送弹幕次数($ip,$time = 'time'){
        try {
            $query = "UPDATE danmaku_ip SET c=c+1,time=$time WHERE ip = :ip";
            if (is_int($time)) $query = "UPDATE danmaku_ip SET c=1,time=$time WHERE ip = :ip"; 
            $stmt = self::$sql->prepare($query);
            
            $stmt->bindParam(':ip', $ip);
            $stmt->execute();
        } catch (PDOException $e) {
            showmessage(-1,'数据库错误:'.$e->getMessage());
        }
    }
} 