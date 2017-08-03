var news2 = function () {
	
	
	$('.delete').click(function(){
		if(confirm("Удалить выбранную новость?")) {
			return true;
		} else {
			return false;
		}
	});
	
	$('.otmena').click(function(){
		if(confirm("Точно отменить действие?")) {
			return true;
		} else {
			return false;
		}
	});
	
};

$(document).ready(news2);