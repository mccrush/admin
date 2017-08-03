<? include '../zamok.php';
$title = 'Разделы сайта';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>
			
            <div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <a role="button" href="sections_v_add.php" class="btn btn-success btn-block">Добавить раздел</a>
                    <hr>
                    <a role="button" href="sections_v_list.php" class="btn btn-primary btn-block">Список разделов</a>
                  </div>
                </div>
            </div>      	

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
