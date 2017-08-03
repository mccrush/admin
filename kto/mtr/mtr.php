<? include '../zamok.php';
//$parent = 'Разделы сайта';
$title = 'Температурный режим';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>
				<div class="col-xs-6">
					<div class="panel panel-default">
						<div class="panel-body">
						 <form action="upload.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="exampleInputFile"><br></label>
								<input type="file" name="uploadfile" id="exampleInputFile" >
								<p class="help-block">Файл не должен превышать 2 Mb</p>
							</div>
							<hr>
							<button type="submit" class="btn btn-primary btn-block">Загрузить</button>
						</form> 
						</div>
					</div>
				</div>
                
<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
