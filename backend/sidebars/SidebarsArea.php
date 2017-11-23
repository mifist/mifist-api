<?php

namespace  backend\sidebars;

use backend\menu\controllers\ICreatorInstance;

class SidebarsArea implements ICreatorInstance {
	public function __construct() {
		add_action( 'widgets_init',  array(&$this, 'pluginSidebarsArea') );
	}
	
	public function pluginSidebarsArea() {
		register_sidebar(array(
			'id' => 'sidebar-plugin',
			'name' => __( 'Sidebar for Plugin Api', MIFISTAPI_PlUGIN_SLUG ),
			'description' => __( 'Drag sidebars to this sidebar container.', MIFISTAPI_PlUGIN_SLUG ),
			'before_widget' => '<article id="%1$s" class="widget %2$s">',
			'after_widget' => '</article>',
			'before_title' => '<h6>',
			'after_title' => '</h6>',
		));
		
	}
	
	public static function newInstance()
	{
		// TODO: Implement newInstance() method.
		$instance = new self;
		return $instance;
	}
}