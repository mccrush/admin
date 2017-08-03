<? 

if (!isset($_GET['id'])) {
	exit();
} else {
	$id = $_GET['id'];
}

// Соединяемся с БД
require_once("news_db_connect.php");

// Запрос
		$query = "SELECT * FROM news WHERE id = {$id}";
		//echo "<p></p>".$query;
		$result = mysqli_query($dbcnx, $query);
		
		if(!$result)
			die(mysqli_error($dbcnx));
		
		$articles = mysqli_fetch_assoc($result);
		
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ru"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Новости</title>
        <meta name="description" content="Новости Гимназии">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
		<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=hanxollva4phpflvvnv1lje4y82fvprrkqrmpqeclw066js2"></script>
		<!--<script type="text/javascript" src="../tinymce/tinymce.min.js"></script>-->
		<script type="text/javascript">
		tinymce.init({
			selector: "textarea.editme",
			 menubar : true,
			 plugins: ["searchreplace visualblocks code fullscreen",
			 "code link", "insertdatetime media table contextmenu paste"],
			toolbar: [
				"undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link | code"
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
                    Редактирование новости
                </strong>
            </blockquote>
			  <form enctype="multipart/form-data" method="post" action="news_update.php">
				  <div class="form-group">
					<label for="title">Заголовок</label>
					<input type="text" class="form-control" name="title" placeholder="Введите заголовок новости" value="<?=$articles['title'];?>">
				  </div>
				  <div class="form-group">
					<label for="description">Краткое описание</label>
					<textarea class="form-control" rows="3" name="description"><?=$articles['description'];?></textarea>
				  </div>
				  <div class="form-group">
					<label for="text">Текст новости</label>
					<textarea class="form-control editme" rows="14" name="text" ><?=$articles['text'];?></textarea>
				 </div>
				<input type="hidden" name="id" value="<?=$id;?>">
				  
				  <div class="row">
					<div class="col-md-6" style="text-align: center;">
						<a type="button" class="btn btn-default btn-block otmena" href="news_list.php">Отмена</a>
						<input type="checkbox" name="public" checked>
						<label for="public">Опубликовать новость</label>
					</div>
					
					<div class="col-md-6">
						<input type="submit" class="btn btn-success btn-block" value="Сохранить изменения" />
					</div>
				  </div>	
				  
				 
			  </form>
			  
<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
