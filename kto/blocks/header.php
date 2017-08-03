<!Doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ru"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?=$title?></title>
        <meta name="description" content="<?=$title?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>body {padding-top: 50px;padding-bottom: 20px;}</style>
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
      <a class="navbar-brand navbar-right" href="/" target="_blank" title="Открыть сайт в новой вкладке"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> sch131.ru</a>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <!--<div id="navbar" class="navbar-collapse collapse">

        </div>/.navbar-collapse -->
      </div>
    </nav>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<br>
				<blockquote>
                    <strong>
                        <a href="/kto/kto/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>&nbsp;&nbsp;>&nbsp;
                        <? if (isset($parent)) {echo '<a href="index.php">'.$parent.'</a> &nbsp;>&nbsp; ';}?>
                        <?=$title?>
                    </strong>
                </blockquote>