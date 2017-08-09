<?

// Присваиваем переменным все текстоввые значения из пришедших данных
$class = trim($_POST['class']);
$text = trim($_POST['text']);
$number = trim($_POST['number']);


// Соединяемся с БД
require_once("../../../config/db_connect.php");

$query = "INSERT INTO `mc_vacant` (`class`, `text`, `number`) VALUES ('$class', '$text', '$number')";

//echo $query;

$result = mysqli_query($dbcnx, $query);


// если все ОК, то перенаправляем на старницу списка всех новостей
if($result) {
	//echo "Данные успешно добавлены<br>";
	mysqli_close($dbcnx);
	header('Location: vacant_v_list.php');
} else {
	echo "<br>Данные НЕ отправлены. Ищи ошибку<br>";
}

?>