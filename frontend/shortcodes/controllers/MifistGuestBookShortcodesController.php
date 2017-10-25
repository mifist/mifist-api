<?php
namespace frontend\shortcodes\controllers;

// Наследуем базовый класс MifistShortcodesController в котором реализованый некоторый функционал для создания
// шорткода
use frontend\shortcodes\MifistShortcodesController;
use backend\menu\controllers\MifistICreatorInstance;
use  backend\menu\models\MifistGuestBookSubMenuModel;

class MifistGuestBookShortcodesController extends MifistShortcodesController
    implements MifistICreatorInstance {

    /**
     * Функция в которой будем добалять шорткоды через функцию add_shortcode( $tag , $func );
     * @return mixed
     */
    public function initShortcode()
    {
        // TODO: Implement initShortcode() method.
        /*
         * Добавляем щорткод [mifist_show_guest_book]
         * этот шорткод будет добалять форму для добавления данных в гостевую книгу
         */
        add_shortcode( 'mifist_show_guest_book', array(&$this, 'action'));
    }

    /**
     * Функция обработки шоткода
     * Функция указанная в параметре $func, получает 3 параметра, каждый из них может быть передан,
     * а может нет:
     * $atts(массив)
     *      Ассоциативный массив атрибутов указанных в шоткоде. По умолчанию пустая строка - атрибуты
     *      не переданы.
     *      По умолчанию: ''
     * $content(строка)
     *      Текст шоткода, когда используется закрывающая конструкция шотркода: [foo]текст шорткода[/foo]
     *      По умолчанию: ''
     * $tag(строка)
     *      Тег шорткода. Может пригодится для передачи в доп. функции. Пр: если шорткод - [foo],
     *      то тег будет - foo.
     *      По умолчанию: текущий тег
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return mixed
     */
    public function action($atts = array(), $content = '', $tag = '')
    {
        // TODO: Implement action() method.
        return $this->render(array());
    }

    /**
     * Функция отвечающа за вывод обработаной информации шорткодом
     * @param $data
     * @return mixed
     */
    public function render($data)
    {
	    // TODO: Implement render() method.
	    /*
		В Гостевой книги может быть несколько view (Отображение данных таблицы,
		Добавление данных в таблице, Редактирование данных в таблице,
		Удаление данных с таблицы). Что бы определить контролеру какое действие в данный
		момент обрабатывать к ссылке будет добляться $_GET['action']. Мы его можем получить
		и определить какой view подшружать странице.
		*/
	    $action = isset($_GET['action']) ? $_GET['action'] : null ;
	    //Данные которые будут передаваться в view
	    $data = array();
	    $pathView =MIFISTAPI_PlUGIN_DIR;
	    /*
		 * Используем switch чтобы определить какой сейчас  $_GET['action']
		 */
	    switch($action) {
		    // Подгружаем view для добавление данных в таблицу
		    // backend.php?page=mifist_control_guest_book_menu&action=add_data
		    case "add_data":
			    $pathView .= "/frontend/shortcodes/templates/MifistGuestBookShortcodesAdd.view.php";
			    $this->loadView($pathView, 0, $data);
			    break;
		    // Сохранение данных в таблицу
		    // backend.php?page=mifist_control_guest_book_menu&action=insert_data
		    case "insert_data":
			    /*
				 * Проверяем наличие данных от формы MifistGuestBookShortcodesAdd.view.php
				 */
			    if (isset($_POST)){
				    /*
					 * Передаем массив данных в метод insert модели.
					 * Массив ассоциативный ключ это название поля в таблице в которую мы будем вставлять,
					 * значение это значение которое будет вставлено определеному полю
					 *
					 */
				    $id = MifistGuestBookSubMenuModel::insert(array(
					    /*'user_category' =>  $_POST['user_category'],*/
					    'user_name' => $_POST['user_name'],
					    'age' => $_POST['age'],
					    'user_mail' => $_POST['user_mail'],
					    'date_add' => time(), // time() стандартная php функция получения времени
					    'message' => $_POST['message']
				    ));
				
				    /*
					 * После вставки возвращаемся на основную страницу гостевой книги
					 * backend.php?page=mifist_control_guest_book_menu
					 */
				    $this->redirect(wp_get_shortlink() );
			    }
			
			
			    break;
		    // Подгружаем view для редактирование данных в таблицу
		    // backend.php?page=mifist_control_guest_book_menu&action=edit_data&id=ID записи
		    case "edit_data":
			    /*
				 * Чтобы получить из таблицы запись которую редактировать мы используем $_GET['id'] параметр
				 * Проверяем его наличие и на пустоту
				*/
			    if(isset($_GET['id']) && !empty($_GET['id'])){
				    // Получаем данные записи в таблице по id затем эти данные передадим в view MifistGuestBookSubMenuEdit.view
				    $data = MifistGuestBookSubMenuModel::getById((int)$_GET['id']);
				    $pathView .= "/frontend/shortcodes/templates/MifistGuestBookShortcodesEdit.view.php";
				    $this->loadView($pathView, 0, $data);
			    }
			
			    break;
		    // Обновление редактированых данных в таблице
		    // backend.php?page=mifist_control_guest_book_menu&action=update_data
		    case "update_data":
			    // Проверяем наличие $_POST данных от формы редактирования  MifistGuestBookShortcodesEdit.view.php
			    //var_dump($_POST);
			    if (isset($_POST)){
				    // Если данные есть то обновляем их в базе данных по ID
				    MifistGuestBookSubMenuModel::updateById(
					    array(
						    /*'user_category' =>  $_POST['user_category'],*/
						    'user_name' => $_POST['user_name'],
						    'age' => $_POST['age'],
						    'user_mail' => $_POST['user_mail'],
						    'date_add' => time(), // time() стандартная php функция получения времени
						    'message' => $_POST['message']
					    ), $_POST['id']
				    );
				    $this->redirect( wp_get_shortlink() );
			    }
			    break;
		    // Удаление данных
		    // backend.php?page=mifist_control_guest_book_menu&action=delete_data&id=ID записи
		    case "delete_data":
			    // Чтобы удалить определеную запись в таблице мы используем $_GET['id'] параметр
			    // Проверяем его наличие и на пустоту
			    if(isset($_GET['id']) && !empty($_GET['id'])){
				    MifistGuestBookSubMenuModel::deleteById((int)$_GET['id']);
			    }
			   // $redirlink = echo wp_get_shortlink();
			    $this->redirect( wp_get_shortlink() );
			    break;
		    // Основная страница Гостевой книги
		    // backend.php?page=mifist_control_guest_book_menu
		    default:
			    //Получение всех записей в таблице чтобы отобразить их view
			
			    $data = MifistGuestBookSubMenuModel::getAll();
			    $pathView .= "/frontend/shortcodes/templates/MifistGuestBookShortcodes.view.php";
			    $this->loadView($pathView, 0, $data);
	    }
	    
	    
	  
    }
	/**
	 * Метод перенаправления на нужную страницу
	 * @param string $page
	 */
	public function redirect($page = ''){
		echo '<script type="text/javascript">
                  document.location.href="'.$page.'";
           </script>';
	}

    // Метод создает экземпляр класса
    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }
}