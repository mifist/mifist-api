<?php // Рассказазываем WordPress о новых страницах.
// Для этого нужно создать функцию, которую следует привязать к действию 'admin_menu'.
namespace backend\default_pages\controllers;

use backend\menu\controllers\ICreatorInstance;

abstract class BasePagesController implements ICreatorInstance {
    public function __construct(){
        /*
         * Регистрирует хук-событие. При регистрации указывается PHP функция,
         * которая сработает в момент события, которое вызывается с помощью do_action().
         */
        add_action('plugins_loaded', array( &$this, 'action'));
	    
        
    }

    abstract public function action();
	
    abstract public function render();
	/**
	 * Метод подключения view
	 * @param $view
	 * @param int $type
	 * @param array $data
	 */
	protected function loadView($view, $type = 0, $data = array()){
		if (file_exists($view)) {
			switch($type){
				case 0:
					require_once $view;
					break;
				case 1:
					require $view;
					break;
				default:
					require_once $view;
					break;
			}
		} else {
			wp_die(sprintf(__('(View %s not found)',MIFISTAPI_PlUGIN_TEXTDOMAIN), $view));
		}
	}
}