// JavaScript Document
// Author: mccrush.ru

$(document).ready(function(e) {

	// Редактируем вопрос-ответ
	$('.editMess').click(function(){
		var id = $(this).attr('alt');
		$('#quest').text($('#'+id).text());
		$('#answer').text($('.'+id).text());
		$('#otvetil').val($('.otv'+id).text());
		$(".save-quest").attr('alt',id);
	});
	
	$(".save-quest").click(function(){
		var id = $(this).attr('alt');
		console.log(id);
		var quest = $("#quest").val();
		var answer = $("#answer").val();
		var otvetil = $("#otvetil").val();
			$.post(                              
				"php/update_quest.php",
				{
				statid:id,
				page:'gb',
				quest: quest,
				answer: answer,
				otvetil: otvetil
				},
				// Если ответ сервера положительный, работаем дальше	
				function onAjaxSuccess1(datar){   
					if (datar == 1) {
						//alert(datar);
						location.reload();
						//$(this).attr('src','img/no.png');
					} else {
						//alert(datar);
						alert(datar + "Твою дивизию. У нас ошибка в update_quest.php");
					}
				}
			);
	});
	
	
	// При клике по иконке статуса сообщения
	$('.editStat').click(function(){
		id = $(this).attr('name');

		if($(this).attr('alt') == "1") {
			$.post(                              
				"php/stat1.php",
				{statid:id,
				page:'gb'	
				},
				// Если ответ сервера положительный, работаем дальше	
				function onAjaxSuccess1(datar){   
					if (datar == 1) {
						//alert(datar);
						location.reload();
						//$(this).attr('src','img/no.png');
					} else {
						//alert(datar);
						alert("Твою дивизию. У нас ошибка в stat1.php");
					}
				}
			);
		} else {
			$.post(                              
				"php/stat0.php",
				{statid:id,
				page:'gb'},
				// Если ответ сервера положительный, работаем дальше	
				function onAjaxSuccess0(datar){   
					if (datar == 0) {
						//alert("Все пучком!");
						//alert(datar);
						location.reload();
						//$(this).attr('src','img/yes.png');
					} else {
					alert(datar + "Твою дивизию. У нас ошибка в stat0.php");
					}
				}
			);
		}						
	});

	// При клике по иконке удаленияя сообщения 
	$('.drop-pages').click(function(){
		idMess = $(this).attr('name');
		// Защита от случайного нажатия удалить сообщение
		answer = confirm("Удалить выбранное сообщение?");
		
		if(answer == true) {
			$.post(                              
				"pages_m_drop.php",
				{statid:idMess,
				page:'gb'},
				// Если ответ сервера положительный, работаем дальше	
				function onAjaxSuccess3(datar){   
					if (datar == 1) {
						//alert(datar);
						//alert("Все пучком!");
						location.reload();
					} else {
						alert(datar);
						alert("Твою дивизию. У нас ошибка в drop.php");
					}
				}
			);
		} else {
			return false;
		}						
	});

});