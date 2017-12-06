<? include '../zamok.php';
$parent = 'Документы';
$title = 'Редактирование документа';
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
  $page = $_GET['page'];
  $pt = $_GET['pt'];
  $uroven = $_GET['uroven'];
  $block = $_GET['block'];
}

// Соединяемся с БД
require_once '../../../config/db_connect.php';

// Запрос
		$query = "SELECT * FROM `mc_downs` WHERE id = {$id}";
		//echo "<p></p>".$query;
		$result = mysqli_query($dbcnx, $query);
		
		if(!$result)
			die(mysqli_error($dbcnx));
		
		$articles = mysqli_fetch_assoc($result);
		
?>

			  <form enctype="multipart/form-data" method="post" action="downs_m_update.php">

					  <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="uroven">Измените уровень</label>
									<input type="text" class="form-control" name="uroven" value="<?=$uroven?>">
							  </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="block">Измените блок</label>
									<input type="text" class="form-control" name="block" value="<?=$block?>">
							  </div>
							</div>
						</div>		

					  <div class="form-group">
							<label for="description">Измените описание</label>
							<textarea class="form-control" rows="3" name="description"><?=$articles['description'];?></textarea>
					  </div>

<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="section" value="<?=$section?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="st" value="<?=$st?>">
<input type="hidden" name="pt" value="<?=$pt?>">
					  
					  <div class="row">
							<div class="col-md-6" style="text-align: center;">
								<a type="button" class="btn btn-default btn-block otmena" href="downs_v_list.php?section=<?=$section?>&st=<?=$st?>&page=<?=$page?>&pt=<?=$pt?>&uroven=<?=$uroven?>&block=<?=$block?>">Отмена</a>
							</div>
							
							<div class="col-md-6">
								<input type="submit" class="btn btn-success btn-block" value="Сохранить изменения" />
							</div>
					  </div>	
				  
				 
			  </form>
			  
<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
