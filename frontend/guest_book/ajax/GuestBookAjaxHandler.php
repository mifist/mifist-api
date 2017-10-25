<?php
namespace frontend\guest_book\ajax;

use backend\menu\controllers\ICreatorInstance;
use backend\guest_book\menu\models\GuestBookModel;

class GuestBookAjaxHandler implements ICreatorInstance {
    public function __construct(){
        if( defined('DOING_AJAX') && DOING_AJAX ){
            add_action('wp_ajax_guest_book', array( &$this, 'ajaxHandler'));
            add_action('wp_ajax_nopriv_guest_book',  array( &$this, 'ajaxHandler'));
        }

    }

    /**
     * Обработчик для ajax действия guest_book (wp_ajax_guest_book, wp_ajax_nopriv_guest_book)
     */
    public function ajaxHandler(){

        error_log('ajaxHandler');
        // Проверка наличия данных
        if ($_POST){
            //Добавляем данные
            $id = GuestBookModel::insert(array(
	            'user_name' => $_POST['user_name'],
	            'age' => $_POST['age'],
	            'user_mail' => $_POST['user_mail'],
                'date_add' => time(), // time() стандартная php функция получения времени
                'message' => $_POST['message']
            ));
            $return = array(
                'message'   => 'Сохранено',
                'ID'        => $id
            );
            // Возвращаем ответ
            wp_send_json_success( $return );
        }

        wp_send_json_error();
        wp_die();
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }
}