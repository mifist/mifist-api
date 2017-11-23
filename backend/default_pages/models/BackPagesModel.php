<?php
namespace  backend\default_pages\models;

use includes\common\NewInstance;
use backend\menu\controllers\ICreatorInstance;

class BackPagesModel implements ICreatorInstance {
	
	public static $default_pages = array();
	public static $posts_templates = array();
	public static $template = null;
	
	static public function getTemplates(){
		$default_pages = [
			'page_ajax' => [
				'post_title'    => __('Learn Ajax'),
				'post_content'  => '',
				'page_template' => 'templates/template-ajax.php'
			],
			'page_api' => [
				'post_title'    => __('Learn API'),
				'post_content'  => '',
				'page_template' => 'templates/template-api.php'
			],
			'guest_book' => [
				'post_title'    => __('Guest Book'),
				'post_content'  => '',
				'page_template' =>  'templates/template-guest_book.php'
			]
		];
		return $default_pages;
	}
	
    /**
     * Регистрировать опцию для кастомных страниц
     * Проверка на сущестоввание опции
     * Добавлять кастомные страницы
     */
	static public function createDefaultPage(){
		
		$create_default_page = get_option( MIFISTAPI_PlUGIN_OPTION_NAME.'_pages' );
		if ($create_default_page == true ){
			//error_log($create_default_page.' is true -- return false');
			return false;
		} else {
			//error_log($create_default_page.' is false -- return true');
			$templates = self::getTemplates();
			
			$curent_user_id = get_current_user_id();
			foreach ($templates as $key=>$default_page){
				$page_id =  wp_insert_post([
					'post_type'    => 'page',
					'post_title'    => $default_page['post_title'],
					'post_content'  => $default_page['post_content'],
					'post_status'   => 'publish',
					'post_author'   => $curent_user_id
				]);
				
				error_log($page_id.' insert');
				
				
				
				update_post_meta($page_id, '_wp_page_template', $default_page['page_template']);
				
				
				// SUB PAGES
				if (array_key_exists('sub_pages', $default_page) == true){
					foreach ($default_page['sub_pages'] as $sub_page){
						$sub_page_id =  wp_insert_post([
							'post_type'    => 'page',
							'post_title'    => $sub_page['post_title'],
							'post_content'  => $sub_page['post_content'],
							'post_status'   => 'publish',
							'post_author'   => $curent_user_id,
							'post_parent' => $page_id
						]);
						update_post_meta($sub_page_id, '_wp_page_template', $sub_page['page_template']);
					}
				}
				
			}
		}
		update_option( MIFISTAPI_PlUGIN_OPTION_NAME.'_pages', 1);
		
		return $templates;
		
	}
	
	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 */
	static public function registerPagesTemplates( ) {
		$templatess = self::getTemplates();
		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
		
		// Retrieve the cache list.
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}
		
		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');
		
		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $templates->default_page['page_template'] );
		
		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );
		
		return $templates;
		
	}
	
	/**
	 * Adds our template to the page dropdown for v4.7+
	 *
	 */
	static public function addNewTemplate(  ) {
		$templates = self::getTemplates();
		
		// TODO: Implement add_new_template() method.
		
			$posts_templates = array_merge( self::$posts_templates, $templates );
		
		return $posts_templates;
	}
	
	
	/**
	 * Checks if the template is assigned to the page
	 */
	static public function viewPagesTemplates( ) {
		
		$templates = self::getTemplates();
		
		foreach ($templates as $default_page){
			$page_title =  get_page_by_title($default_page['post_title']);
			// Return template if post is empty
			if ( ! $page_title ) {
				return $templates;
			}
			
			// Return default template if we don't have a custom one defined
			if ( ! isset($templates[get_post_meta(
					$page_title->ID, '_wp_page_template', true
				)] ) ) {
				return $templates;
			}
			
			$file = MIFISTAPI_PlUGIN_DIR . get_post_meta( $page_title->ID, '_wp_page_template', true );
			
			// Just to be safe, we check if the file exist first
			if ( file_exists( $file ) ) {
				return $file;
			} else {
				echo $file;
			}
		}
		
		
		// Return template
		return $templates;
		
	}
	static public function deleteDefaultPageOption() {
		$templates = self::getTemplates();
		foreach ($templates as $default_page){
			$page_title =  get_page_by_title($default_page['post_title']);
			error_log(print_r($page_title->ID.' deleted default options', true));
			wp_delete_post($page_title->ID, true);
			delete_post_meta($page_title->ID, '_wp_page_template', $default_page['page_template']);
		}
		delete_option( MIFISTAPI_PlUGIN_OPTION_NAME.'_pages');
	}
	use NewInstance;
}