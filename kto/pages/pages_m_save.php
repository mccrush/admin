<?
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Присваиваем переменным все текстоввые значения из пришедших данных
$title = trim($_POST['title']);
$alias = trim($_POST['alias']);
$description = trim($_POST['description']);
$keywords = trim($_POST['keywords']);
$section = trim($_POST['section']);
//$st = $_POST['st'];

/*echo $title."<br>";
echo $alias."<br>";
echo $description."<br>";
echo $keywords."<br>";
echo $section."<br>";
echo $public."<br>";
echo date("Y-m-d");*/



// Соединяемся с БД
require_once("../../../config/db_connect.php");

$query = sprintf("INSERT INTO `mc_pages` (`title`, `alias`, `description`, `keywords`, `section`, `date_create`, `date_edit`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')", $title, $alias, $description, $keywords, $section, date("Y-m-d"), date("Y-m-d"));

//echo $query;

$result = mysqli_query($dbcnx, $query);


// если все ОК, то перенаправляем на старницу списка всех новостей
if($result) {
	//echo "Данные успешно добавлены<br>";
// Вытаскиваем значение заголовка раздела
$res = mysqli_query($dbcnx, "SELECT `title` FROM `mc_sections` WHERE alias = '$section'");
$ost = mysqli_fetch_array($res);
$st = $ost['title'];

	mysqli_close($dbcnx);
	header('Location: pages_v_list.php?section='.$section.'&st='.$st);
} else {
	echo "<br>Данные НЕ отправлены. Ищи ошибку<br>";
}

?>