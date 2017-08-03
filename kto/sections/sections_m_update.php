<?


// Присваиваем переменным все текстоввые значения из пришедших данных
$id = $_POST['id'];
$title = trim($_POST['title']);
//$date_edit = DATE('Y-m-d');



//echo "<br>$title, $description, $text, $date_edit, $public, $id<br>";

//$imgs = count($_FILES['userfile_all']['name']);
// Соединяемся с БД
require_once("../../../config/db_connect.php");

$query = sprintf("UPDATE `mc_sections` SET title='%s' WHERE id='%s'", $title, $id);

//echo $query;
$result = mysqli_query($dbcnx, $query);

if($result) {
	//echo "Данные успешно обновлены<br>";
	mysqli_close($dbcnx);
	header('Location: sections_v_list.php');
} else {
	echo "<br>Данные НЕ оновлены. Ищи ошибку<br>";
}


	
?>