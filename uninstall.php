<?php
//use includes\models\backend\menu\MifistGuestBookSubMenuModel;
// Если к файлу обращаются напрямую, закроем доступ
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ){
	exit();
} else {
	// debug.log
	error_log('Guest Book table of plugin '.MIFISTAPI_PlUGIN_NAME.' has been removed');
	//Удаление таблицы Гостевой книги
	//MifistGuestBookSubMenuModel::deleteTable();
}
/*$option_name = 'plugin_option_name';

// Для обычного сайта.
if ( !is_multisite() ) {
	delete_option( $option_name );
}*/

