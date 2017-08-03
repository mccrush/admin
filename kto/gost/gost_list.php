<? include '../zamok.php';
$title = 'Вопрос - ответ';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; ?>
			
<?
// Соединяемся с БД
require_once '../../../config/db_connect.php';					

			$result = mysqli_query($dbcnx, "SELECT id, name, mail, data, text, stat, answer, otvetil, DATE_FORMAT(data,'%d.%m.%Y') as data_reg FROM sch_gostkniga ORDER BY data DESC");
			//if($result) {echo "Есть результат!";} else {echo "Нет резудьтата :(";}
			
			echo "<table class='table table-bordered'>
			<tr align='center'>
			<td width='10%' style='vertical-align:top'><strong>Данные</strong></td>
			<td width='40%'><strong>Сообщение</strong></td>
			<td width='35%'><strong>Ответ</strong></td>
			<td width='15%'><strong>Действие</strong></td>
			</tr>";
			while($row = mysqli_fetch_assoc($result)) {
			$row['stat'] == 1 ? $statIm = "glyphicon glyphicon-ok"  : $statIm = "glyphicon glyphicon-flag";
			$row['stat'] == 1 ? $statBg = "btn-success"  : $statBg = "btn-warning";
			$row['stat'] == 1 ? $statText = "Снять с публикации"  : $statText = "Опубликовать";
				printf("<tr>
				<td valign='top' align='left' style='font-size: 13px;'>%s<br>%s<br>%s</td>
				<td valign='top'><span id='%s'>%s</span></td>
				<td valign='top'><span class='%s'>%s</span><hr><span class='otv%s'>%s</span></td>
				<td valign='top' align='center'>
					<button type='button' alt='%s' title='Изменить' name='' class='btn btn-default btn-xs editMess' data-toggle='modal' data-target='#myModal'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' alt='%s' title='%s' name='%s' class='btn %s btn-xs editStat'><span class='%s' aria-hidden='true'></span></button>&nbsp;<button type='button' alt='' title='Удалить вопрос' name='%s' class='btn btn-primary btn-xs dropMess'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></td></tr>",$row['data_reg'],$row['name'],$row['mail'],$row['id'],$row['text'],$row['id'],$row['answer'],$row['id'],$row['otvetil'],$row['id'],$row['stat'],$statText,$row['id'],$statBg,$statIm,$row['id'],$row['id']);
			}
			echo "</table>";
?>
        </div>  
      </div>

    </div> <!-- /container -->
	
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <!--<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Modal title</h4>
		  </div>-->
		  <div class="modal-body">
			<h4>Вопрос</h4>
			<textarea class="form-control" id="quest" rows="3"></textarea>
			<hr>
			<h4>Ответ</h4>
			<textarea class="form-control" id="answer"  rows="3"></textarea>
			<hr>
			<h4>Кто ответил</h4>
			<input type="text" class="form-control" id="otvetil" size="40">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
			<button type="button" class="btn btn-primary save-quest">Сохранить</button>
		  </div>

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>
