<?php
/**
 * Created by PhpStorm.
 * User: avant
 * Date: 08.02.17
 * Time: 15:06
 */

namespace includes\common;

class MifistLoaderScript {
	use GetInstance;

	private function __construct(){
		// Проверяем в админке мы или нет
		if ( is_admin() ) {
			add_action('admin_enqueue_scripts', array(&$this, 'loadScriptBack' ) );
			add_action('admin_head', array(&$this, 'loadHeadScriptBack'));
		} else {
			add_action( 'wp_enqueue_scripts', array(&$this, 'loadScriptFront' ) );
			add_action('wp_head', array(&$this, 'loadHeadScriptFront'));
			add_action( 'wp_footer', array(&$this, 'loadFooterScriptFront'));
		}
		
	}
	
	public function loadScriptBack($hook){
		// SCRIPT
		wp_register_script(
			MIFISTAPI_PlUGIN_SLUG.'-back-js', //$handle
			MIFISTAPI_PlUGIN_URL.'assets/backend/js/mapi-back.js', //$src
			array(
				'jquery'
			), //$deps
			MIFISTAPI_PlUGIN_VERSION, //$ver
			true //$in_footer
		);
		/**
		 * Добавляет скрипт, только если он еще не был добавлен и другие скрипты от которых он зависит зарегистрированы.
		 * Зависимые скрипты добавляются автоматически.
		 */
		
		
		
		// STYLE
		wp_register_style(
			MIFISTAPI_PlUGIN_SLUG.'-back', //$handle
			MIFISTAPI_PlUGIN_URL.'assets/backend/css/mapi-back.css', // $src
			array(), //$deps,
			MIFISTAPI_PlUGIN_VERSION // $ver
		//'all' // $media (all|screen|handheld|print)
		);
		
		
		wp_enqueue_style(MIFISTAPI_PlUGIN_SLUG.'-back');
		//wp_enqueue_script(MIFISTAPI_PlUGIN_SLUG.'-back-js');
	}
	
	
	public function loadHeadScriptBack(){ ?>
		
		<script type="text/javascript">
			var MIFIST_APIAjaxUrl;
			MIFIST_APIAjaxUrl  = '<?php echo MIFISTAPI_PlUGIN_AJAX_URL; ?>';
		</script>
	<?php
		// Enter script here
		
		
	}
	public function loadScriptFront($hook){
		// SCRIPT
		wp_register_script(
			MIFISTAPI_PlUGIN_SLUG.'-front-js', //$handle
			MIFISTAPI_PlUGIN_URL.'assets/frontend/js/mapi-front.js', //$src
			array(
				'jquery'
			), //$deps
			MIFISTAPI_PlUGIN_VERSION, //$ver
			true //$in_footer
		);
		wp_enqueue_script(MIFISTAPI_PlUGIN_SLUG.'-front-js');
		
		$ajaxsome = array( 'ajaxurl' => MIFISTAPI_PlUGIN_AJAX_URL);
		wp_localize_script(
			MIFISTAPI_PlUGIN_SLUG.'-front-js', //$handle,
			MIFISTAPI_PlUGIN_SLUG.'_ajax',
			$ajaxsome
		);
		
		// STYLE
		wp_register_style(
			MIFISTAPI_PlUGIN_SLUG.'-front', //$handle
			MIFISTAPI_PlUGIN_URL.'assets/frontend/css/mapi-front.css', // $src
			array(), //$deps,
			MIFISTAPI_PlUGIN_VERSION, // $ver
			'all' // $media (all|screen|handheld|print)
		);
		
		
		wp_enqueue_style(MIFISTAPI_PlUGIN_SLUG.'-front');
		
	}
	public function loadHeadScriptFront(){

		
	}
	public function loadFooterScriptFront(){

	
	}

}