// JavaScript Document
// Author: mccrush.ru

function deleteDocument() {
	var downDel = document.querySelectorAll('.page-delete');
	for (var i = 0; i < downDel.length; i++) {
		downDel[i].onclick = function() {
			return confirm("Удалить страницу?") ? true : false;
		}
	}
}


window.onload = function() {
	deleteDocument();
}