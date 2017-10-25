<?php

/*
Plugin Name: Mifist API
Plugin URI:  http://www.daria-moskalets.in.ua/learn-api/
Description: Free Learn APIr plugin for WordPress.
Version: 1.0
Author: Moskalets Daria
Author URI: http://www.daria-moskalets.in.ua/
Text Domain: mapi
Domain Path: /lang/
License: A "Slug" license name e.g. GPL2
    Copyright 2017  Moskalets Daria  (email: daria1992moskalets@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
// подключение основных файлов плагина
require_once plugin_dir_path(__FILE__) . '/config-path.php';
require_once MIFISTAPI_PlUGIN_DIR . '/includes/common/MifistAutoload.php';
require_once MIFISTAPI_PlUGIN_DIR . '/includes/MifistApiPlugin.php';


//Регистрация виджета
add_action('widgets_init', create_function('', 'return register_widget("backend\widgets\MifistGuestBookWidget");'));

// вызов функций активации и деактивации плагина
register_activation_hook( __FILE__, array('includes\MifistApiPlugin' ,  'activation' ) );
register_deactivation_hook( __FILE__, array('includes\MifistApiPlugin' ,  'deactivation' ) );


