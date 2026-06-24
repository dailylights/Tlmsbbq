<?php
namespace Lib;
class HY
{
	public static function init(){
		//自动加载类
		spl_autoload_register('Lib\\HY::autoload');
		if (DEBUG) {
            error_reporting(E_ALL | E_STRICT);
            //error_reporting(E_ALL & ~(E_NOTICE | E_STRICT));
            @ini_set('display_errors', 'ON');
        } else {
            error_reporting(0);
            @ini_set('display_errors', 'OFF');
        }
        //自定义的错误处理函数
        //set_error_handler('Lib\\HY::hy_error');
        //自定义的异常处理函数
        //set_exception_handler('Lib\\HY::hy_exception');
        

        $config = 
        include HY_PATH . 'common/conf.php';
        include HY_PATH . 'common/function.php';

        $config = array_merge($config,include CONF_PATH . 'config.php');

        C($config);

        define('EXT',C("url_suffix"));
        define('EXP',C("url_explode"));
        
        define('IS_MOBILE',hy_is_mobile());
        define('IS_SHOUJI',IS_MOBILE);
        define('IS_WAP',IS_MOBILE);


        //路由器
        \HY\Lib\Line::run();



        $GLOBALS['END_TIME'] = microtime(TRUE);
        if (C('DEBUG_PAGE')) {
            $DEBUG_SQL = $GLOBALS['SQL_LOG'];
            if (empty($url)) {
                $url = '/';
            } else {
                $url = '/' . $url;
            }
            $DEBUG_CLASS = $GLOBALS['LOAD_CLASS'];
            require HY_PATH . 'View/Debug.php';
        }
	}
	public static function autoload($class){

        if (isset($GLOBALS['LOAD_CLASS'][$class])) {//加载过 
            //echo $class."\r\n";
            return;
        }
        $className = ltrim($class, '\\');  
        $filePath  = '';  
        $namespace = '';  
        if ($lastNsPos = strrpos($className, '\\')) {  
            $namespace = substr($className, 0, $lastNsPos);  
            $className = substr($className, $lastNsPos + 1);  
            $filePath  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;  
        }
        $filePath .= $className .'.php';
        

        
        if (!is_file(PATH . $filePath)) { //自动加载路劲不存在 启用映射搜索
            $vendor_bool = false;
            foreach (C('vendor') as $v) {
                $vendor_path = ltrim($v,'\\/') . DIRECTORY_SEPARATOR . $filePath;
                //echo PATH . $vendor_path."\r\n";
                if(is_file(PATH . $vendor_path)){
                    $filePath = $vendor_path;
                    $vendor_bool=true;
                    break;
                }
            }
            if(!$vendor_bool){
                //E('类库不存在 : ' . $class . ' 加载路径:'.$filePath);
                return false;
            }
                
        }
        $filePath = PATH . $filePath;
      	$info = explode('\\', $class);
        $agrs =count($info);
        if ($info[0] == 'Model') {
            \HY\Lib\Hook::$include_file[]=$filePath;
            if (PLUGIN_ON) {
                $cache_filePath = TMP_PATH . $info[1] . '_' . MD5('Model/' . $info[1]) . C("tmp_file_suffix");
                \HY\Lib\Plugin::run($filePath,$cache_filePath,$class);
                $filePath = $cache_filePath;
            }
        } elseif ($info[0] == 'Action') {
            \HY\Lib\Hook::$include_file[]=$filePath;
            if (PLUGIN_ON) {
                $cache_filePath = TMP_PATH . $info[1] . '_' . MD5('Action/' . $info[1]) . C("tmp_file_suffix");
                \HY\Lib\Plugin::run($filePath,$cache_filePath,$class);
                $filePath = $cache_filePath;
            }
        }

        if (empty($filePath)) {
            return false;
        }
       	//echo $filePath.'<br>';
        include_once $filePath;
        $GLOBALS['LOAD_CLASS'][$class] = true;
        return $filePath;
    }
}