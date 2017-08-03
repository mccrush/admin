<?php require_once '../../../blocks/param/config.php';
	// Если сущесвует переданный параметр id, то работаем дальше
	if(isset($_POST['statid'])) {
		$_POST['page'] == 0 ? $tables = "sch_gostkniga"  : $tables = "sch_news";
		$minires = mysqli_query($dbcnx, "DELETE FROM {$tables} WHERE id={$_POST['statid']}");
	} else {  // Иначе громко ругаемся матом!
		echo "Идентификатор сообщения не был передан!";
		exit();
	}
	// Если удаление прошло успешно, возвращаем единицу
	if ($minires) {echo "1";} else {echo "Сообщение не удалено!";}
	
?>