<? include '../zamok.php';
$title = 'Документы';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>
			
            <div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <a role="button" href="downs_v_add.php" class="btn btn-warning btn-block">Добавить документ</a>
                    <hr>
                    <a role="button" href="downs_v_list.php" class="btn btn-primary btn-block">Список документов</a>
                  </div>
                </div>
            </div>     	

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
