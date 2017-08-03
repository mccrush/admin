<?
// Соединяемся с БД
require_once '../../../../config/db_connect.php';
	
	// Если сущесвует переданный параметр id, то работаем дальше
	if(isset($_POST['id'])) {
		$_POST['page'] == "gb" ? $tables = "sch_gostkniga"  : $tables = "sch_news";
		echo "Страница редактирования в таблице $tables с id = $_POST['id']";
		//$minires = mysql_query("UPDATE {$tables} SET stat=0 WHERE id={$_POST['statid']}");
	} else {  // Иначе громко ругаемся матом!
		echo "Идентификатор не был передан!";
		//exit();
	}
	// Если обновление статуса прошло успешно, возвращаем единицу
	//if ($minires) {echo "1";} else {echo "Обновление статуса не было произведено!";}
	
?>

		