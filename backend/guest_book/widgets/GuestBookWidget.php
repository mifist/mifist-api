<?php
namespace  backend\guest_book\widgets;

use  backend\guest_book\menu\models\GuestBookModel;

class GuestBookWidget extends \WP_Widget
{
    public function __construct() {

        /**
         * https://developer.wordpress.org/reference/classes/wp_widget/__construct/
         * WP_Widget::__construct(
         *      string $id_base, //Base ID для виджета, в нижнем регистре и уникальным. Если оставить пустым,
         *                          то часть имени класса виджета будет использоваться Должно быть уникальным.
         *      string $name, //Имя виджета отображается на странице конфигурации.
         *      array $widget_options = array(),
         *      array $control_options = array()
         * )
         *
         */

        parent::__construct(
            "mifist_guest_book",
            "Guest Book Widget",
            array("description" => "Guest book")
        );
    }

    /**
     * Метод form() используется для отображения настроек виджета на странице виджетов.
     * @param $instance
     */
    public function form($instance) {
        $title = "";
        $text = "";
        // если instance не пустой, достанем значения
        if (!empty($instance)) {
            $title = $instance["title"];
            $text = $instance["text"];
        }

        $tableId = $this->get_field_id("title");
        $tableName = $this->get_field_name("title");
        echo '<label class="form-gb-label" for="' . $tableId . '">Title</label>';
        echo '<input class="form-gb-input" id="' . $tableId . '" type="text" name="' .
            $tableName . '" value="' . $title . '">';

        $textId = $this->get_field_id("text");
        $textName = $this->get_field_name("text");
        echo '<label class="form-gb-label" for="' . $textId . '">Description</label>';
        echo '<textarea rows="5" class="form-gb-input" id="' . $textId . '" name="' . $textName .
            '">' . $text . '</textarea>';
    }

    /**
     * @param $newInstance
     * @param $oldInstance
     * @return array
     */

    public function update($newInstance, $oldInstance) {
        $values = array();
        $values["title"] = htmlentities($newInstance["title"]);
        $values["text"] = htmlentities($newInstance["text"]);
        return $values;
    }

    /**
     * @param $args
     * @param $instance
     */
    public function widget($args, $instance) {
        $title = $instance["title"];
        $text = $instance["text"];

        echo "<h2>$title</h2>";
        echo "<p>$text</p>";

        // Вывод таблички гостевой книги
        $data = GuestBookModel::getAll();
        ?>
	    <table class="shortcode-table " border="1">
		    <thead>
		    <tr>
			    <!-- <td>
		    <?php /*_e('Category', MIFISTAPI_PlUGIN_TEXTDOMAIN ); */?>
	    </td>-->
			    <td>
				    <?php _e('Name', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
			    </td>
			    <td>
				    <?php _e('Age', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
			    </td>
			    <td>
				    <?php _e('E-mail', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
			    </td>
			    <td>
				    <?php _e('Messsage', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
			    </td>
			    <td>
				    <?php _e('Date', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
			    </td>
			    
		    </tr>
		    </thead>
		    <tbody>
        <?php if(count($data) > 0 && $data !== false){  ?>
            <?php foreach($data as $value): ?>
		        <tr class="table_box">
		        <!-- <td>
		            <?php /*echo $value['user_category']; */?>
	            </td>-->
		        <td>
			        <?php echo $value['user_name']; ?>
		        </td>
		        <td>
			        <?php echo $value['age']; ?>
		        </td>
		        <td>
			        <?php echo $value['user_mail']; ?>
		        </td>
		        <td>
			        <?php echo $value['message']; ?>
		        </td>
		        <td>
			        <?php echo date('d-m-Y H:i', $value['date_add']); ?>
		        </td>
			        
		        </tr>
            <?php endforeach ?>
        <?php }else{ ?>
	        <tr>
		        <!--            <td></td>-->
		        <td></td>
		        <td></td>
		        <td></td>
		        <td></td>
		        <td></td>
	        </tr>
        <?php } ?>
        </tbody>
        </table>
        <?php

    }


}