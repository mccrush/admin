<? include '../zamok.php';
$parent = 'Вакантные места';
$title = 'Добавить класс';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

			  <form enctype="multipart/form-data" method="post" action="vacant_m_save.php">
					<div class="row">
						<div class="col-md-3">  
						  <div class="form-group">
								<label for="title">Класс</label>
								<input type="text" class="form-control" name="class" placeholder="Введите название класса">
						  </div>
						</div>  

						<div class="col-md-7">	
						  <div class="form-group">
								<label for="alias">Программа</label>
								<input type="text" class="form-control" name="text" placeholder="Введите название программы">
						  </div>
						</div>

						<div class="col-md-2">  
						  <div class="form-group">
								<label for="title">Места</label>
								<input type="number" class="form-control" name="number" value="0">
						  </div>
						</div>  
					</div>	  

				  <div class="row">
						<div class="col-md-6" style="text-align: center;">
							<a type="button" class="btn btn-default btn-block" href="vacant_v_list.php">Отмена</a>
						</div>
						
						<div class="col-md-6">
							<input type="submit" class="btn btn-success btn-block" value="Добавить класс" />
						</div>
				  </div>	
			  </form>

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
