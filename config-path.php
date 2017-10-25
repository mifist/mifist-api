<?php //Определение путей
// определение глобальных констант
// определяем путь к папке плагина внутри директории WordPress
define("MIFISTAPI_PlUGIN_DIR", plugin_dir_path(__FILE__));
define("MIFISTAPI_PlUGIN_URL", plugin_dir_url( __FILE__ ));
define("MIFISTAPI_PlUGIN_SLUG", preg_replace( '/[^\da-zA-Z]/i', '_',  basename(MIFISTAPI_PlUGIN_DIR)));
define("MIFISTAPI_PlUGIN_TEXTDOMAIN", str_replace( '_', '-', MIFISTAPI_PlUGIN_SLUG ));
define("MIFISTAPI_PlUGIN_OPTION_VERSION", MIFISTAPI_PlUGIN_SLUG.'_version');
define("MIFISTAPI_PlUGIN_OPTION_NAME", MIFISTAPI_PlUGIN_SLUG.'_options');
define("MIFISTAPI_PlUGIN_AJAX_URL", admin_url('backend-ajax.php'));

// Проверим зарегистрирована ли функция get_plugins(). Это нужно для фронт-энда
// обычно get_plugins() работает только в админ-панели.
if ( ! function_exists( 'get_plugins' ) ) {
	// подключим файл с функцией get_plugins()
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

// получаем данные плагина
$plugin_data = get_plugin_data(MIFISTAPI_PlUGIN_DIR.'/'.basename(MIFISTAPI_PlUGIN_DIR).'.php', false, false);

define("MIFISTAPI_PlUGIN_VERSION", $plugin_data['Version']);
define("MIFISTAPI_PlUGIN_NAME", $plugin_data['Name']);
// путь к файлам переводам
define("MIFISTAPI_PlUGIN_DIR_LOCALIZATION", plugin_basename(MIFISTAPI_PlUGIN_DIR.'/lang/'));