<?

if (!isset($_GET['id'])) {
	exit();
} else {
	$id = $_GET['id'];
	$ch = $_GET['ch'];
	$section = $_GET['section'];
  $st = $_GET['st'];
  $page = $_GET['page'];
  $pt = $_GET['pt'];
}

// Соединяемся с БД
require_once("../../../config/db_connect.php");

// Вытаскиваем текущее значение позиции
$res = mysqli_query($dbcnx, "SELECT `position` FROM `mc_downs` WHERE id = '$id'");
$ost = mysqli_fetch_array($res);
$newPosition = $ost['position'] + intval($ch);

$query = sprintf("UPDATE `mc_downs` SET position='%s' WHERE id='%s'", $newPosition, $id);

$result = mysqli_query($dbcnx, $query);

if($result) {
	//echo "Данные успешно обновлены<br>";
	mysqli_close($dbcnx);
	header('Location: downs_v_list.php?section='.$section.'&st='.$st.'&page='.$page.'&pt='.$pt);
} else {
	echo "<br>Данные НЕ обновлены. Ищи ошибку<br>";
}

?>