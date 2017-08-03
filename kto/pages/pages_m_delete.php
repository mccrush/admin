<?

if (!isset($_GET['id'])) {
	exit();
} else {
	$id = $_GET['id'];
	$section = $_GET['section'];
  $st = $_GET['st'];
}

// Соединяемся с БД
require_once("../../../config/db_connect.php");

// Удаляем страницу из БД
$query = sprintf("DELETE FROM `mc_pages` WHERE id='%s'", $id);
$result = mysqli_query($dbcnx, $query);

if($result) {
	//echo "Данные успешно удалены<br>";
	mysqli_close($dbcnx);
	header('Location: pages_v_list.php?section='.$section.'&st='.$st);
} else {
	echo "<br>Данные НЕ удалены. Ищи ошибку<br>";
}

?>