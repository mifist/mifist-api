<?php
namespace backend\menu\controllers;
use includes\common\NewInstance;

class MifistMainAdminSubMenuController extends MifistBaseAdminMenuController
{

    public function action()
    {
        // TODO: Implement action() method.
        $pluginPage = add_submenu_page(
	        MIFISTAPI_PlUGIN_TEXTDOMAIN,
            _x(
                'Mifist Sub Page',
                'backend menu page' ,
                MIFISTAPI_PlUGIN_TEXTDOMAIN
            ),
            _x(
                'Mifist Sub Page',
                'backend menu page' ,
                MIFISTAPI_PlUGIN_TEXTDOMAIN
            ),
            'manage_options',
            'mifist_control_sub_menu',
            array(&$this, 'render'));
    }

    public function render()
    {
        // TODO: Implement render() method.
	    echo '<br /><h1 class="mif-backend-title">' . get_admin_page_title() . '</h1>';
	    echo '<br />
			<span class="backend-page--hello">'.
		    _x("Hello world :) This sub menu", MIFISTAPI_PlUGIN_TEXTDOMAIN)
		    .'</span>';
	    echo '<br />
			<span class="backend-page--welcome">'.
		    _x("Welcome!", MIFISTAPI_PlUGIN_TEXTDOMAIN)
		    .'</span>';
    }
	
    use NewInstance;
}