<? include '../zamok.php';
$title = 'Новости';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

			<div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4 class="text-center">Новости</h4>
                    <hr>
                    <a role="button" href="news_v_add.php" class="btn btn-success btn-block">Добавить новость</a>
                    <hr>
                    <a role="button" href="news_v_list.php" class="btn btn-primary btn-block">Список новостей</a>
                  </div>
                </div>
            </div>

            
            <div class="clearfix"></div>

            	

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
