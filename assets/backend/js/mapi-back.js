jQuery(function(i){i(document).ready(function(){}),i(document).find(".mifist-ajax-btn-add").click(function(n){var a,e,t,s,o;return a=i(this).parent().find(".mifist-user-name").val(),e=i(this).parent().find(".mifist-age").val(),t=i(this).parent().find(".mifist-user-mail").val(),s=i(this).parent().find(".mifist-message").val(),o={action:"guest_book",user_name:a,age:e,user_mail:t,message:s},console.log(o),i.post(mifist_slick_slider_plugin_ajax.ajaxurl,o,function(i){alert("Получено с сервера: "+i.data.message),console.log(i)}),!1})}),jQuery(function(i){i(document).ready(function(){})});