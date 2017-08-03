<? include '../zamok.php';
$parent = 'Страницы сайта';
$title = 'Добавление страницы';
?>

<? // Проверка условия выбора рордительского раздела
if (!isset($_GET['section'])) {
  $section = '';
  $st = 'Выберите раздел';
} else {
  $section = $_GET['section'];
  $st = $_GET['st'];
}

?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

<form enctype="multipart/form-data" method="post" action="pages_m_save.php">
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<label for="title">Заголовок страницы</label>
				<input type="text" class="form-control" name="title" placeholder="Введите заголовок страницы">
			</div>
		</div>

		<div class="col-md-4">	
			<div class="form-group">
				<label for="alias">Алиас страницы</label>
				<input type="text" class="form-control" name="alias" placeholder="Введите алиас страницы">
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="description">Описание страницы</label>
		<textarea class="form-control" rows="3" name="description"></textarea>
	</div>

	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<label for="keywords">Ключевые слова (через запятую)</label>
				<input type="text" class="form-control" name="keywords" placeholder="Введите ключевые слова страницы (через запятую)">
			</div>
		</div>

		<div class="col-md-4">	
			<div class="form-group">
				<label for="section">Укажите раздел сайта</label>
				<select class="form-control" name="section">
					<option value="<?=$section?>"><?=$st?></option>
<?

// Соединяемся с БД
require_once '../../../config/db_connect.php';

// Запрос к таблице разделов
$query = "SELECT `id`, `title`, `alias` FROM `mc_sections`";
$result = mysqli_query($dbcnx, $query);

if (!$result) {// Если запрос не прошел, прекращаем работу скрипта
//echo mysqli_error($dbcnx);
	die(mysqli_error($dbcnx));
}

//Извлечение из БД
$n = mysqli_num_rows($result);
$articles = array();

for ($i = 0; $i < $n; $i++) {
	$row = mysqli_fetch_assoc($result);
	$articles[] = $row;
}
?>	

<?php foreach ($articles as $a):?>
	<option value="<?=$a['alias']?>"><?=$a['title']?></option>
<?php endforeach ?>	

				</select>
			</div>
		</div>
	</div>	

<!-- <input type="hidden" name="st" value="<?=$st?>"> -->
<div class="row">
	<div class="col-md-6" style="text-align: center;">
		<a type="button" class="btn btn-default btn-block otmena" href="pages_v_list.php?section=<?=$section?>&st=<?=$st?>">Отмена</a>
	</div>

	<div class="col-md-6">
		<input type="submit" class="btn btn-success btn-block" value="Добавить страницу" />
	</div>
</div>	
</form>

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
