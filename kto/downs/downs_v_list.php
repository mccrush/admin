<? include '../zamok.php';
$parent = 'Документы';
$title = 'Список документов сайта'; ?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

<? // Проверка условия выбора рордительского раздела для списка
if (!isset($_GET['section'])) {
  // Если нет значения раздела, то все по умолчанию
  $section = 'm3';
  $st = 'Документы';
  $page = 'ustav';
  $pt = 'Устав';
} else {
  $section = $_GET['section'];
  $st = $_GET['st'];

  if (!isset($_GET['page'])) {
    $page = 'ustav';
    $pt = 'Устав';
	} else {
	  $page = $_GET['page'];
	  $pt = $_GET['pt'];

	  if ($_GET['uroven'] == '') {
      unset($uroven);
    } else {  
      $uroven = $_GET['uroven'];
      
      if (!isset($_GET['block'])) {
        unset($block);
      } else {
        $block = $_GET['block'];
      }
    } 
	}
}


// Проверка условий сортировки
if (!isset($_GET['order'])) {
    $order = 'position';
    $sort = 'ASC';
} else {
    $order = $_GET['order'];
    $sort = $_GET['sort'];
}

// Соединяемся с БД
require_once '../../../config/db_connect.php'; 

function showLists($dbcnx, $param, $section, $st, $page, $pt, $uroven) {
	switch ($param) {
    case "section":
        $query = "SELECT `title`, `alias` FROM `mc_sections`";
        break;
    case "page":
        $query = "SELECT `title`, `alias` FROM `mc_pages` WHERE section = '$section'";
        break;
    case "uroven":
        $query = "SELECT DISTINCT `uroven` FROM `mc_downs` WHERE page = '$page'";
        break;
    case "block":
        $query = "SELECT DISTINCT `block` FROM `mc_downs` WHERE uroven = '$uroven'";
        break;    
	}
//echo $element;
	$result = mysqli_query($dbcnx, $query);
  //echo $query;
	// Если запрос не прошел, прекращаем работу скрипта
	if (!$result) {
		die(mysqli_error($dbcnx));
	}
	//Извлечение из БД
	$n = mysqli_num_rows($result);
	$articles = array();

	for ($i = 0; $i < $n; $i++) {
		$row = mysqli_fetch_assoc($result);
		$articles[] = $row;
	}

  foreach ($articles as $a):
  	//echo $element;
  	switch ($param) {
	    case "section":
	        echo '<li><a href="?section='.$a['alias'].'&st='.$a['title'].'">'.$a['title'].'</a></li>';
	        break;
	    case "page":
	        echo '<li><a href="?section='.$section.'&st='.$st.'&page='.$a['alias'].'&pt='.$a['title'].'&uroven='.$a['uroven'].'">'.$a['title'].'</a></li>';
	        break;
	    case "uroven":
	        echo '<li><a href="?section='.$section.'&st='.$st.'&page='.$page.'&pt='.$pt.'&uroven='.$a["uroven"].'">'.$a["uroven"].'</a></li>';
	        break;
	    case "block":
	        echo '<li><a href="?section='.$section.'&st='.$st.'&page='.$page.'&pt='.$pt.'&uroven='.$uroven.'&block='.$a["block"].'">'.$a["block"].'</a></li>';
	        break;    
		}
  endforeach;  	
}



?>

<div class="row"><!-- Строка выбора раздела и кнопки -->
  <div class="col-md-3">  
    <div class="form-group">
      <div class="dropdown">
        <label for="dropdownMenu1">Уточните раздел</label><br>
        <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?=mb_substr($st, 0, 24, 'UTF-8')?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">                          
					<? showLists($dbcnx, 'section', '', '', '', '', ''); ?>
        </ul>
      </div>       
    </div>
  </div>  

  <div class="col-md-3">  
    <div class="form-group">
       <div class="dropdown">
        <label for="dropdownMenu2">Уточните страницу</label><br>
        <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?=mb_substr($pt, 0, 24, 'UTF-8')?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2"> 
	        <? showLists($dbcnx, 'page', $section, $st, '', '', ''); ?>
        </ul>
      </div>       
    </div>
  </div>

  <!-- Строка выбора уровня и блока -->
	<?// if (!isset($uroven)) {echo "<!--";} ?>
  <div class="col-md-2">
    <div class="form-group">
      <div class="dropdown">
        <label for="dropdownMenu3">Уточните уровень</label><br>
        <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?=mb_substr($uroven, 0, 12, 'UTF-8')?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">                          
					<? showLists($dbcnx, 'uroven', $section, $st, $page, $pt, ''); ?>
        </ul>
      </div>       
    </div>
  </div>

  <div class="col-md-2">  
    <div class="form-group">
       <div class="dropdown">
        <label for="dropdownMenu4">Уточните блок</label><br>
        <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?=mb_substr($block, 0, 12, 'UTF-8')?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu4"> 
	        <? showLists($dbcnx, 'block', $section, $st, $page, $pt, $uroven); ?>
        </ul>
      </div>       
    </div>
  </div>
  <?// if (!isset($uroven)) {echo "-->"; echo '<div class="col-md-2"></div><div class="col-md-2"></div>';} ?>
	<!-- Конец строки выбора уровня и блока -->
	<div class="col-md-2">
    <label for="adddoc">Или можете</label><br>
    <a role="button" href="downs_v_add.php?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&uroven=<?=$uroven?>&block=<?=$block?>" class="btn btn-success btn-block" name="adddoc" title="Добавить документ">Добавить док-нт</a>
  </div>
</div><!-- Конец строки выбора раздела и кнопки -->





<table class='table table-bordered'>
  <tr align='center'>
    <td width='5%'>
    	<strong>Id</strong>&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&order=id&sort=<?= $sort == 'ASC' ? 'DESC' : 'ASC' ?>" title="Сортировать по Id"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a>
    </td>
    <td width='5%'>
    	<strong>Дата</strong>&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&order=date_create&sort=<?= $sort == 'ASC' ? 'DESC' : 'ASC' ?>" title="Сортировать по Дате"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a>
    </td>
    <td width='50%' style='vertical-align:top'>
    	<strong>Описание</strong>&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&order=description&sort=<?= $sort == 'ASC' ? 'DESC' : 'ASC' ?>" title="Сортировать по названию"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a>
    </td>
    <td width='5%'>
    	<strong>Тип</strong>&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&order=ext&sort=<?= $sort == 'ASC' ? 'DESC' : 'ASC' ?>" title="Сортировать по типу"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a>
    </td>
    <td width='10%'>
    	<strong>Размер</strong><!-- &nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&order=file_size&sort=<?= $sort == 'ASC' ? 'DESC' : 'ASC' ?>" title="Сортировать по размеру"><span class="glyphicon glyphicon-sort-by-attributesglyphicon glyphicon-sort" aria-hidden="true"></span></a> -->
    </td>
    <td width='10%'><strong>Позиция</strong></td>
    <td width='10%'><strong>Действие</strong></td>
  </tr>

	<? // Запрос к таблице документов
	$query = "SELECT * FROM `mc_downs` WHERE page = '$page' AND uroven = '$uroven' AND block = '$block' ORDER BY {$order} {$sort}";
	$result = mysqli_query($dbcnx, $query);
	        
	if (!$result) {
	  die(mysqli_error($dbcnx));
	}        

	//Извлечение из БД
	$n = mysqli_num_rows($result);
	$articles = array();
	        
	for ($i = 0; $i < $n; $i++) {
	  $row = mysqli_fetch_assoc($result);
	  $articles[] = $row;
	} ?>                

	<? foreach ($articles as $a): ?>
  <tr>
    <td align="center"><?=$a['id']?></td>
    <td align="center"><?=substr($a['date_create'], 8, 2).".".substr($a['date_create'], 5, 2).".".substr($a['date_create'],2,2);?></td>
    <td><?=$a['description']?></td>
    <td align="center"><?=$a['ext']?></td>
    <td align="center"><?=$a['file_size']?></td>
    <td align="center">
      <?=$a['position']?>&nbsp;&nbsp;<div class="btn-group btn-group-xs" role="group"><a href="downs_m_pos.php?id=<?=$a['id']?>&ch=-1&section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>" type="button" title="Поднять" class="btn btn-default btn-xs down-up"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a><a href="downs_m_pos.php?id=<?=$a['id']?>&ch=1&section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>" type="button" title="Опустить" class="btn btn-default btn-xs down-up"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></div>
    </td>
    <td align="center">
      <a href="downs_v_edit.php?id=<?=$a['id']?>&section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>" type="button" title="Редактировать документ" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;<a href="downs_m_delete.php?id=<?=$a['id']?>&section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&uroven=<?=$uroven?>&block=<?=$block?>" type="button" title="Удалить документ" class="btn btn-primary btn-xs down-delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
    </td>
  </tr>
	<? endforeach ?>
</table>    
      
<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>