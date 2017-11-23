<?php
namespace backend\options\controllers;
use includes\common\NewInstance;
use backend\options\models\BackOptionsModel;
use backend\menu\controllers\BaseAdminMenuController;

class BackOptionsController extends BaseAdminMenuController {
	use NewInstance;
	public $model;
	public function __construct(){
		parent::__construct();
		$this->model = BackOptionsModel::newInstance();
	}

    public function action()
    {
        // TODO: Implement action() method.
        $pluginPage = add_submenu_page(
	        MIFISTAPI_PlUGIN_TEXTDOMAIN,
            _x(
                'Plugin Options',
                'backend menu page' ,
                MIFISTAPI_PlUGIN_TEXTDOMAIN
            ),
            _x(
                'Plugin Options',
                'backend menu page' ,
                MIFISTAPI_PlUGIN_TEXTDOMAIN
            ),
            'manage_options',
            'mifist_control_options',
            array(&$this, 'render'));
    }

    public function render() {
        // TODO: Implement render() method.
	    $pathView = MIFISTAPI_PlUGIN_DIR . '/backend/options/templates/BackOptions.view.php';
	    $this->loadView($pathView);
    }
	
   
}