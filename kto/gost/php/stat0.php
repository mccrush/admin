<?
// Соединяемся с БД
require_once '../../../../config/db_connect.php';
	
	// Если сущесвует переданный параметр id, то работаем дальше
	if(isset($_POST['statid'])) {
		$_POST['page'] == "gb" ? $tables = "sch_gostkniga"  : $tables = "sch_news";
		$minires = mysqli_query($dbcnx, "UPDATE {$tables} SET stat=1 WHERE id={$_POST['statid']}");
		$res = mysqli_query($dbcnx, "SELECT `mail`,`name` FROM {$tables} WHERE id={$_POST['statid']}");
		$row = mysqli_fetch_assoc($res);
	} else {  // Иначе громко ругаемся матом!
		echo "Идентификатор сообщения не был передан!";
		exit();
	}
	// Если обновление статуса прошло успешно, возвращаем ноль
	if ($minires) {
		echo "0";
		//require_once 'mail2.php';
	} else {echo "Обновление статуса не было произведено!";}
	
?>