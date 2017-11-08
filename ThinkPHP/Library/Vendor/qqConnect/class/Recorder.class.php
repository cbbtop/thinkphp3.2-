<?php
/* PHP SDK
 * @version 2.0.0
 * @author connect@qq.com
 * @copyright © 2013, Tencent Corporation. All rights reserved.
 */

require_once(QQ_CONNECT_SDK_CLASS_PATH."ErrorCase.class.php");
class Recorder{
    private static $data;
    private $inc;
    private $error;

    public function __construct(){
        $this->error = new ErrorCase();

        //-------读取配置文件
        $this->inc->appid = '101429322';
        $this->inc->appkey = '5a7d705be1961c68c9f875a9f70a1d3f';
        $this->inc->callback = 'http://www.cbbtop.com/Index/callback';
        $this->inc->scope = 'get_user_info';
        $this->inc->errorReport = true;
        $this->inc->storageType = 'file';
        $this->inc->host = 'localhost';
        $this->inc->user = 'root';
        $this->inc->password = 'root';
        $this->inc->database = 'test';


        if(empty($this->inc)){
            $this->error->showError("20001");
        }

        if(empty($_SESSION['QC_userData'])){
            self::$data = array();
        }else{
            self::$data = $_SESSION['QC_userData'];
        }
    }

    public function write($name,$value){
        self::$data[$name] = $value;
    }

    public function read($name){
        if(empty(self::$data[$name])){
            return null;
        }else{
            return self::$data[$name];
        }
    }

    public function readInc($name){
        if(empty($this->inc->$name)){
            return null;
        }else{
            return $this->inc->$name;
        }
    }

    public function delete($name){
        unset(self::$data[$name]);
    }

    function __destruct(){
        $_SESSION['QC_userData'] = self::$data;
    }
}
