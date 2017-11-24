

<!-- View форма для редактирования записи в таблицу. action формы это ссылка на страницу гостевой книги с $_GET['action']
параметр &action=update_data в методе render контроллера мы будем обрабатывать параметр $_GET['action']  update_data.
Эта форма похожая на форму MifistGuestBookSubMenuAdd.view.php только у ее полей ввода есть атрибут value со значением
записи в таблицы которую мы будем редактировать. И еще есть одно скрытое поле id по котором будем обновлять запись в таблице.
-->
<div class="edit-table guest-table">
	<div class="container table-header">
		<div class="row">
			<h2>Edit Guest Information</h2>
		</div>
		<div class="row table-row">
			<div class="col-sm-3 col-mg-3 col-lg-3 table-col">
				<label for="edit-name"><?php _e('Name', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></label>
			</div>
			<div class="col-sm-3 col-mg-3 col-lg-3 table-col">
				<label for="edit-age"><?php _e('Age', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></label>
			</div>
			<div class="col-sm-3 col-mg-3 col-lg-3 table-col">
				<label for="edit-email"><?php _e('E-mail', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></label>
			</div>
			<div class="col-sm-3 col-mg-3 col-lg-3 table-col">
				<label for="edit-mess"><?php _e('Messsage', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></label>
			</div>
		</div>
	</div>
	<div class="container table-body">
		
		<form class="row table-row" action="admin.php?page=guest_book&action=update_data" method="post">
			<div class="col-sm-12 col-mg-3 col-lg-3 table-form">
				<input id="edit-name" type="text" name="user_name" value="<?php echo $data['user_name']; ?>">
			</div>
			<div class="col-sm-12 col-mg-3 col-lg-3 table-form">
				<input id="edit-age" type="number" name="age" value="<?php echo $data['age']; ?>">
			</div>
			<div class="col-sm-12 col-mg-3 col-lg-3 table-form">
				<input id="edit-email" type="email" name="user_mail" value="<?php echo $data['user_mail']; ?>">
			</div>
			<div class="col-sm-12 col-mg-3 col-lg-3 table-form">
				<textarea id="edit-mess" rows="4" name="message">
					<?php echo $data['message']; ?>
				</textarea>
			</div>
			<div class="col-sm-12 col-mg-12 col-lg-12">
				<!-- Поле id по котором будем обновлять запись в таблице -->
				<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
				<input class="btn" type="submit" name="<?php _e('Save', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>">
			</div>
		</form>
	
	</div>
</div>
