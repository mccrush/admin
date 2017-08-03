<? include '../zamok.php';
$parent = 'Новости';
$title = 'Список новостей';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>

<? 

if (!isset($_GET['order'])) {
    $order = 'id';
    $sort = 'DESC';
} else {
    $order = $_GET['order'];
    $sort = $_GET['sort'];
}

// Соединяемся с БД
require_once '../../../config/db_connect.php';

// Запрос
        $query = "SELECT * FROM `mc_news` ORDER BY {$order} {$sort}";
        $result = mysqli_query($dbcnx, $query);
        
        if(!$result)
            die(mysqli_error($dbcnx));
        
        //Извлечение из БД
        $n = mysqli_num_rows($result);
        $articles = array();
        
        for ($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
?>

			<label for="adddoc">Вы так же можете</label><br>
            <a role="button" href="news_v_add.php" class="btn btn-success btn-large" name="adddoc">Добавить новость</a>
			<!--<p class="bg-danger" style="padding: 10px;">Внимание! Система добавления новостей работает в тестовом режиме!</p>-->
			<p><br>Сортировать по: <a href="?order=date_create&sort=DESC" class="btn btn-default btn-xs" title="Дата убывает"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span></a>&nbsp;<a href="?order=date_create&sort=ASC" class="btn btn-default btn-xs" title="Дата возрастает"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?order=title&sort=DESC" class="btn btn-default btn-xs" title="Алфавит убывает"><span class="glyphicon glyphicon-font" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span></a>&nbsp;<a href="?order=title&sort=ASC" class="btn btn-default btn-xs" title="Алфавит возрастает"><span class="glyphicon glyphicon-font" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span></a></p>
			<hr>
			

			<table class='table table-bordered'>
                <tr align='center'>
                    <td width='5%'><strong>Id</strong></td>
                    <td width='55%'><strong>Заголовок</strong></td>
                    <td width='10%'><strong>Создана</strong></td>
                    <td width='10%'><strong>Обновл.</strong></td>
                    <td width='10%'><strong>Опублик.</strong></td>
                    <td width='10%'><strong>Действие</strong></td>
                </tr>

			<?php foreach ($articles as $a):?>
			<tr>
				<td align="center"><?=$a['id']?></td>
				<td><?=$a['title']?></td>
				<td align="center"><?=substr($a['date_create'],8,2).".".substr($a['date_create'],5,2).".".substr($a['date_create'],2,2);?></td>
				<td align="center"><?=substr($a['date_edit'],8,2).".".substr($a['date_edit'],5,2).".".substr($a['date_edit'],2,2);?></td>
				<!-- <td align="center"><? if($a['public']) {echo "<span class='text-success'>Да</span>";} else {echo "<span class='text-danger'>Нет</span>";} ?></td> -->
				<td align="center"><?= ($a['status'] == 'on') ? '<a href="news_m_status.php?id='.$a['id'].' type="button" title="Опубликована" class="btn btn-success btn-xs news-status">Да <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>' : '<a href="news_m_status.php?id='.$a['id'].' type="button" title="Не опубликована" class="btn btn-warning btn-xs news-status">Не <span class="glyphicon glyphicon-flag" aria-hidden="true"></span></a>'?></td>

				<td align="center">
	               <a href="news_v_edit.php?id=<?=$a['id']?>" type="button" title="Редактировать новость" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;<a href="news_m_delete.php?id=<?=$a['id']?>" type="button" title="Удалить новость" class="btn btn-primary btn-xs news-delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
	            </td>
			</tr>
			<?php endforeach ?>
			</table>
			
<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>