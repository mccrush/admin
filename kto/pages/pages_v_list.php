<? include '../zamok.php';
$parent = 'Страницы сайта';
$title = 'Список страниц сайта';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

<? 

// Проверка условия выбора рордительского раздела
if (!isset($_GET['section'])) {
  $section = 'm3';
  $st = 'Документы';
} else {
  $section = $_GET['section'];
  $st = $_GET['st'];
}

if (!isset($_GET['order'])) {
    $order = 'id';
    $sort = 'DESC';
} else {
    $order = $_GET['order'];
    $sort = $_GET['sort'];
}

// Соединяемся с БД
require_once '../../../config/db_connect.php';

// Запрос к таблице страниц
$query = "SELECT * FROM `mc_pages` WHERE `section` = '$section' ORDER BY {$order} {$sort}";
//$query = "SELECT * FROM `mc_pages` ORDER BY {$order} {$sort}";
$result = mysqli_query($dbcnx, $query);

if(!$result)
    die(mysqli_error($dbcnx));

//Извлечение из БД
$n = mysqli_num_rows($result);
$articles = array();

for ($i = 0; $i < $n; $i++) {
    $row = mysqli_fetch_assoc($result);
    $articles[] = $row;
}

?>

						<div class="row">
                <div class="col-md-3">
<div class="form-group">
                       <div class="dropdown">
                        <label for="dropdownMenu1">Уточните раздел</label><br>
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
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <label for="butRaz">Вы можете</label><br>
                    <a role="button" href="../sections/sections_v_add.php" class="btn btn-default btn-block" id="butRaz">Добавить раздел</a>
    						</div>
                <div class="col-md-3">
                    <label for="adPage">Или</label><br>
										<a role="button" href="pages_v_add.php?section=<?=$section?>&st=<?=$st?>" class="btn btn-success btn-block" id="adPage">Добавить страницу</a>
                </div>

            </div>



<p><br>Сортировать по: <a href="?section=<?=$section?>&st=<?=$st?>&order=date_create&sort=DESC" class="btn btn-default btn-xs" title="Дата убывает"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span></a>&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&order=date_create&sort=ASC" class="btn btn-default btn-xs" title="Дата возрастает"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&order=title&sort=DESC" class="btn btn-default btn-xs" title="Алфавит убывает"><span class="glyphicon glyphicon-font" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span></a>&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&order=title&sort=ASC" class="btn btn-default btn-xs" title="Алфавит возрастает"><span class="glyphicon glyphicon-font" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span></a></p>
<hr>

<table class='table table-bordered'>
    <tr align='center'>
        <td width='5%'><strong>Id</strong></td>
        <td width='25%' style='vertical-align:top'><strong>Заголовк</strong></td>
        <td width='40%'><strong>Описание</strong></td>
        <td width='15%'><strong>Алиас</strong></td>
        <td width='5%'><strong>Раздел</strong></td>
        <td width='10%'><strong>Действие</strong></td>
    </tr>

    <?php foreach ($articles as $a):?>
       <tr>
        <td align="center"><?=$a['id']?></td>
        <td><?=$a['title']?></td>
        <td><?=$a['description']?></td>
        <td><?=$a['alias']?></td>
        <td align="center"><?=$a['section']?></td>
        <td align="center">
            <a href="pages_v_edit.php?id=<?=$a['id']?>&section=<?=$section?>&st=<?=$st?>" type="button" title="Редактировать страницу" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;<a href="pages_m_delete.php?id=<?=$a['id']?>&section=<?=$section?>&st=<?=$st?>" type="button" title="Удалить страницу" class="btn btn-primary btn-xs page-delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
        </td>
    </tr>
<?php endforeach ?>
</table>



<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>