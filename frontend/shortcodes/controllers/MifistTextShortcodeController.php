<?php
namespace frontend\shortcodes\controllers;


use backend\menu\controllers\ICreatorInstance;
use frontend\shortcodes\models\MifistTextShortcodeModel;
use frontend\shortcodes\MifistShortcodesController;

class MifistTextShortcodeController extends MifistShortcodesController
	implements ICreatorInstance {
	
	public $model;
	public function __construct() {
		parent::__construct();
		$this->model = MifistTextShortcodeModel::newInstance();
	}
	/**
	 * Функция в которой будем добалять шорткоды через функцию add_shortcode( $tag , $func );
	 * @return mixed
	 */
	public function initShortcode()
	{
		// TODO: Implement initShortcode() method.
		/*
		 * Добавляем щорткод [step_by_step_calendar_price_month]
		 */
		add_shortcode( 'mifist_text_shortcode', array(&$this, 'action'));
	}
	
	/**
	 * Функция обработки шоткода
	 * Функция указанная в параметре $func, получает 3 параметра, каждый из них может быть передан,
	 * а может нет:
	 * $atts(массив)
	 *      Ассоциативный массив атрибутов указанных в шоткоде. По умолчанию пустая строка - атрибуты
	 *      не переданы.
	 *      По умолчанию: ''
	 * $content(строка)
	 *      Текст шоткода, когда используется закрывающая конструкция шотркода: [foo]текст шорткода[/foo]
	 *      По умолчанию: ''
	 * $tag(строка)
	 *      Тег шорткода. Может пригодится для передачи в доп. функции. Пр: если шорткод - [foo],
	 *      то тег будет - foo.
	 *      По умолчанию: текущий тег
	 * @param array $atts
	 * @param string $content
	 * @param string $tag
	 * @return mixed
	 */
	public function action($atts = array(), $content = '', $tag = '')
	{
		// TODO: Implement action() method.
		/**
		 * Объединяет атрибуты (параметры) шоткода с известными атрибутами, остаются только известные
		 * атрибуты. Устанавливает значения атрибута по умолчанию, если он не указан.
		 */
		
		
		
		$data = $this->model->getData();
		if ($data == false) return false;
		return $this->render($data);
	}
	
	/**
	 * Функция отвечающа за вывод обработаной информации шорткодом
	 * @param $data
	 * @return mixed
	 */
	public function render($data)
	{
		
		// TODO: Implement render() method.
		//var_dump('<pre>', $data, '</pre>');
		echo '<p><code>' . base64_decode($data) . '</code></p>';
	}
	public static function newInstance() {
		// TODO: Implement newInstance() method.
		$instance = new self;
		return $instance;
	}
}