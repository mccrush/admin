<? include '../zamok.php';
$parent = 'Разделы сайта';
$title = 'Добавить раздел сайта';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

			  <form enctype="multipart/form-data" method="post" action="sections_m_save.php">
					<div class="row">
						<div class="col-md-8">  
						  <div class="form-group">
								<label for="title">Название раздела</label>
								<input type="text" class="form-control" name="title" placeholder="Введите название раздела">
						  </div>
						</div>  

						<div class="col-md-4">	
						  <div class="form-group">
								<label for="alias">Алиас раздела</label>
								<input type="text" class="form-control" name="alias" placeholder="Введите алиас раздела">
						  </div>
						</div>
					</div>	  

				  <div class="row">
						<div class="col-md-6" style="text-align: center;">
							<a type="button" class="btn btn-default btn-block otmena" href="sections_v_list.php">Отмена</a>
						</div>
						
						<div class="col-md-6">
							<input type="submit" class="btn btn-success btn-block" value="Добавить раздел" />
						</div>
				  </div>	
			  </form>

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
