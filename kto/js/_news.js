// JavaScript Document
// Author: mccrush.ru

$(document).ready(function(e) {

	// При клике по иконке статуса сообщения
	$('.editStat').click(function(){
		id = $(this).attr('name');
		//alert("id = "+id);
		//alert("Статус: "+ $(this).attr('alt'));
		if($(this).attr('alt') == "1") {
			$.post(                              
				"php/post_stat1.php",
				{statid:id},
				// Если ответ сервера положительный, работаем дальше	
				function onAjaxSuccess1(datar){   
					if (datar == 1) {
						location.reload();
						//$(this).attr('src','img/no.png');
					} else {
						alert(datar);
					}
				}
			);
		} else {
			$.post(                              
				"php/post_stat0.php",
				{statid:id},
				// Если ответ сервера положительный, работаем дальше	
				function onAjaxSuccess0(datar){   
					if (datar == 0) {
						//alert("Все пучком!");
						location.reload();
						//$(this).attr('src','img/yes.png');
					} else {
					alert("Твою дивизию. У нас ошибка!");
					}
				}
			);
		}						
	});

	// При клике по иконке удаленияя сообщения 
	$('.dropMess').click(function(){
		idMess = $(this).attr('name');
		// Защита от случайного нажатия удалить сообщение
		answer = confirm("Удалить выбранную новость?");
		
		if(answer == true) {
			$.post(                              
				"php/post_drop.php",
				{statid:idMess},
				// Если ответ сервера положительный, работаем дальше	
				function onAjaxSuccess3(datar){   
					if (datar == 1) {
						//alert("Все пучком!");
						location.reload();
					} else {
						alert(datar);
					}
				}
			);
		} else {
			return false;
		}						
	});

});