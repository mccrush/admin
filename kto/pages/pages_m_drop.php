<?php require_once '../../../config/db_connect.php';
	// Если сущесвует переданный параметр id, то работаем дальше
	if (isset($_POST['statid'])) {
		$minires = mysqli_query($dbcnx, "DELETE FROM `mc_pages` WHERE id={$_POST['statid']}");
	} else {  // Иначе громко ругаемся матом!
		echo "Идентификатор сообщения не был передан!";
		exit();
	}
	// Если удаление прошло успешно, возвращаем единицу
	if ($minires) {echo "1";} else {echo "Страница не удалена!";}
	
?>