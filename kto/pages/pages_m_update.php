<?


// Присваиваем переменным все текстоввые значения из пришедших данных
$title = trim($_POST['title']);
$alias = trim($_POST['alias']);
$section = trim($_POST['section']);
$description = htmlspecialchars(trim($_POST['description']));
$keywords = trim($_POST['keywords']);
$date_edit = DATE('Y-m-d');
$id = $_POST['id'];

$st = $_POST['st'];

//echo "<br>$title, $description, $text, $date_edit, $public, $id<br>";

//$imgs = count($_FILES['userfile_all']['name']);
// Соединяемся с БД
require_once '../../../config/db_connect.php';

$query = sprintf("UPDATE `mc_pages` SET title='%s', alias='%s', section='%s', description='%s', keywords='%s', date_edit='%s' WHERE id='%s'", $title, $alias, $section, $description, $keywords, $date_edit, $id);


//echo $query;

$result = mysqli_query($dbcnx, $query);

if($result) {
	//echo "Данные успешно обновлены<br>";
	mysqli_close($dbcnx);
	header('Location: pages_v_list.php?section='.$section.'&st='.$st);
} else {
	echo "<br>Данные НЕ оновлены. Ищи ошибку<br>";
}


	
?>