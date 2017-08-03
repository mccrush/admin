<? include '../zamok.php';
$parent = 'Разделы сайта';
$title = 'Редактирование раздела';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

<? 

if (!isset($_GET['id'])) {
	exit();
} else {
	$id = $_GET['id'];
}

// Соединяемся с БД
require_once '../../../config/db_connect.php';

// Запрос
		$query = "SELECT `title` FROM `mc_sections` WHERE id = {$id}";
		//echo "<p></p>".$query;
		$result = mysqli_query($dbcnx, $query);
		
		if(!$result)
			die(mysqli_error($dbcnx));
		
		$articles = mysqli_fetch_assoc($result);
		
?>

			  <form enctype="multipart/form-data" method="post" action="sections_m_update.php">

					  <div class="form-group">
							<label for="title">Название раздела</label>
							<input type="text" class="form-control" name="title" value="<?=$articles['title'];?>">
					  </div>

					  <input type="hidden" name="id" value="<?=$id?>">
					  
					  <div class="row">
							<div class="col-md-6">
								<a type="button" class="btn btn-default btn-block otmena" href="sections_v_list.php">Отмена</a>
							</div>
							
							<div class="col-md-6">
								<input type="submit" class="btn btn-success btn-block" value="Сохранить изменения" />
							</div>
					  </div>	
				  
				 
			  </form>
			  
<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
