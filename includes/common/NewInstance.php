<?php
/**
 * Created by PhpStorm.
 * User: avant
 * Date: 07.02.17
 * Time: 20:44
 */

namespace includes\common;


trait NewInstance {
	public static function newInstance(){
		// TODO: Implement newInstance() method.
		$instance = new self;
		return $instance;
	}
}