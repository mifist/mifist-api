<?php //	Автоматическая загрузка классов
namespace common;
class MifistAutoload
{
    private static $instance = null;
    private function __construct() {
        spl_autoload_register(array($this, 'autoload_namespace'));
    }

    public static function getInstance(){
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * @param $className
     */
    public function autoload_namespace($className){
        $fileClass = MIFISTAPI_PlUGIN_DIR.'/'.str_replace("\\","/",$className).'.php';
        if (file_exists($fileClass)) {
            if (!class_exists($fileClass, FALSE)) {
                require_once $fileClass;
            }
        }
    }
}
MifistAutoload::getInstance();