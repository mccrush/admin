<? include '../zamok.php';
$parent = 'Страницы сайта';
$title = 'Редактирование страницы';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

<? 

if (!isset($_GET['id'])) {
	exit();
} else {
	$id = $_GET['id'];
	$section = $_GET['section'];
  $st = $_GET['st'];
}

// Соединяемся с БД
require_once '../../../config/db_connect.php';

// Запрос
		$query = "SELECT * FROM `mc_pages` WHERE id = {$id}";
		//echo "<p></p>".$query;
		$result = mysqli_query($dbcnx, $query);
		
		if(!$result)
			die(mysqli_error($dbcnx));
		
		$articles = mysqli_fetch_assoc($result);
		
// Вытаскиваем текущее значение названия раздела
$tempSection = $articles['section'];
$res = mysqli_query($dbcnx, "SELECT `title` FROM `mc_sections` WHERE alias = '$tempSection'");
$ost = mysqli_fetch_array($res);
$tecSection = $ost['title'];		
?>

			  <form enctype="multipart/form-data" method="post" action="pages_m_update.php">

					  <div class="row">
							<div class="col-md-5">
							  <div class="form-group">
									<label for="title">Заголовок страницы</label>
									<input type="text" class="form-control" name="title" value="<?=$articles['title']?>">
							  </div>
							</div>
							<div class="col-md-4">
							  <div class="form-group">
									<label for="alias">Алиас</label>
									<input type="text" class="form-control" name="alias" value="<?=$articles['alias']?>">
							  </div>
						  </div>
						  
						  <div class="col-md-3">
<div class="form-group">
				<label for="section">Изменить раздел</label>
				<select class="form-control" name="section">
					<option value="<?=$articles['section']?>"><?=$tecSection?></option>
<?

// Запрос к таблице разделов
$query_sections = "SELECT `alias`, `title` FROM `mc_sections`";
$result_sections = mysqli_query($dbcnx, $query_sections);

if (!$result_sections) {// Если запрос не прошел, прекращаем работу скрипта
//echo mysqli_error($dbcnx);
	die(mysqli_error($dbcnx));
}

//Извлечение из БД
$n_sections = mysqli_num_rows($result_sections);
$articles_sections = array();

for ($i = 0; $i < $n_sections; $i++) {
	$row_sections = mysqli_fetch_assoc($result_sections);
	$articles_sections[] = $row_sections;
}
?>	

<?php foreach ($articles_sections as $a_sections):?>
	<option value="<?=$a_sections['alias']?>"><?=$a_sections['title']?></option>
<?php endforeach ?>	

				</select>
			</div>
		</div>

						  </div>

					  <div class="form-group">
							<label for="description">Описание страницы</label>
							<textarea class="form-control" rows="3" name="description"><?=$articles['description']?></textarea>
						</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="keywords">Изменить ключевые слова</label>
				<input type="text" class="form-control" name="keywords" value="<?=$articles['keywords']?>">
			</div>
		</div>
	</div>


					  <input type="hidden" name="id" value="<?=$id?>">
					  <input type="hidden" name="st" value="<?=$st?>">
					  
					  <div class="row">
							<div class="col-md-6">
								<a type="button" class="btn btn-default btn-block otmena" href="pages_v_list.php?section=<?=$section?>&st=<?=$st?>">Отмена</a>
							</div>
							
							<div class="col-md-6">
								<input type="submit" class="btn btn-success btn-block" value="Сохранить изменения" />
							</div>
					  </div>	
				  
				 
			  </form>
			  
<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
