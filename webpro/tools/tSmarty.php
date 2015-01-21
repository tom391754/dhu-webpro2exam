<?php
/**
 * 封装了tSmarty
 *
 * PHP versions 5
 *
 */

require_once 'Smarty.class.php';

/**
 * tSmarty，封装了tSmarty
 *
 * @author   wangzhan
 */
class tSmarty extends Smarty
{
    /**
     * 本类生成的对象
     *
     * @var HSimple_Smarty
     */
    private static $instance;
    
    /**
     * 构造HSimple_Smarty
     *
     */
	public function __construct(){
		$this->Smarty();
		
		$this->template_dir = APP_HOME . 'view/';
		$this->compile_dir  =  PATH_WRITABLE . 'compiled/';
		$this->cache_dir = PATH_WRITABLE . 'cache/';
		$this->config_dir = PATH_WRITABLE . 'config/';
		$this->caching = false;
		$this->compile_check = true;
	}
	
	/**
	 * 得到一个HSimple_Smarty实例
	 *
	 * @return HSimple_Smarty
	 */
	public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$instance = new tSmarty();
        }
        return self::$instance;
	}
}
?>