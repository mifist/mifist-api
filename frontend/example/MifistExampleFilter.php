<?php

namespace frontend\example;

use includes\common\NewInstance;

class MifistExampleFilter {
	use NewInstance;
    public function __construct() {
        //Прикрепляем функцию к фильтру
//        add_filter('my_filter', array(&$this, 'myFiterFunction'));
 //       add_filter('my_filter', array(&$this, 'myFiterFunctionAdditionalParameter'), 10 , 3); // 3 - кол. параметров
	    add_filter( 'the_content', function($content) {
		    if ( has_shortcode($content, "hello-shortcode") )
		    {
			    $pluginPrefix = "mifist-";
			    wp_enqueue_script( "{$pluginPrefix}main-js", MIFISTSLICK_PlUGIN_URL . 'assets/js/slick.js' );
		    }
	    });
    }
   

    /**
     * Функция которую вызовет фильтер
     * @param $str
     * @return string
     */
    public function myFiterFunction( $str ){
        $str = "Hello {$str}";
        return $str;
    }
    /**
     * @param $name
     */
    public function callMyFilter( $name ){
        $name = apply_filters('my_filter', $name);
        //Выводим результат в debug.log
        error_log($name);
    }
    /**
     *  Функция которую вызовет фильтер
     * @param $str
     * @param $data1
     * @param $data2
     * @return string
     */
    public function myFiterFunctionAdditionalParameter( $str, $data1 = "", $data2 = "" ){
        $str = "Hello {$str} {$data1} {$data2}";
        return $str;
    }

    public function callMyFilterAdditionalParameter( $name, $data1, $data2 ){
        $name = apply_filters('my_filter', $name, $data1, $data2);
        //Выводим результат в debug.log
        error_log($name);
    }


}