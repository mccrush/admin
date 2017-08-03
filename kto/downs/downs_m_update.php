<?


// Присваиваем переменным все текстоввые значения из пришедших данных
$id = $_POST['id'];
$description = htmlspecialchars(trim($_POST['description']));
$section = trim($_POST['section']);
$page = trim($_POST['page']);
$st = trim($_POST['st']);
$pt = trim($_POST['pt']);
//$date_edit = DATE('Y-m-d');



//echo "<br>$title, $description, $text, $date_edit, $public, $id<br>";

//$imgs = count($_FILES['userfile_all']['name']);
// Соединяемся с БД
require_once("../../../config/db_connect.php");

$query = sprintf("UPDATE `mc_downs` SET description='%s' WHERE id='%s'", $description, $id);

//echo $query;
$result = mysqli_query($dbcnx, $query);

if($result) {
	//echo "Данные успешно обновлены<br>";
	mysqli_close($dbcnx);
	header('Location: downs_v_list.php?section='.$section.'&st='.$st.'&page='.$page.'&pt='.$pt);
} else {
	echo "<br>Данные НЕ оновлены. Ищи ошибку<br>";
}


	
?>