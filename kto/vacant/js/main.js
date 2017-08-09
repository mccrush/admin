// js utf-8
// author: mccrush.ru
'use strict';

function deleteVacant() {
	var vacDel = document.querySelectorAll('.vacant-delete');
	for (var i = 0; i < vacDel.length; i++) {
		vacDel[i].onclick = function() {
			return confirm("Удалить класс?") ? true : false;
		}
	}
}


function answerData(data, idElem, typeElem){
	if(data == 'yes') {
    let cangeElem = (typeElem == 'text') ? document.querySelector('#id'+idElem) : document.querySelector('#idn'+idElem);
    cangeElem.parentNode.classList.toggle('success');
    setTimeout(function(){cangeElem.parentNode.classList.toggle('success')}, 3000);
	}
}

function sendRequest(idElem, newValue, typeElem, callback){
  let req = new XMLHttpRequest();
  req.open('POST', 'vacant_m_update.php');
  req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  //alert('data before: ' + data);
  req.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		  //alert('data after: ' + req.responseText);
		  callback(req.responseText, idElem, typeElem);
		}
  }
  req.send('id='+idElem+'&value='+newValue+'&type='+typeElem); 
}

function huntEventMest() {
  let cangeElem = document.querySelectorAll('.mest');
  for (var i = 0; i < cangeElem.length; i++) {
		cangeElem[i].onchange = function() {
      let idElem = this.getAttribute('name');
      let newValue = this.value;
      let typeElem = this.getAttribute('type');
      sendRequest(idElem, newValue, typeElem, answerData);
	  }
  }
}

function huntEventTitle() {
  let cangeElem = document.querySelectorAll('.title');
  for (var i = 0; i < cangeElem.length; i++) {
		cangeElem[i].onchange = function() {
      let idElem = this.getAttribute('name');
      let newValue = this.value;
      let typeElem = this.getAttribute('type');
      sendRequest(idElem, newValue, typeElem, answerData);
	  }
  }
}

window.onload = function() {
	huntEventMest();
	huntEventTitle();
	deleteVacant();
}