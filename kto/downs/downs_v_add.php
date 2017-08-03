<? include '../zamok.php';
$parent = 'Документы';
$title = 'Добавить документ';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

<? 
// Проверка условия выбора рордительского раздела
if (!isset($_GET['section'])) {
  $section = 'm3';
  $st = 'Укажите раздел';
} else {
  $section = $_GET['section'];
  $st = $_GET['st'];
}

// Проверка условия выбора рордительской страницы
if (!isset($_GET['page'])) {
  $page = 'ustav';
  $pt = 'Выберите страницу';
} else {
  $page = $_GET['page'];
  $pt = $_GET['pt'];
}

// Соединяемся с БД
require_once '../../../config/db_connect.php';?>

<form enctype="multipart/form-data" method="post" action="downs_m_save.php">
 <div class="row">


  <div class="col-md-4">	
    <div class="form-group">
     <div class="dropdown">
      <label for="dropdownMenu1">Укажите раздел</label><br>
      <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <?=$st?>
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">                          

<?
// Запрос к таблице разделов
        $query_sections = "SELECT `id`, `title`, `alias` FROM `mc_sections`";
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
  <li><a href="?section=<?=$a_sections['alias']?>&st=<?=$a_sections['title']?>" class="li-a-m1"><?=$a_sections['title']?></a></li>
<?php endforeach ?> 
</ul>
</div>       
</div>
</div>

<div class="col-md-4">	
  <div class="form-group">
   <div class="dropdown">
    <label for="dropdownMenu2">Выберите страницу</label><br>
    <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
      <?=$pt?>
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2"> 

<?
// Запрос к таблице разделов
      $query_pages = "SELECT `id`, `title`, `alias` FROM `mc_pages` WHERE section = '$section'";
      $result_pages = mysqli_query($dbcnx, $query_pages);

if (!$result_pages) {// Если запрос не прошел, прекращаем работу скрипта
//echo mysqli_error($dbcnx);
  die(mysqli_error($dbcnx));
}

//Извлечение из БД
$n_pages = mysqli_num_rows($result_pages);
$articles_pages = array();

for ($i = 0; $i < $n_pages; $i++) {
  $row_pages = mysqli_fetch_assoc($result_pages);
  $articles_pages[] = $row_pages;
}
?>  

<?php foreach ($articles_pages as $a_pages):?>
  <li><a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$a_pages['alias']?>&pt=<?=$a_pages['title']?>" class="li-a-m2"><?=$a_pages['title']?></a></li>
<?php endforeach ?>  
</ul>
</div>       
</div>
</div>

<div class="col-md-4">  
  <div class="form-group">
    <label for="exampleInputFile">Укажите путь к файлу</label>
    <input type="file" name="uploadfile" id="exampleInputFile" >
    <p class="help-block">Допустимые <abbr title="doc, docx, xls, xlsx, pdf, rtf, rar, zip, jpg, jpeg, png, gif, ppt, pptx, odt, ods, odp">форматы</abbr><br>Максимал. размер 30 Мб</p>
  </div>
</div> 

</div>

<br>
<div class="row">
  <div class="col-md-12">
   <div class="form-group">
    <label for="description">Описание документа (обязательное поле)</label>
    <textarea class="form-control" rows="3" name="description" placeholder="Добавьте описание (название) документа"></textarea>
  </div>
</div>
</div>

<input type="hidden" name="section" value="<?=$section?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="st" value="<?=$st?>">
<input type="hidden" name="pt" value="<?=$pt?>">

<div class="row">
  <div class="col-md-6" style="text-align: center;">
   <a type="button" class="btn btn-default btn-block otmena" href="downs_v_list.php?section=<?=$section?>&page=<?=$page?>">Отмена</a>
 </div>

 <div class="col-md-6">
   <input type="submit" class="btn btn-success btn-block" value="Зарузить документ" />
 </div>
</div>
	
</form>

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
