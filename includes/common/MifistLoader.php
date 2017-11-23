<?php // Файл сборки плагина
namespace includes\common;

// Пути namespace к классам

use frontend\shortcodes\controllers\MifistTextShortcodeController;
use frontend\shortcodes\controllers\MifistShortcode;
// custom  menu
use backend\menu\controllers\MainAdminMenuController;
//options menu
use backend\options\controllers\BackOptionsController;
// guest book menu
use backend\guest_book\menu\controllers\GuestBookController;
// GUEST BOOK
use frontend\guest_book\shortcodes\controllers\GuestBookShortcodesController;
use frontend\guest_book\shortcodes\controllers\GuestBookAjaxShortcodesController;
// Widget
use backend\guest_book\widgets\GuestBookDashboardWidget;
// Ajax
use frontend\guest_book\ajax\GuestBookAjaxHandler;

// custom backend menu
use  backend\menu\controllers\MifistMyDashboardMenuController;
use  backend\menu\controllers\MifistMyOptionsMenuController;
use  backend\menu\controllers\MifistMyPagesMenuController;

// example
use frontend\example\MifistExampleAction;
use frontend\example\MifistExampleFilter;

class MifistLoader {
	use GetInstance;
	
	// инициализируем новый класс как объект
    private function __construct(){
        // is_admin() Условный тег. Срабатывает когда показывается админ панель сайта (консоль или любая
        // другая страница админки).
        // Проверяем в админке мы или нет
        if ( is_admin() ) {
            $this->admin(); // Когда в админке вызываем метод backensd()
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
	    MainAdminMenuController::newInstance();
	    BackOptionsController::newInstance();
	    // menu for guest book
	    GuestBookController::newInstance();
	   
	    // Подключаем виджет гостевой книги
	    GuestBookDashboardWidget::newInstance();
	    
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
	    GuestBookShortcodesController::newInstance();
	    GuestBookAjaxShortcodesController::newInstance();
    }

    /**
     * Метод будет срабатывать везде. Загрузка классов для Админ панеле и Сайта
     */
    public function all(){
    	// проба создания шорткода
	    MifistShortcode::getInstance();
	    MifistLocalization::getInstance();
	    MifistLoaderScript::getInstance();
	    // подключаем ajax обработчик для Guest Book
	    GuestBookAjaxHandler::newInstance();
	    
	    
	    
	    
//	    MifistExampleAction::newInstance();
//	    $mifistExampleFilter = MifistExampleFilter::newInstance();
//		$mifistExampleFilter->callMyFilter("Roman");
//		$mifistExampleFilter->callMyFilterAdditionalParameter("Roman", "Softgroup", "Poltava");
//		$mifistExampleAction = MifistExampleAction::newInstance();
//		$mifistExampleAction->callMyAction();
//		$mifistExampleAction->callMyActionAdditionalParameter( 'test1', 'test2', 'test3' );
    }
}