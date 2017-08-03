<?


// Присваиваем переменным все текстоввые значения из пришедших данных
$title = trim($_POST['title']);
$description = trim($_POST['description']);
$text = htmlspecialchars(trim($_POST['text']));
$date_edit = DATE('Y-m-d');
$status = $_POST['status'];
$id = $_POST['id'];

//echo "<br>$title, $description, $text, $date_edit, $public, $id<br>";

//$imgs = count($_FILES['userfile_all']['name']);
// Соединяемся с БД
require_once '../../../config/db_connect.php';

$query = sprintf("UPDATE `mc_news` SET title='%s', description='%s', text='%s', date_edit='%s', status='%s'  WHERE id='%s'", $title, $description, $text, $date_edit, $status, $id);


//echo $query;

$result = mysqli_query($dbcnx, $query);

if($result) {
	//echo "Данные успешно обновлены<br>";
	mysqli_close($dbcnx);
	header('Location: news_v_list.php');
} else {
	echo "<br>Данные НЕ оновлены. Ищи ошибку<br>";
}


	
?>