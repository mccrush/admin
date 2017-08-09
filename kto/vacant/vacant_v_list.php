<? include '../zamok.php';
$parent = 'Вакантные места';
$title = 'Список мест';
?>

<? // Подключаем Хедер
require_once '../blocks/header.php'; 

// Соединяемся с БД
require_once '../../../config/db_connect.php'; 

function showTableVacant($dbcnx) {
    $query = "SELECT * FROM `mc_vacant` ORDER BY `class` ASC";
    $result = mysqli_query($dbcnx, $query);
    if (!$result) {
      die(mysqli_error($dbcnx));
    }
    
    $n = mysqli_num_rows($result);
    $articles = array();
    for ($i = 0; $i < $n; $i++) {
      $row = mysqli_fetch_assoc($result);
        $articles[] = $row;
    }

    foreach ($articles as $a):
      echo '<tr>
        <td align="center" style="vertical-align: middle;">'.$a['id'].'</td>
        <td align="center" style="vertical-align: middle;">'.$a['class'].'</td>
        <td style="vertical-align: middle;"><input type="text" name="'.$a['id'].'" id="id'.$a['id'].'" class="form-control input-sm title" value="'.$a['text'].'"></td>
        <td align="center" style="vertical-align: middle;"><input type="number" name="'.$a['id'].'" id="idn'.$a['id'].'" class="form-control input-sm mest" value="'.$a['number'].'"></td>
        <td align="center" style="vertical-align: middle;"><a href="vacant_m_delete.php?id='.$a['id'].'" type="button" title="Удалить класс" class="btn btn-primary btn-xs vacant-delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
        </tr>';
    endforeach;
}   
 ?>

<table class='table table-bordered'>
  <tr align='center'>
    <td width="5%" align="center"><strong>Id</strong></td>
    <td width="5%" align="center"><strong>Класс</strong></td>
    <td width="80%"><strong>Программа</strong></td>
    <td width="10%" align="center"><strong>Мест</strong></td>
    <td width="5%" align="center"><strong>Del</strong></td>
  </tr>
  <? showTableVacant($dbcnx) ?>
</table>    
            	

<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>