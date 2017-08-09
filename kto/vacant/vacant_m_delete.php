<?

if (!isset($_GET['id'])) {
	exit();
} else {
	$id = $_GET['id'];
}

// Соединяемся с БД
require_once("../../../config/db_connect.php");


// Удаляем файл из БД
$query = "DELETE FROM `mc_vacant` WHERE id='$id'";
$result = mysqli_query($dbcnx, $query);

if($result) {
	//echo "Данные успешно удалены<br>";
	mysqli_close($dbcnx);
	header('Location: vacant_v_list.php');
} else {
	echo "<br>Данные НЕ удалены. Ищи ошибку<br>";
}

?>