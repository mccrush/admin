<? include '../zamok.php';
//$parent = 'Разделы сайта';
$title = 'Температурный режим';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

<? if(isset($_GET['link'])) {
    unlink("../../../s1/down/mtr/".$_GET['link']);
}
?>   

<h4>Список загруженных файлов. <span class="text-danger">Удалите те, что уже не актуальны!</span></h4>
<hr>

<?
$dir = '../../../s1/down/mtr/';
$files = scandir($dir);
echo '<ol>';
foreach ($files as $value)
{
if ($value !='.' and $value !='..' ) 
{echo '<li><strong>Файл:</strong> '.$value.' <strong> | Дата загрузки:</strong> '.substr($value, 9, 2).'.'.substr($value, 7, 2).'.'.substr($value, 3, 4).'  | <a href="mtr_list.php?link='. $value.'">Удалить</a></li><br>';}
else{}
}
echo '</ol>';
?>

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
