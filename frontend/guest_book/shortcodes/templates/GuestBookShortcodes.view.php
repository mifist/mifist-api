<!-- Ссылка ссылаеться на страницу гостевой книги только у нее добавлен $_GET['action'] параметр &action=add_data
    По этому параметру мы будем в методе render определять что делать
 -->
<a href="<?php echo wp_get_shortlink() . '&action=add_data'; ?>">
    <?php _e('Add',MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
</a>

<table class="shortcode-table " border="1">
    <thead>
    <tr>
	   <!-- <td>
		    <?php /*_e('Category',MIFISTAPI_PlUGIN_TEXTDOMAIN ); */?>
	    </td>-->
        <td>
            <?php _e('Name',MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
        </td>
	    <td>
		    <?php _e('Age',MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
	    </td>
	    <td>
		    <?php _e('E-mail',MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
	    </td>
        <td>
            <?php _e('Messsage',MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
        </td>
        <td>
            <?php _e('Date',MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
        </td>
        <td>
            <?php _e('Actions',MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
        </td>
    </tr>
    </thead>
    <tbody>
    <!-- Проверка данных на пустоту чтобы цыкл не вернул ошибку -->
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

                <td>
                    <!-- Ссылки  ссылаються на страницу гостевой книги только у них добавлен $_GET['action'] параметр
                     для редактирования &action=edit_data для удаления &action=delete_data и в этих ссылок еще добавлен
                     один $_GET['id'] параметр это &id=(id записи) записи гостевой книги по котором мы будем выполнять
                     действия -->
                    <a href="<?php echo wp_get_shortlink() . '&action=edit_data&id=' . $value['id'];?>">
                        <?php _e('Edit',MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
                    </a>
                    <a href="<?php  echo wp_get_shortlink() . '&action=delete_data&id=' .  $value['id'];?>">
                        <?php _e('Delete',MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
                    </a>


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