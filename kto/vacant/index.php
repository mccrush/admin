<? include '../zamok.php';
$title = 'Вакантные места';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>
			
            <div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <a role="button" href="vacant_v_add.php" class="btn btn-success btn-block">Добавить класс</a>
                    <hr>
                    <a role="button" href="vacant_v_list.php" class="btn btn-primary btn-block">Список классов</a>
                  </div>
                </div>
            </div>     	

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
