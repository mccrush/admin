<?

if (!isset($_GET['id'])) {
	exit();
} else {
	$id = $_GET['id'];
	$section = $_GET['section'];
  $st = $_GET['st'];
  $page = $_GET['page'];
  $pt = $_GET['pt'];
}

// Соединяемся с БД
require_once("../../../config/db_connect.php");

// Вытаскиваем значения имени файла расширения и прочего
$res = mysqli_query($dbcnx, "SELECT * FROM `mc_downs` WHERE id = '$id'");
$ost = mysqli_fetch_array($res);

// Удаляем файл из лиректории
$linkfile = '../../../down/'.$ost['section'].'/'.$ost['page'].'/'.$ost['file_name'].$ost['ext'];
if (file_exists($linkfile)) {
    unlink($linkfile);
}


// Удаляем файл из БД
$query = sprintf("DELETE FROM `mc_downs` WHERE id='%s'", $id);
$result = mysqli_query($dbcnx, $query);

if($result) {
	//echo "Данные успешно удалены<br>";
	mysqli_close($dbcnx);
	header('Location: downs_v_list.php?section='.$section.'&st='.$st.'&page='.$page.'&pt='.$pt);
} else {
	echo "<br>Данные НЕ удалены. Ищи ошибку<br>";
}

?>