// JavaScript Document
// Author: mccrush.ru

function deleteNews() {
	var newsDel = document.querySelectorAll('.news-delete');
	for (var i = 0; i < newsDel.length; i++) {
		newsDel[i].onclick = function() {
			return confirm("Удалить новость?") ? true : false;
		}
	}
}

function statusNews() {
	var newsStat = document.querySelectorAll('.news-status');
	for (var i = 0; i < newsStat.length; i++) {
		newsStat[i].onclick = function() {
			return confirm("Изменить статус публикации?") ? true : false;
		}
	}
}


window.onload = function() {
	deleteNews();
	statusNews();
}