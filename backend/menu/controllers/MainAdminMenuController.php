<?php
namespace backend\menu\controllers;
use includes\common\NewInstance;

class MainAdminMenuController extends BaseAdminMenuController {

    public function action()
    {
        // TODO: Implement action() method.
        /**
         * add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
         *
         */
        $pluginPage = add_menu_page(
            _x(
                'Mifist Plugin',
                'backend menu page' ,
                MIFISTAPI_PlUGIN_TEXTDOMAIN
            ),
            _x(
                'Mifist Plugin',
                'backend menu page' ,
                MIFISTAPI_PlUGIN_TEXTDOMAIN
            ),
            'manage_options',
	        MIFISTAPI_PlUGIN_TEXTDOMAIN,
	         array(&$this,'render'),
            MIFISTAPI_PlUGIN_URL .'assets/backend/images/api.png',
	        10 // $position перед Медиа
        );
    }

    /**
     * Метод отвечающий за контент страницы
     */
    public function render() {
    	// TODO: Implement render() method.
	    $pathView = MIFISTAPI_PlUGIN_DIR . '/backend/menu/templates/MainAdminMenu.view.php';
	    $this->loadView($pathView);
	}

   use NewInstance;
}