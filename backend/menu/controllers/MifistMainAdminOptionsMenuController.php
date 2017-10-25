<?php
namespace backend\menu\controllers;
use includes\common\NewInstance;
use backend\menu\models\MifistMainAdminOptionsMenuModel;

class MifistMainAdminOptionsMenuController extends MifistBaseAdminMenuController {
	use NewInstance;
	public $model;
	public function __construct(){
		parent::__construct();
		$this->model = MifistMainAdminOptionsMenuModel::newInstance();
	}

    public function action()
    {
        // TODO: Implement action() method.
        $pluginPage = add_submenu_page(
	        MIFISTAPI_PlUGIN_TEXTDOMAIN,
            _x(
                'Slick Options',
                'backend menu page' ,
                MIFISTAPI_PlUGIN_TEXTDOMAIN
            ),
            _x(
                'Slick Options',
                'backend menu page' ,
                MIFISTAPI_PlUGIN_TEXTDOMAIN
            ),
            'manage_options',
            'mifist_control_options_menu',
            array(&$this, 'render'));
    }

    public function render() {
        // TODO: Implement render() method.
	    $pathView = MIFISTAPI_PlUGIN_DIR . '/backend/menu/templates/MifistMainAdminOptionsMenu.view.php';
	    $this->loadView($pathView);
    }
	
   
}