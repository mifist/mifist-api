<?php
namespace frontend\shortcodes;


abstract class MifistShortcodesController {
    public function __construct(){
        add_action( 'wp_loaded',  array( &$this, 'initShortcode') );
    }

    /**
     * Функция в которой будем добалять шорткоды через функцию add_shortcode( $tag , $func );
     * @return mixed
     */
    abstract public function initShortcode();

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
    abstract public function action($atts = array(), $content = '', $tag = '');

    /**
     * Функция отвечающа за вывод обработаной информации шорткодом
     * @param $data
     * @return mixed
     */
    abstract public function render($data);
    
	/**
	 * Метод подключения view
	 * @param $view
	 * @param int $type
	 * @param array $data
	 */
	protected function loadView($view, $type = 0, $data = array()){
		if (file_exists($view)) {
			switch($type){
				case 0:
					require_once $view;
					break;
				case 1:
					require $view;
					break;
				default:
					require_once $view;
					break;
			}
		} else {
			wp_die(sprintf(__('(View %s not found)', MIFISTAPI_PlUGIN_TEXTDOMAIN), $view));
		}
	}
}