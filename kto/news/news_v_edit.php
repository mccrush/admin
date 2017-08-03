<? include '../zamok.php';
$parent = 'Новости';
$title = 'Редактирование новости';
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
		$query = "SELECT * FROM `mc_news` WHERE id = {$id}";
		//echo "<p></p>".$query;
		$result = mysqli_query($dbcnx, $query);
		
		if(!$result)
			die(mysqli_error($dbcnx));
		
		$articles = mysqli_fetch_assoc($result);
		
?>            
			  <form enctype="multipart/form-data" method="post" action="news_m_update.php">
				  <div class="form-group">
						<label for="title">Заголовок</label>
						<input type="text" class="form-control" name="title" placeholder="Введите заголовок новости" value="<?=$articles['title']?>">
				  </div>
				  <div class="form-group">
						<label for="description">Краткое описание</label>
						<textarea class="form-control" rows="3" name="description"><?=$articles['description']?></textarea>
				  </div>
				  <div class="form-group">
						<label for="text">Текст новости</label>
						<textarea class="form-control editme" rows="14" name="text" ><?=$articles['text']?></textarea>
				 </div>
				<input type="hidden" name="id" value="<?=$id?>">
				  
				  <div class="row">
					<div class="col-md-6" style="text-align: center;">
						<a type="button" class="btn btn-default btn-block otmena" href="news_v_list.php">Отмена</a>
						<input type="checkbox" name="status" checked>
						<label for="status">Опубликовать новость</label>
					</div>
					
					<div class="col-md-6">
						<input type="submit" class="btn btn-success btn-block" value="Сохранить изменения" />
					</div>
				  </div>	
				  
				 
			  </form>
			  
<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
