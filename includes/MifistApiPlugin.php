<?php // Главный файл плагина
//Регистрируем функцию, которая будет срабатывать во время деактивации и активации плагина в классе плагина mifist_Api_plugin


namespace includes;
use includes\common\MifistDefaultOption;
use backend\default_pages\models\BackPagesModel;
use includes\common\MifistLoader;
use includes\common\GetInstance;

use backend\guest_book\menu\models\GuestBookModel;

class MifistApiPlugin {
	use GetInstance;
    private function __construct() {
        MifistLoader::getInstance();
	    add_action('plugins_loaded', array(&$this, 'setDefaultOptions'));
	    
	    
    }
	
	/**
	 * Если не созданные настройки установить по умолчанию
	 */
	public function setDefaultOptions(){
		if( ! get_option(MIFISTAPI_PlUGIN_OPTION_NAME) ){
			update_option( MIFISTAPI_PlUGIN_OPTION_NAME, MifistDefaultOption::getDefaultOptions() );
		}
		if( ! get_option(MIFISTAPI_PlUGIN_OPTION_VERSION) ){
			update_option(MIFISTAPI_PlUGIN_OPTION_VERSION, MIFISTAPI_PlUGIN_VERSION);
		}
	}
	
    static public function activation()
    {
	    // debug.log
	    error_log('plugin '.MIFISTAPI_PlUGIN_NAME.' activation');
	    //Создание таблицы Гостевой книги
	    GuestBookModel::createTable();
	    error_log('plugin '.MIFISTAPI_PlUGIN_NAME.' create Default Pages');
	    BackPagesModel::createDefaultPage();
	   
	    
	    
    }

    static public function deactivation()
    {
        // debug.log
        error_log('plugin '.MIFISTAPI_PlUGIN_NAME.' deactivation');
	    delete_option(MIFISTAPI_PlUGIN_OPTION_NAME);
	    delete_option(MIFISTAPI_PlUGIN_OPTION_VERSION);
	    GuestBookModel::deleteTable();
	    error_log('plugin '.MIFISTAPI_PlUGIN_NAME.' delete Table');
	    error_log('plugin '.MIFISTAPI_PlUGIN_NAME.' delete Default Pages Option');
	    BackPagesModel::deleteDefaultPageOption();
    }

}

MifistApiPlugin::getInstance();