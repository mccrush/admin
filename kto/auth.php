<?php session_start();
$_SESSION['auth'] = 0;
if ($_SESSION['auth'] == 1) {
	header("Location: ./index.php");
}
$title = 'Авторизация';
//$_SESSION['auth'] = 1;
?>
<? // Подключаем Хедер
require_once 'blocks/header.php'; ?>

 <div class="col-xs-4">
 </div>
 <div class="col-xs-4">
  <div class="panel panel-default">
  	<div class="panel-heading text-center"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Вход в панель</div>
  	<div class="panel-body">

			<form class="form-signin">
        
        <!-- <h4 class="form-signin-heading text-center"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Вход в панель</h4> -->
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
        <br>
        <button class="btn btn-md btn-primary btn-block" type="submit">Войти</button>
      </form>
		</div>
		<div class="panel-footer text-center">
			<button type="button" class="btn btn-link btn-xs" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Напишите на почту администратору mccrush@mail.ru">Забыли пароль?</button>
		</div>
	</div>
</div>

<div class="col-xs-4">
</div>

<? // Подключаем Футер
require_once 'blocks/footer.php'; ?>