
<!-- View форма для добавления записи в таблицу. action формы это ссылка на страницу гостевой книги с $_GET['action']
параметр &action=insert_data в методе render контроллера мы будем обрабатывать параметр $_GET['action'] -->


<div class="add-table guest-table">
	<div class="container table-header">
		<div class="row">
			<h2>Add New Guest</h2>
		</div>
		<div class="row table-row">
			<div class="col-sm-3 col-mg-3 col-lg-3 table-col">
				<label for="add-name"><?php _e('Name', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></label>
			</div>
			<div class="col-sm-3 col-mg-3 col-lg-3 table-col">
				<label for="add-age"><?php _e('Age', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></label>
			</div>
			<div class="col-sm-3 col-mg-3 col-lg-3 table-col">
				<label for="add-email"><?php _e('E-mail', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></label>
			</div>
			<div class="col-sm-3 col-mg-3 col-lg-3 table-col">
				<label for="add-mess"><?php _e('Messsage', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?></label>
			</div>
		</div>
	</div>
	<div class="container table-body">

		<form class="row table-row" action="admin.php?page=guest_book&action=insert_data" method="post">
			<div class="col-sm-12 col-mg-3 col-lg-3 table-form">
				<input id="add-name" type="text" name="user_name">
			</div>
			<div class="col-sm-12 col-mg-3 col-lg-3 table-form">
				<input id="add-age" type="number" name="age">
			</div>
			<div class="col-sm-12 col-mg-3 col-lg-3 table-form">
				<input id="add-email" type="email" name="user_mail">
			</div>
			<div class="col-sm-12 col-mg-3 col-lg-3 table-form">
				<textarea id="add-mess" rows="4" name="message"></textarea>
			</div>
			<div class="col-sm-12 col-mg-12 col-lg-12">
				<input class="btn" type="submit" name="<?php _e('Add', MIFISTAPI_PlUGIN_TEXTDOMAIN ); ?>">
			</div>
		</form>
		
	</div>
</div>

	
