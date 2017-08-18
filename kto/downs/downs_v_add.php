<? include '../zamok.php';
$parent = 'Документы';
$title = 'Добавить документ';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

<?
// Проверка условия выбора рордительского раздела для списка
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

<form enctype="multipart/form-data" method="post" action="downs_m_save.php">
  <div class="row">

      <div class="col-md-3">  
        <div class="form-group">
          <div class="dropdown">
            <label for="dropdownMenu1">Укажите раздел</label><br>
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
            <label for="dropdownMenu2">Укажите страницу</label><br>
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
      <div class="col-md-3">
        <div class="form-group">
          <div class="dropdown">
            <label for="dropdownMenu3">Укажите уровень</label><br>
            <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?=mb_substr($uroven, 0, 12, 'UTF-8')?>
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">                          
              <? //if (isset($uroven)) {showLists($dbcnx, 'uroven', $section, $st, $page, $pt, '');} ?>
              <? showLists($dbcnx, 'uroven', $section, $st, $page, $pt, '') ?>
            </ul>
            <input type="text" class="form-control input-sm" name="uroven" placeholder="Или введите новый" value="<?=$uroven?>">
          </div>       
        </div>
      </div>

      <div class="col-md-3">  
        <div class="form-group">
         <div class="dropdown">
          <label for="dropdownMenu4">Укажите блок</label><br>
          <button class="btn btn-default dropdown-toggle btn-block" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?=mb_substr($block, 0, 12, 'UTF-8')?>
          <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu4"> 
            <? if (isset($uroven)) {showLists($dbcnx, 'block', $section, $st, $page, $pt, $uroven);} ?>
          </ul>
          <input type="text" class="form-control input-sm" name="block" placeholder="Или введите новый" value="<?=$block?>">
        </div>       
      </div>
    </div>
  <!-- Конец строки выбора уровня и блока -->

  </div>

  <input type="hidden" name="section" value="<?=$section?>">
  <input type="hidden" name="page" value="<?=$page?>">
  <input type="hidden" name="st" value="<?=$st?>">
  <input type="hidden" name="pt" value="<?=$pt?>">

  <div class="row">
    <div class="col-md-8">
      <div class="form-group">
        <label for="description">Описание документа (<span class="text-danger">обязательное поле</span>)</label>
        <textarea class="form-control" rows="3" name="description" placeholder="Добавьте описание (название) документа" autofocus></textarea>
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


  <div class="row">
    <div class="col-md-6" style="text-align: center;">
      <a type="button" class="btn btn-default btn-block otmena" href="downs_v_list.php?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>">Отмена</a>
    </div>

    <div class="col-md-6">
      <input type="submit" class="btn btn-success btn-block" value="Зарузить документ">
    </div>
  </div>

</form>

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
