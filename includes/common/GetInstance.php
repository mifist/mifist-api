<?php
/**
 * Created by PhpStorm.
 * User: avant
 * Date: 07.02.17
 * Time: 9:00
 */

namespace includes\common;


trait GetInstance {
	private static $instance = null;
	
	private function __construct() { /* ... @return Singleton */ }  // Защищаем от создания через new Singleton
	private function __clone() { /* ... @return Singleton */ }  // Защищаем от создания через клонирование
//	private function __wakeup() { /* ... @return Singleton */ }  // Защищаем от создания через unserialize
	
	public static function getInstance(){
		if ( null == static::$instance ) {
			static::$instance = new static;
		}
		return static::$instance;
	}
}