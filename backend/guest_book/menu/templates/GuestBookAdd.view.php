
<!-- View форма для добавления записи в таблицу. action формы это ссылка на страницу гостевой книги с $_GET['action']
параметр &action=insert_data в методе render контроллера мы будем обрабатывать параметр $_GET['action'] -->
<form action="admin.php?page=guest_book&action=insert_data" method="post">
	<!--<select name="user_category" id="user_category"></select>-->
	<input type="text" name="user_name">
	<input type="number" name="age">
	<input type="email" name="user_mail">
	<textarea name="message"></textarea>
	<input type="submit" name="<?php _e('Add', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>">
</form>