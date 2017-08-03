<? include '../zamok.php';
$parent = 'Документы';
$title = 'Список документов сайта'; ?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

<? // Проверка условия выбора рордительского раздела
if (!isset($_GET['section'])) {
  // Если нет значения раздела, то все по умолчанию
  $section = 'm3';
  $st = 'Документы';
  $page = 'ustav';
  $pt = 'Устав';
} else {
  $section = $_GET['section'];
  $st = $_GET['st'];

  // Если есть значение раздела, то проверяем наличие значения старинцы
  if (!isset($_GET['page'])) {
    $page = 'ustav';
    $pt = 'Устав';
	} else {
	  $page = $_GET['page'];
	  $pt = $_GET['pt'];

	  // Если есть страница, то проверяем ее значение для документов образования
	  if ($page == 'obraz_standart') {
      // Проверяем существование  переменных уровня и блока
      if (!isset($_GET['uroven'])) {
        $uroven = 'ООП';
        $block = 'НОО (ФГОС)';
			} else {
		    $uroven = $_GET['uroven'];
		  
      // Если существует уровень, то проверям существование блока
		    if (!isset($_GET['uroven'])) {
		  	  $block = 'НОО (ФГОС)';
		    } else {
		  	  $block = $_GET['block'];
		    }
		  }
		} else {
      // Если страница не для документов образования, удаляем переменные уровень и блок
			unset($uroven, $block);
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
require_once '../../../config/db_connect.php'; ?>

<div class="row"><!-- Строка выбора раздела и кнопки -->
  <div class="col-md-4">  
    <div class="form-group">
      <div class="dropdown">
        <label for="dropdownMenu1">Уточните раздел</label><br>
        <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?=mb_substr($st, 0, 32, 'UTF-8')?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">                          
					<? // Запрос к таблице разделов
					$query_sections = "SELECT `id`, `title`, `alias` FROM `mc_sections`";
					$result_sections = mysqli_query($dbcnx, $query_sections);

					// Если запрос не прошел, прекращаем работу скрипта
					if (!$result_sections) {
					//echo mysqli_error($dbcnx);
					  die(mysqli_error($dbcnx));
					}

					//Извлечение из БД
					$n_sections = mysqli_num_rows($result_sections);
					$articles_sections = array();

					for ($i = 0; $i < $n_sections; $i++) {
					  $row_sections = mysqli_fetch_assoc($result_sections);
					  $articles_sections[] = $row_sections;
					} ?>  

					<? foreach ($articles_sections as $a_sections): ?>
          <li><a href="?section=<?=$a_sections['alias']?>&st=<?=$a_sections['title']?>" class="li-a-m1"><?=$a_sections['title']?></a></li>
					<? endforeach ?> 
        </ul>
      </div>       
    </div>
  </div>  

  <div class="col-md-4">  
    <div class="form-group">
       <div class="dropdown">
        <label for="dropdownMenu2">Уточните страницу</label><br>
        <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?=mb_substr($pt, 0, 32, 'UTF-8')?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2"> 

	        <? // Запрос к таблице разделов
	        $query_pages = "SELECT `id`, `title`, `alias` FROM `mc_pages` WHERE section = '$section'";
	        $result_pages = mysqli_query($dbcnx, $query_pages);

	        // Если запрос не прошел, прекращаем работу скрипта
	        if (!$result_pages) {
	        //echo mysqli_error($dbcnx);
	          die(mysqli_error($dbcnx));
	        }

	        //Извлечение из БД
	        $n_pages = mysqli_num_rows($result_pages);
	        $articles_pages = array();

	        for ($i = 0; $i < $n_pages; $i++) {
	          $row_pages = mysqli_fetch_assoc($result_pages);
	          $articles_pages[] = $row_pages;
	        } ?>  

					<? foreach ($articles_pages as $a_pages): ?>
          <li><a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$a_pages['alias']?>&pt=<?=$a_pages['title']?>" class="li-a-m2"><?=$a_pages['title']?></a></li>
					<? endforeach ?>  
        </ul>
      </div>       
    </div>
  </div>

  <div class="col-md-4">
    <label for="adddoc">Вы так же можете</label><br>
    <a role="button" href="downs_v_add.php?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>" class="btn btn-success btn-block" name="adddoc">Добавить документ</a>
  </div>
</div><!-- Конец строки выбора раздела и кнопки -->


<!-- Строка выбора уровня и блока -->
<? if (!isset($uroven)) {echo "<!--";} ?>
<div class="row">
  <div class="col-md-4">  
    <div class="form-group">
      <div class="dropdown">
        <label for="dropdownMenu3">Уточните уровень</label><br>
        <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?=mb_substr($uroven, 0, 32, 'UTF-8')?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">                          
					<? // Запрос к таблице разделов
					$query_uroven = "SELECT `uroven` FROM `mc_downs` WHERE page = '$page'";
					$result_uroven = mysqli_query($dbcnx, $query_uroven);

					// Если запрос не прошел, прекращаем работу скрипта
					if (!$result_uroven) {
					//echo mysqli_error($dbcnx);
					  die(mysqli_error($dbcnx));
					}

					//Извлечение из БД
					$n_uroven = mysqli_num_rows($result_uroven);
					$articles_uroven = array();

					for ($i = 0; $i < $n_uroven; $i++) {
					  $row_uroven = mysqli_fetch_assoc($result_uroven);
					  $articles_uroven[] = $row_uroven;
					} ?>  

					<? foreach ($articles_uroven as $a_uroven): ?>
          <li><a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&uroven=<?=$a_uroven['uroven']?>" class="li-a-m1"><?=$a_uroven['uroven']?></a></li>
					<? endforeach ?> 
        </ul>
      </div>       
    </div>
  </div>  

  <div class="col-md-4">  
    <div class="form-group">
       <div class="dropdown">
        <label for="dropdownMenu4">Уточните блок</label><br>
        <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?=mb_substr($block, 0, 32, 'UTF-8')?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu4"> 

	        <? // Запрос к таблице разделов
	        $query_pages = "SELECT `id`, `title`, `alias` FROM `mc_pages` WHERE section = '$section'";
	        $result_pages = mysqli_query($dbcnx, $query_pages);

	        // Если запрос не прошел, прекращаем работу скрипта
	        if (!$result_pages) {
	        //echo mysqli_error($dbcnx);
	          die(mysqli_error($dbcnx));
	        }

	        //Извлечение из БД
	        $n_pages = mysqli_num_rows($result_pages);
	        $articles_pages = array();

	        for ($i = 0; $i < $n_pages; $i++) {
	          $row_pages = mysqli_fetch_assoc($result_pages);
	          $articles_pages[] = $row_pages;
	        } ?>  

					<? foreach ($articles_pages as $a_pages): ?>
          <li><a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$a_pages['alias']?>&pt=<?=$a_pages['title']?>" class="li-a-m2"><?=$a_pages['title']?></a></li>
					<? endforeach ?>  
        </ul>
      </div>       
    </div>
  </div>

  <div class="col-md-4">
  </div>
</div>
<? if (!isset($uroven)) {echo "-->";} ?>
<!-- Конец строки выбора уровня и блока -->


<p>Сортировать по: <a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&order=date_create&sort=DESC" class="btn btn-default btn-xs" title="Дата убывает"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span></a>&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&order=date_create&sort=ASC" class="btn btn-default btn-xs" title="Дата возрастает"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&order=description&sort=DESC" class="btn btn-default btn-xs" title="Алфавит убывает"><span class="glyphicon glyphicon-font" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span></a>&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&order=description&sort=ASC" class="btn btn-default btn-xs" title="Алфавит возрастает"><span class="glyphicon glyphicon-font" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&order=position&sort=DESC" class="btn btn-default btn-xs" title="Позиция убывает"><span class="glyphicon glyphicon-sort-by-order-alt" aria-hidden="true"></span></a>&nbsp;<a href="?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&order=position&sort=ASC" class="btn btn-default btn-xs" title="Позиция возрастает"><span class="glyphicon glyphicon-sort-by-order" aria-hidden="true"></span></span></a></p>
<hr>

<table class='table table-bordered'>
  <tr align='center'>
    <td width='5%'><strong>Id</strong></td>
    <td width='5%'><strong>Дата</strong></td>
    <td width='55%' style='vertical-align:top'><strong>Описание</strong></td>
    <td width='5%'><strong>Тип</strong></td>
    <td width='10%'><strong>Размер</strong></td>
    <td width='10%'><strong>Позиция</strong></td>
    <td width='10%'><strong>Действие</strong></td>
  </tr>

	<? // Запрос к таблице документов
	$query = "SELECT * FROM `mc_downs` WHERE page = '$page' ORDER BY {$order} {$sort}";
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
    <td align="center"><?=intval($a['file_size']) > 1000 ? round(($a['file_size']/1000), 2).' МБ' : $a['file_size'].' КБ'?></td>
    <td align="center">
      <?=$a['position']?>&nbsp;&nbsp;<div class="btn-group btn-group-xs" role="group"><a href="downs_m_pos.php?id=<?=$a['id']?>&ch=-1&section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>" type="button" title="Поднять" class="btn btn-default btn-xs down-up"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a><a href="downs_m_pos.php?id=<?=$a['id']?>&ch=1&section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>" type="button" title="Опустить" class="btn btn-default btn-xs down-up"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a></div>
    </td>
    <td align="center">
      <a href="downs_v_edit.php?id=<?=$a['id']?>&section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>" type="button" title="Редактировать документ" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;<a href="downs_m_delete.php?id=<?=$a['id']?>&section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>" type="button" title="Удалить документ" class="btn btn-primary btn-xs down-delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
    </td>
  </tr>
	<? endforeach ?>
</table>    
      
<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>