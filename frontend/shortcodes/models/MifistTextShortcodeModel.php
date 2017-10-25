<?php
namespace frontend\shortcodes\models;


use includes\common\MifistRequestApi;

use backend\menu\controllers\ICreatorInstance;

class MifistTextShortcodeModel implements ICreatorInstance {
	public static function newInstance() {
		// TODO: Implement newInstance() method.
		$instance = new self;
		return $instance;
	}
	
	public function __construct() {
		
	}
	
	/**
	 * Получения данных от кэша если данных нет в кэше запросить от сервера и записать в кэш
	 * @param $currency
	 * @param $origin
	 * @param $destination
	 * @param string $month
	 * @return array|bool
	 */
	public function getData(){
		$cacheKey = "";
		$data = array();
		$cacheKey = $this->getCacheKey();
		if ( false === ($data = get_transient($cacheKey))) {
			//error.log
			error_log("Проверка работы кеша. Будет срабатывать когда нет данных в кеше.");
			$reuestAPI = MifistRequestApi::getInstance();
			$data = $reuestAPI->getGitContent();
			set_transient($cacheKey, $data, 100);
		}
		
		return $data;
	}
	
	/**
	 * Создает ключ для кэша
	 */
	public function getCacheKey(){
		$code = "gitapi";
		return MIFISTAPI_PlUGIN_TEXTDOMAIN
			."_slick_slide_readme_{$code}";
		
	}
	
	
}