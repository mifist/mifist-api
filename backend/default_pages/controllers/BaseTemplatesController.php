<?php // Рассказазываем WordPress о новых страницах.
// Для этого нужно создать функцию, которую следует привязать к действию 'admin_menu'.
namespace backend\default_pages\controllers;

use backend\menu\controllers\ICreatorInstance;

abstract class BaseTemplatesController implements ICreatorInstance {
    public function __construct(){
	    $this->templates = array();
	    // Add a filter to the attributes metabox to inject template into the cache.
	    if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
		    // 4.6 and older
		    add_filter( 'page_attributes_dropdown_pages_args', array( &$this, 'register_project_templates' ) );
		
	    } else {
		    // Add a filter to the wp 4.7 version attributes metabox
		    add_filter( 'theme_page_templates', array( &$this, 'add_new_template' ) );
	    }
	
	    // Add a filter to the save post to inject out template into the page cache
	    add_filter( 'wp_insert_post_data', array( &$this, 'register_project_templates' ) );
	
	    // Add a filter to the template include to determine if the page has our
	    // template assigned and return it's path
	    add_filter( 'template_include', array( &$this, 'view_project_template') );
	
	   
    }
    
	abstract public function  add_new_template( $posts_templates );
    abstract public function register_project_templates( $atts );
    abstract public function view_project_template( $template );
	
}