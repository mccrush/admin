<?

if (!isset($_GET['id'])) {
	exit();
} else {
	$id = $_GET['id'];
}

//echo "<br>$title, $description, $text, $date_edit, $public, $id<br>";

//$imgs = count($_FILES['userfile_all']['name']);
// Соединяемся с БД
require_once("news_db_connect.php");

$query = sprintf("DELETE FROM `news` WHERE id='%s'", $id);



//echo $query;

$result = mysqli_query($dbcnx, $query);

if($result) {
	//echo "Данные успешно удалены<br>";
	mysqli_close($dbcnx);
	header('Location: news_list.php');
} else {
	echo "<br>Данные НЕ удалены. Ищи ошибку<br>";
}


	
?>