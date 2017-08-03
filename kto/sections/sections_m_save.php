<?

// Присваиваем переменным все текстоввые значения из пришедших данных
$title = trim($_POST['title']);
$alias = trim($_POST['alias']);


// Соединяемся с БД
require_once("../../../config/db_connect.php");

$query = sprintf("INSERT INTO `mc_sections` (`title`, `alias`, `date_create`) VALUES ('%s', '%s', '%s')", $title, $alias, date("Y-m-d"));

//echo $query;

$result = mysqli_query($dbcnx, $query);


// если все ОК, то перенаправляем на старницу списка всех новостей
if($result) {
	//echo "Данные успешно добавлены<br>";
	mysqli_close($dbcnx);
	header('Location: sections_v_list.php');
} else {
	echo "<br>Данные НЕ отправлены. Ищи ошибку<br>";
}

?>