<? include '../zamok.php';
$title = 'Страницы сайта';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>
			
            <div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <a role="button" href="pages_v_add.php" class="btn btn-success btn-block">Добавить страницу</a>
                    <hr>
                    <a role="button" href="pages_v_list.php" class="btn btn-primary btn-block">Список страниц</a>
                  </div>
                </div>
            </div>     	

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
