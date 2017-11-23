<?php
namespace  backend\options\models;

use includes\common\NewInstance;
use backend\menu\controllers\ICreatorInstance;

class BackOptionsModel implements ICreatorInstance {

    public function __construct(){
        add_action( 'admin_init', array( &$this, 'createOption' ) );
        //error_log(1);
    }

    /**
     * Регистрировать опции
     * Добавлять поля опции
     * Добавлять секции опции

     */
    public function createOption() {
        //error_log(2);
        // register_setting( $option_group, $option_name, $sanitize_callback );
        // Регистрирует новую опцию
        register_setting (
            'MainOptions',           // $option_group
	        MIFISTAPI_PlUGIN_OPTION_NAME, // $option_name
	        array(&$this, 'saveOption')     // $sanitize_callback
        );
        // add_settings_section( $id, $title, $callback, $page );
        // Добавление секции опций
        add_settings_section (
            'mifist_option_starter_id',                                          // $id
	        __('Стартовые настройки слайдера', MIFISTAPI_PlUGIN_TEXTDOMAIN),  // $title
	        '',                                                                 // $callback
	        'mifist_control_options'                                               // $page (id)
        );
        // add_settings_field( $id, $title, $callback, $page, $section, $args );
        // Добавление полей опций
        add_settings_field (
            'mifist_option_token_field_id',              // $id
            __('Token', MIFISTAPI_PlUGIN_TEXTDOMAIN), // $title
            array(&$this, 'tokenField'),                // $callback
            'mifist_control_options',                      // $page ->  add_settings_section
            'mifist_option_starter_id'                   // $section ->  add_settings_section
        );
        add_settings_field (
            'mifist_option_marker_field_id',              // $id
            __('Marker', MIFISTAPI_PlUGIN_TEXTDOMAIN), // $title
            array(&$this, 'markerField'),                // $callback
            'mifist_control_options',                       // $page ->  add_settings_section
            'mifist_option_starter_id'                    // $section ->  add_settings_section
        );
	    add_settings_field (
		    'mifist_option_check_field_id',              // $id
		    __('Check', MIFISTAPI_PlUGIN_TEXTDOMAIN), // $title
		    array(&$this, 'checkField'),                // $callback
		    'mifist_control_options',                       // $page ->  add_settings_section
		    'mifist_option_starter_id'                    // $section ->  add_settings_section
	    );

    }
	
    public function tokenField(){ // $callback -> add_settings_field
        $option = get_option(MIFISTAPI_PlUGIN_OPTION_NAME);
	    $val = $option['starter']['token'];
        ?>
            <input type="text"
                   name="<?php echo MIFISTAPI_PlUGIN_OPTION_NAME; ?>[starter][token]"
                   value="<?php echo esc_attr( $val ) ?>" />
        <?php
    }
	
    public function markerField(){ // $callback -> add_settings_field
        $option = get_option(MIFISTAPI_PlUGIN_OPTION_NAME);
	    //var_dump($option);
	    $val = $option['starter']['marker'];
        ?>
        <input type="text"
               name="<?php echo MIFISTAPI_PlUGIN_OPTION_NAME; ?>[starter][marker]"
               value="<?php echo esc_attr( $val ) ?>" />
        <?php
    }
	
	function checkField(){ // $callback -> add_settings_field
		$option = get_option(MIFISTAPI_PlUGIN_OPTION_NAME);
		$val = $option['starter']['checkbox'];
		?>
		<label>
			<input type="checkbox"
			       name="<?php echo MIFISTAPI_PlUGIN_OPTION_NAME; ?>[starter][checkbox]"
			       value="<?php echo esc_attr( $val ) ?>" <?php checked( 1, $val ) ?> />
			отметить
		</label>
		<?php
	}
	
	/**
     * Сохранение опции
     * @param $input
     */
    public function saveOption($input) { //  register_setting -> $sanitize_callback
        
	
	   
		    //error_log(3);
		    //error_log(print_r($input, true));
		    return $input;
		    
	    
    }

   use NewInstance;
}