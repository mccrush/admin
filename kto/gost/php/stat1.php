<?
// Соединяемся с БД
require_once '../../../../config/db_connect.php';

	// Если сущесвует переданный параметр id, то работаем дальше
	if(isset($_POST['statid'])) {
		$_POST['page'] == "gb" ? $tables = "sch_gostkniga"  : $tables = "sch_news";
		$minires = mysqli_query($dbcnx, "UPDATE {$tables} SET stat=0 WHERE id={$_POST['statid']}");
	} else {  // Иначе громко ругаемся матом!
		echo "Идентификатор сообщения не был передан!";
		exit();
	}
	// Если обновление статуса прошло успешно, возвращаем единицу
	if ($minires) {echo "1";} else {echo "Обновление статуса не было произведено!";}
	
?>