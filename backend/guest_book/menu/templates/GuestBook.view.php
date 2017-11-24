<!-- Ссылка ссылаеться на страницу гостевой книги только у нее добавлен $_GET['action'] параметр &action=add_data
    По этому параметру мы будем в методе render определять что делать
 -->
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-mg-12 col-lg-12">
			<a class="btn btn-add" href="admin.php?page=guest_book&action=add_data">
				<?php _e('New Guest', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
			</a>
		</div>
	</div>
</div>


<div class="admin-table guest-table">
	<div class="container table-header">
		<div class="row table-row">
			<div class="col-sm-2 col-mg-2 col-lg-2 table-col"> <?php _e('Name', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></div>
			<div class="col-sm-1 col-mg-1 col-lg-1 table-col"> <?php _e('Age', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></div>
			<div class="col-sm-2 col-mg-2 col-lg-2 table-col"> <?php _e('E-mail', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></div>
			<div class="col-sm-3 col-mg-3 col-lg-3 table-col"> <?php _e('Messsage', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></div>
			<div class="col-sm-2 col-mg-2 col-lg-2 table-col"> <?php _e('Date', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></div>
			<div class="col-sm-2 col-mg-2 col-lg-2 table-col"> <?php _e('Actions', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></div>
		</div>
	</div>
    <div class="container table-body">
    <!-- Проверка данных на пустоту чтобы цыкл не вернул ошибку -->
    <?php if(count($data) > 0 && $data !== false){  ?>
        <?php foreach($data as $value): ?>
            <div class="row table-row">
	           <!-- <td>
		            <?php /*echo $value['user_category']; */?>
	            </td>-->
                <div class="col-sm-2 col-mg-2 col-lg-2 table-col">
		            <?php echo $value['user_name']; ?>
	            </div>
	            <div class="col-sm-1 col-mg-1 col-lg-1 table-col">
		            <?php echo $value['age']; ?>
	            </div>
	            <div class="col-sm-2 col-mg-2 col-lg-2 table-col">
		            <?php echo $value['user_mail']; ?>
	            </div>
                <div class="col-sm-3 col-mg-3 col-lg-3 table-col">
                    <?php echo $value['message']; ?>
                </div>
	            <div class="col-sm-2 col-mg-2 col-lg-2 table-col">
                    <?php echo date('d-m-Y H:i', $value['date_add']); ?>
                </div>

                <div class="col-sm-2 col-mg-2 col-lg-2 table-col">
                    <!-- Ссылки  ссылаються на страницу гостевой книги только у них добавлен $_GET['action'] параметр
                     для редактирования &action=edit_data для удаления &action=delete_data и в этих ссылок еще добавлен
                     один $_GET['id'] параметр это &id=(id записи) записи гостевой книги по котором мы будем выполнять
                     действия -->
                    <a class="btn" href="admin.php?page=guest_book&action=edit_data&id=<?php echo $value['id'];?>">
                        <?php _e('Edit', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
                    </a>
                    <a class="btn" href="admin.php?page=guest_book&action=delete_data&id=<?php echo $value['id'];?>">
                        <?php _e('Delete', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
                    </a>


                </div>

            </div>
		   
        <?php endforeach ?>
    <?php }else{ ?>
	  
	    <div class="row">
		    <div class="col-sm-12 col-mg-12 col-lg-12">
			    <h3 class="guest-title empty">Guest book is empty!</h3>
			    <a class="btn btn-add" href="admin.php?page=guest_book&action=add_data">
				    <?php _e('New Guest', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>
			    </a>
		    </div>
		  
	    </div>
	   
	   
    <?php } ?>
    </div>
</div>