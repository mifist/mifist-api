<?php

namespace backend\menu\controllers;
use includes\common\NewInstance;

class MifistMyPagesMenuController extends BaseAdminMenuController
{
    public function action()
    {
        // TODO: Implement action() method.

        $pluginPage = add_pages_page(
            __('Sub pages Mifist', MIFISTAPI_PlUGIN_TEXTDOMAIN),
            __('Sub pages Mifist', MIFISTAPI_PlUGIN_TEXTDOMAIN),
            'read',
            'step_by_step_control_sub_pages_menu',
            array(&$this, 'render')
        );
    }

    public function render()
    {
        // TODO: Implement render() method.
	    echo '<br /><h1 class="mif-backend-title">' . get_admin_page_title() . '</h1>';
	    echo '<br />
			<span class="backend-page--hello">'.
		    _x("Hello world :) This page Pages", MIFISTAPI_PlUGIN_TEXTDOMAIN)
		    .'</span>';
	    echo '<br />
			<span class="backend-page--welcome">'.
		    _x("Welcome!", MIFISTAPI_PlUGIN_TEXTDOMAIN)
		    .'</span>';
    }

    use NewInstance;
}