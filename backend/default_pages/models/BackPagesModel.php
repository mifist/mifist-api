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
				'page_template' => 'template-ajax.php'
			],
			'page_api' => [
				'post_title'    => __('Learn API'),
				'post_content'  => '',
				'page_template' => 'template-api.php'
			],
			'guest_book' => [
				'post_title'    => __('Guest Book'),
				'post_content'  => '',
				'page_template' =>  'template-guest_book.php'
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
				
				//error_log($page_id.' insert');
				
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
	
	
	static public function deleteDefaultPageOption() {
		$templates = self::getTemplates();
		foreach ($templates as $default_page){
			$page_title =  get_page_by_title($default_page['post_title']);
			//error_log(print_r($page_title->ID.' deleted default pages', true));
			wp_delete_post($page_title->ID, true);
			delete_post_meta($page_title->ID, '_wp_page_template', $default_page['page_template']);
			
			// SUB PAGES
			if (array_key_exists('sub_pages', $default_page) == true){
				foreach ($default_page['sub_pages'] as $sub_page){
					$page_title_sub =  get_page_by_title($sub_page['post_title']);
					//error_log(print_r($page_title_sub->ID.' deleted default sub pages', true));
					wp_delete_post($page_title_sub->ID, true);
					delete_post_meta($page_title_sub->ID, '_wp_page_template', $page_title_sub['page_template']);
				}
			}
		}
		delete_option( MIFISTAPI_PlUGIN_OPTION_NAME.'_pages');
	}
	use NewInstance;
}