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
			add_action('admin_enqueue_scripts', array(&$this, 'loadScriptAdmin' ) );
			add_action('admin_head', array(&$this, 'loadHeadScriptAdmin'));
		} else {
			add_action( 'wp_enqueue_scripts', array(&$this, 'loadScriptSite' ) );
			add_action('wp_head', array(&$this, 'loadHeadScriptSite'));
			add_action( 'wp_footer', array(&$this, 'loadFooterScriptSite'));
		}
		
	}
	
	public function loadScriptAdmin($hook){
	
	}
	
	
	public function loadHeadScriptAdmin(){
		?>
		<script type="text/javascript">
			var MIFIST_APIAjaxUrl;
			MIFIST_APIAjaxUrl  = '<?php echo MIFISTAPI_PlUGIN_AJAX_URL; ?>';
		</script>
		<?php
	
	}
	public function loadScriptSite($hook){
	// SCRIPT
	
		
	}
	public function loadHeadScriptSite(){

		
	}
	public function loadFooterScriptSite(){

	
	}

}