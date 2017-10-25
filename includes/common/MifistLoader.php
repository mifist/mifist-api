<?php // Файл сборки плагина
namespace includes\common;

// Пути namespace к классам

use frontend\shortcodes\controllers\MifistTextShortcodeController;
use frontend\shortcodes\controllers\MifistShortcode;
// custom  menu
use backend\menu\controllers\MifistMainAdminMenuController;
//options menu
use backend\menu\controllers\MifistMainAdminOptionsMenuController;
// guest book menu
use backend\menu\controllers\MifistGuestBookSubMenuController;
// GUEST BOOK
use frontend\shortcodes\controllers\MifistGuestBookShortcodesController;
use frontend\shortcodes\controllers\MifistGuestBookAjaxShortcodesController;
// Widget
use backend\widgets\MifistGuestBookDashboardWidget;
// Ajax
use frontend\ajax\MifistGuestBookAjaxHandler;

// custom backend menu
use  backend\menu\controllers\MifistMyDashboardMenuController;
use  backend\menu\controllers\MifistMyOptionsMenuController;
use  backend\menu\controllers\MifistMyPagesMenuController;

// example
use includes\example\MifistExampleAction;
use includes\example\MifistExampleFilter;

class MifistLoader {
	use GetInstance;
	
	// инициализируем новый класс как объект
    private function __construct(){
        // is_admin() Условный тег. Срабатывает когда показывается админ панель сайта (консоль или любая
        // другая страница админки).
        // Проверяем в админке мы или нет
        if ( is_admin() ) {
            $this->admin(); // Когда в админке вызываем метод backend()
        } else {
            $this->site(); // Когда на сайте вызываем метод site()
        }
        $this->all();
    }
	
    /**
     * Метод будет срабатывать когда вы находитесь в Админ панеле. Загрузка классов для Админ панели
     */
    public function admin(){
    	// MENU
	    MifistMainAdminMenuController::newInstance();
	    MifistMainAdminOptionsMenuController::newInstance();
	    // menu for guest book
	    MifistGuestBookSubMenuController::newInstance();
	    // Подключаем виджет гостевой книги
	    MifistGuestBookDashboardWidget::newInstance();
	    
	    // custom backend menu
//	    MifistMyDashboardMenuController::newInstance();
//	    MifistMyOptionsMenuController::newInstance();
//	    MifistMyPagesMenuController::newInstance();
//	    MifistMyPluginsMenuController::newInstance();
    }

    /**
     * Метод будет срабатывать когда вы находитесь Сайте. Загрузка классов для Сайта
     */
    public function site(){
	    MifistTextShortcodeController::newInstance();
	    // Шорткод для формы гостевой книги
	    MifistGuestBookShortcodesController::newInstance();
	    MifistGuestBookAjaxShortcodesController::newInstance();
    }

    /**
     * Метод будет срабатывать везде. Загрузка классов для Админ панеле и Сайта
     */
    public function all(){
    	// проба создания шорткода
	    MifistShortcode::getInstance();
	    MifistLocalization::getInstance();
	    MifistLoaderScript::getInstance();
	    // подключаем ajax обработчик
	    MifistGuestBookAjaxHandler::newInstance();
	    
	    
	    
	    
//	    MifistExampleAction::newInstance();
//	    $mifistExampleFilter = MifistExampleFilter::newInstance();
//		$mifistExampleFilter->callMyFilter("Roman");
//		$mifistExampleFilter->callMyFilterAdditionalParameter("Roman", "Softgroup", "Poltava");
//		$mifistExampleAction = MifistExampleAction::newInstance();
//		$mifistExampleAction->callMyAction();
//		$mifistExampleAction->callMyActionAdditionalParameter( 'test1', 'test2', 'test3' );
    }
}