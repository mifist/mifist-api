

<!-- View форма для редактирования записи в таблицу. action формы это ссылка на страницу гостевой книги с $_GET['action']
параметр &action=update_data в методе render контроллера мы будем обрабатывать параметр $_GET['action']  update_data.
Эта форма похожая на форму MifistGuestBookSubMenuAdd.view.php только у ее полей ввода есть атрибут value со значением
записи в таблицы которую мы будем редактировать. И еще есть одно скрытое поле id по котором будем обновлять запись в таблице.
-->

<form action="admin.php?page=mifist_control_guest_book_menu&action=update_data" method="post">
	<!--<select name="user_category" id="user_category">
		<?php /*echo $data['user_category']; */?>
	</select>-->
	<input type="text" name="user_name" value="<?php echo $data['user_name']; ?>">
	<input type="number" name="age" value="<?php echo $data['age']; ?>">
	<input type="email" name="user_mail" value="<?php echo $data['user_mail']; ?>">
	<textarea name="message">
		<?php echo $data['message']; ?>
	</textarea>
	<!-- Поле id по котором будем обновлять запись в таблице -->
	<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
	
	<input type="submit" name="<?php _e('Add', MIFISTSLICK_PlUGIN_TEXTDOMAIN ); ?>">
</form>