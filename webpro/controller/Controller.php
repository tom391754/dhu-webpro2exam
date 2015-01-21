<?php

require_once APP_HOME . 'tools/tSmarty.php';


class Controller
{
	/**
     * cSmarty Object
     *
     * @var cSmarty
     */
    private $smarty;
	
    public function __construct(){
        $this->smarty = tSmarty::getInstance();
    }
	/**
     * 设置smarty的参数
     * 
     * @param mixed $key   如果只传一个参数，则是参数一个数组；如果传两个参数，是参数名。
     * @param mixed $value 第一个参数的值。
     * 
     * @return void
     */
    public function assign(){
        $argNum = func_num_args();
        if ($argNum === 2) {
            $key = func_get_arg(0);
            $value = func_get_arg(1);
            $this->smarty->assign($key, $value);
        } elseif ($argNum === 1) {
            $arr = func_get_arg(0);
			if(is_array($arr))
			{
				$this->smarty->assign($arr);
			}
        }
    }
    
    /**
     * 展示一个模板
     *
     * @param string $template 模板路径名
     * 
     * @return void
     */
    public function display($template){
        $this->smarty->display($template);
    }
	/**
     * 获取客户端IP
     * @return string $onlineip
     */
    public function getClientIp(){
        if(getenv('HTTP_CLIENT_IP')) {
            $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR')) {
            list($onlineip) = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
        } elseif(getenv('REMOTE_ADDR')) {
            $onlineip = getenv('REMOTE_ADDR');
        } else {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }
        return $onlineip;
    }
    /**
     * 页面跳转方法
     * @param string $url 需要跳转到的页面
     * @return void
     */
    public function pubRedirect($url){
    	if($url != ''){
    		header('location:' . $url);
    	}
    }
}
?>