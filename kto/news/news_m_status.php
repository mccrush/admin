<?

if (!isset($_GET['id'])) {
	exit();
} else {
	$id = $_GET['id'];
}

// Соединяемся с БД
require_once("../../../config/db_connect.php");

// Вытаскиваем текущее значение позиции
$res = mysqli_query($dbcnx, "SELECT `status` FROM `mc_news` WHERE id = '$id'");
$ost = mysqli_fetch_array($res);
$newStatus = ($ost['status'] == 'on') ? 'off' : 'on';

$query = sprintf("UPDATE `mc_news` SET status='%s' WHERE id='%s'", $newStatus, $id);

$result = mysqli_query($dbcnx, $query);

if($result) {
	//echo "Данные успешно обновлены<br>";
	mysqli_close($dbcnx);
	header('Location: news_v_list.php');
} else {
	echo "<br>Данные НЕ обновлены. Ищи ошибку<br>";
}

?>