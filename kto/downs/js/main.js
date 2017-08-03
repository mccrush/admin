// JavaScript Document
// Author: mccrush.ru

function deleteDocument() {
	var downDel = document.querySelectorAll('.down-delete');
	for (var i = 0; i < downDel.length; i++) {
		downDel[i].onclick = function() {
			return confirm("Удалить документ?") ? true : false;
		}
	}
}


window.onload = function() {
	deleteDocument();
}