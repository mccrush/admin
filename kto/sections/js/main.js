// JavaScript Document
// Author: mccrush.ru

function deleteDocument() {
	var sectiDel = document.querySelectorAll('.section-delete');
	for (var i = 0; i < sectiDel.length; i++) {
		sectiDel[i].onclick = function() {
			return confirm("Удалить раздел?") ? true : false;
		}
	}
}


window.onload = function() {
	deleteDocument();
}