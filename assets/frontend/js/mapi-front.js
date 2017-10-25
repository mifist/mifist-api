;/**
 * Created by avant on 08.02.17.
 */
jQuery(function($) {
	$(document).ready(function(){
		
	});
	// Отслежываем нажатие  на кнопку Add (<button class="guest-book-ajax-btn-add" >'.__('Add', MIFISTSLICK_PlUGIN_TEXTDOMAIN ).'</button> )
	$(document).find('.guest-book-ajax-btn-add').click(function (e) {
		var userName, userAge, userMail, userMessage, data;
		// Получаем данные формы
		userName = $(this).parent().find('.mifist-user-name').val();
		userAge = $(this).parent().find('.mifist-age').val();
		userMail = $(this).parent().find('.mifist-user-mail').val();
		userMessage = $(this).parent().find('.mifist-message').val();
		// Формируем обьект данных который получит AJAX  обработчик
		data = {
			action: 'guest_book',
			user_name: userName,
			age: userAge,
			user_mail: userMail,
			message: userMessage
		}
		// Вывод данных в консоль браузера
		console.log(data);
		//console.log(ajaxurl+ '?action=guest_book');
		
		// Отправка данных ajax обработчику (wp_ajax_guest_book, wp_ajax_nopriv_guest_book)
		$.post( mifist_guest_book_plugin_ajax.ajaxurl, data, function(response) {
			alert('Получено с сервера: ' + response.data.message);
			console.log(response);
		});
		
		// Запрещаем отправление формы что бы страница не перезагружалась
		return false;
	});
});
