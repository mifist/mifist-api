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
	    
	   
	
	    // Add a filter to the attributes metabox to inject template into the cache.
	    if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
		    // 4.6 and older
		    add_filter( 'page_attributes_dropdown_pages_args',  BackPagesModel::registerPagesTemplates()  );
		
	    } else {
		    // Add a filter to the wp 4.7 version attributes metabox
		    add_filter( 'theme_page_templates', BackPagesModel::addNewTemplate()  );
	    }
	
	    // Add a filter to the save post to inject out template into the page cache
	    add_filter( 'wp_insert_post_data',  BackPagesModel::registerPagesTemplates()  );
	
	    // Add a filter to the template include to determine if the page has our
	    // template assigned and return it's path
	    add_filter( 'template_include', BackPagesModel::viewPagesTemplates() );
	    
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