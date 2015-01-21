<?php
/**
 * Front，请求前端接受器
 *
 * PHP versions 5
 *
 * @author   wangzhan
 */

/**
 * Front，请求前端接受器
 *
 * @package  controller
 * @author   wangzhan
 */
class Front
{
    /**
     * 请求的地址
     *
     * @var string
     */
    static private $requestUrl;
    
    /**
     * 得到应该请求的地址（经过转换）
     *
     * @return string 经过转换的地址
     */
    static public function getRequestUrl(){
        if (empty(self::$requestUrl)) {
            $path = $_SERVER['REQUEST_URI'];
            $domain = 'http://' .(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']: getenv('HTTP_HOST'));
            self::$requestUrl = $domain . $path;
        }
        return self::$requestUrl;
    }
    
    /**
     * 接受请求，然后进行分配
     *
     * @return void
     */
    static public function run(){
        $url = self::getRequestUrl();
        $urlArray = parse_url($url);
		//print_r($urlArray);
		$url = $_SERVER['PHP_SELF'];
        self::dispatch($urlArray);
    }
    
    /**
     * 分配请求
     *
     * @param array $urlArray
     * 
     * @return void
     */
    static public function dispatch($urlArray){
		//$urlArray['path'] = ucfirst(str_replace('Zend/webpro/', '', $urlArray['path']));
		//echo 'qq:'.explode('.',$urlArray['path'])[sizeof(explode('.',$urlArray['path']))-1];
		$urlArray['path'] = explode('/',$urlArray['path'])[sizeof(explode('/',$urlArray['path']))-1];
		if(explode('.',$urlArray['path'])[sizeof(explode('.',$urlArray['path']))-1]=='js') {
			header('Content-type: text/javascript');
			$requireFile = APP_HOME . 'content/js/' . $urlArray['path'];
			require_once $requireFile;
		} else if(explode('.',$urlArray['path'])[sizeof(explode('.',$urlArray['path']))-1]=='css') {
			header('Content-type: text/css');
			$requireFile = APP_HOME . 'content/css/' . $urlArray['path'];
			require_once $requireFile;
		} else if(explode('.',$urlArray['path'])[sizeof(explode('.',$urlArray['path']))-1]=='jpg'
			|| explode('.',$urlArray['path'])[sizeof(explode('.',$urlArray['path']))-1]=='png') {
			header('Content-type: image/jpeg');
			$requireFile = APP_HOME . 'content/images/' . $urlArray['path'];
			require_once $requireFile;
		} else if(explode('.',$urlArray['path'])[sizeof(explode('.',$urlArray['path']))-1]=='ttf'
			|| explode('.',$urlArray['path'])[sizeof(explode('.',$urlArray['path']))-1]=='woff') {
			header('Content-type: application/x-font-woff');
			$requireFile = APP_HOME . 'content/fonts/' . $urlArray['path'];
			require_once $requireFile;
		} 
		
		else {
			//Action
			$urlArray['path'] = explode('.',$urlArray['path'])[0];
			if ($urlArray['path'] === '') {
				$urlArray['path'] = 'Index';
			}
			//echo $urlArray['path'];
			$requireFile = APP_HOME . 'controller' . '/' . $urlArray['path'] . 'Controller.php';
			if (is_file($requireFile)) {
				require_once $requireFile;
				$controllerName = $urlArray['path'];
				$controller = new $controllerName;
				$controller->run();
			}
		}
		
		//echo $requireFile;

    }
}
?>