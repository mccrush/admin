<? 
$id = $_POST['id'];
$value = $_POST['value'];
$type = $_POST['type'];
$date_up = DATE('Y-m-d');
// Соединяемся с БД
require_once("../../../config/db_connect.php");

$query = "UPDATE `mc_vacant` SET $type='$value' WHERE id='$id'";
$result = mysqli_query($dbcnx, $query);

$query2 = "UPDATE `mc_pages` SET `date_edit`= '$date_up' WHERE alias='vakant_mesta'";
$result2 = mysqli_query($dbcnx, $query2);

if($result) {
	mysqli_close($dbcnx);
	echo "yes";
} else {
	echo "no";
}

?>