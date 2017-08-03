<? include '../zamok.php';
$parent = 'Новости';
$title = 'Добавление новости';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>


			  <!--<p class="bg-danger" style="padding: 10px;">Внимание! Система добавления новостей работает в тестовом режиме!</p>-->
			  <form enctype="multipart/form-data" method="post" action="news_m_save.php">
				  <div class="form-group">
					<label for="title">Заголовок</label>
					<input type="text" class="form-control" name="title" placeholder="Введите заголовок новости">
				  </div>
				  <div class="form-group">
					<label for="description">Краткое описание</label>
					<textarea class="form-control" rows="3" name="description"></textarea>
				  </div>
				  <div class="form-group">
					<label for="text">Текст новости</label>
					<textarea class="form-control editme" rows="14" name="text" ></textarea>
				 </div>
				  
				 <div class="row">
					<div class="col-md-6">  
					  <div class="form-group">
						<label for="userfile" class="text-danger">Добавить главное фото (обязательно)</label>
						<input name="userfile" type="file" />
					  </div>
					</div>
					<div class="col-md-6"> 
					  <div class="form-group">
						<label for="userfile_all[]">Добавить остальные</label>
						<input type="file" name="userfile_all[]" multiple="true" />
					  </div>
					</div>
				</div>	  

				  <div class="row">
					<div class="col-md-6" style="text-align: center;">
						<a type="button" class="btn btn-default btn-block otmena" href="news_v_list.php">Отмена</a>
						<input type="checkbox" name="status" checked>
						<label for="status">Сразу опубликовать новость</label>
					</div>
					
					<div class="col-md-6">
						<input type="submit" class="btn btn-success btn-block" value="Добавить новость" />
					</div>
				  </div>	
				  
			  </form>

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
