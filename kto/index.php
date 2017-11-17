<? session_start();
unset($_SESSION['auth']); 
include 'zamok.php';
$title = 'Панель администратора';
?>

<? // Подключаем Хедер
require_once 'blocks/header.php'; ?>

			

            <div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4 class="text-center"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Разделы сайта</h4>
                    <hr>
                    <a role="button" href="sections/sections_v_add.php" class="btn btn-success btn-block">Добавить раздел</a>
                    <hr>
                    <a role="button" href="sections/sections_v_list.php" class="btn btn-primary btn-block">Список разделов</a>
                  </div>
                </div>
            </div>

            <div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4 class="text-center"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Страницы сайта</h4>
                    <hr>
                    <a role="button" href="pages/pages_v_add.php" class="btn btn-success btn-block">Добавить страницу</a>
                    <hr>
                    <a role="button" href="pages/pages_v_list.php" class="btn btn-primary btn-block">Список страниц</a>
                  </div>
                </div>
            </div>

            <div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4 class="text-center"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Новости</h4>
                    <hr>
                    <a role="button" href="news/news_v_add.php" class="btn btn-success btn-block">Добавить новость</a>
                    <hr>
                    <a role="button" href="news/news_v_list.php" class="btn btn-primary btn-block">Список новостей</a>
                  </div>
                </div>
            </div>

            <div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4 class="text-center"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Документы</h4>
                    <hr>
                    <a role="button" href="downs/downs_v_add.php" class="btn btn-warning btn-block">Загрузить документ</a>
                    <hr>
                    <a role="button" href="downs/downs_v_list.php" class="btn btn-primary btn-block">Список документов</a>
                  </div>
                </div>
            </div>

            <div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4 class="text-center"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Вакантные места</h4>
                    <hr>
                    <a role="button" href="vacant/vacant_v_add.php" class="btn btn-success btn-block">Добавить класс</a>
                    <hr>
                    <a role="button" href="vacant/vacant_v_list.php" class="btn btn-primary btn-block">Список классов</a>
                  </div>
                </div>
            </div>

            <div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4 class="text-center"><span class="glyphicon glyphicon-fire" aria-hidden="true"></span> Температур. режим</h4>
                    <hr>
                    <a role="button" href="mtr/mtr.php" class="btn btn-success btn-block">Добавить файл</a>
                    <hr>
                    <a role="button" href="mtr/mtr_list.php" class="btn btn-primary btn-block">Список файлов</a>
                  </div>
                </div>
            </div>

            <div class="col-xs-4">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4 class="text-center"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Вопрос - ответ</h4>
                    <hr>
                    <a role="button" href="gost/gost_list.php" class="btn btn-primary btn-block">Перейти</a>
                  </div>
                </div>
            </div>
            <div class="clearfix"></div>

            	

<? // Подключаем Футер
require_once 'blocks/footer.php'; ?>
