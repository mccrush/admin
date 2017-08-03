<?php include '../zamok.php';
ini_set('display_errors', 1);
error_reporting(E_ALL); 
require_once '../../../blocks/param/config.php'; //Подключаемся к БД

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Температурный режим</title>
        <meta name="description" content="Температурный режим">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../css/main.css">

        <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
		<!-- Place inside the <head> of your HTML -->
		<script type="text/javascript" src="../tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
		tinymce.init({
			selector: "textarea.editme",
			 menubar : false,
			 plugins: "code link",
			toolbar: [
        "undo redo | styleselect | bold italic | link | code"
    ]
		 });
		</script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
      <a class="navbar-brand navbar-right" href="http://sch131.ru" target="_blank" title="Открыть сайт в новой вкладке"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> sch131.ru</a>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <!--<ul class="nav navbar-nav">
						<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
						<li class="<?php if($nav == "index") echo "active"; ?>"><a href="add.php">Добавить</a></li>
						
						<li class="<?php if($nav == "zakaz") echo "active"; ?>"><a href="list.php">Список новостей</a></li>
						<li class="<?php if($nav == "report") echo "active"; ?>"><a href="report.php">Изменения <span class="label label-info opove"><?=$opove;?></span></a></li>
						<li class="<?php if($nav == "zakaz") echo "active"; ?>"><a href="exit.php">Выйти</a></li>
			</ul>-->
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
   
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<br>
			<blockquote>
                <strong>
                    <a href="/kto/kto/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a> &nbsp;>&nbsp; 
                    Температурный режим
                </strong>
            </blockquote>
			
			<?php

	// Каталог, в который мы будем принимать файл:
$uploaddir = '../../../s1/down/mtr/';
$uploadfile = $uploaddir.basename("mtr".date("Ymd").".docx");
//$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
$name_in = "mtr".date("Ymd").".docx";
// Копируем файл из каталога для временного хранения файлов:
if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile))
{
$result = mysqli_query($dbcnx,"INSERT INTO mtr (`name`, `date`) VALUES ('{$name_in}', NOW())");
echo "<h4>Файл успешно загружен на сервер</h4>";
}
else { echo "<h4>Ошибка! Не удалось загрузить файл на сервер!</h4> ".$_FILES['uploadfile']['error']; exit; }

// Выводим информацию о загруженном файле:
echo "<h5>Информация о загруженном на сервер файле: </h5>";
echo "<p><b>Оригинальное имя загруженного файла: ".$_FILES['uploadfile']['name']."</b></p>";
//echo "<p><b>Mime-тип загруженного файла: ".$_FILES['uploadfile']['type']."</b></p>";
echo "<p><b>Размер загруженного файла в байтах: ".$_FILES['uploadfile']['size']."</b></p>";
//echo "<p><b>Временное имя файла: ".$_FILES['uploadfile']['tmp_name']."</b></p>";
echo '<a role="button" href="../index.php" class="btn btn-primary">Вернуться на главную</a>';				
			
?>

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
