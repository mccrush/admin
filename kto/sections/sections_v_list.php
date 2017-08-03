<? include '../zamok.php';
$parent = 'Разделы сайта';
$title = 'Список разделов сайта';
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
require_once("../../../config/db_connect.php");

// Запрос
        $query = "SELECT * FROM `mc_sections` ORDER BY {$order} {$sort}";
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
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <label for="adPage">Вы можете</label><br>
                    <a role="button" href="../pages/pages_v_add.php" class="btn btn-default btn-block" id="adPage">Добавить страницу</a>
    			</div>
                <div class="col-md-3">
                    <label for="butRaz">Или</label><br>
                    <a role="button" href="sections_v_add.php" class="btn btn-success btn-block" id="butRaz">Добавить раздел</a>
                </div>
                
            </div>
            
            <p><br>Сортировать по: <a href="sections_v_list.php?order=title&sort=DESC" class="btn btn-default btn-xs" title="Алфавит убывает"><span class="glyphicon glyphicon-font" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span></a>&nbsp;<a href="sections_v_list.php?order=title&sort=ASC" class="btn btn-default btn-xs" title="Алфавит возрастает"><span class="glyphicon glyphicon-font" aria-hidden="true"></span>&nbsp;<span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span></a></p>
			<hr>
			
			<table class='table table-bordered'>
                <tr align='center'>
                    <td width='5%'><strong>Id</strong></td>
                    <td width='10%'><strong>Дата</strong></td>
                    <td width='70%' style='vertical-align:top'><strong>Заголовк</strong></td>
                    <td width='5%'><strong>Алиас</strong></td>
                    <td width='10%'><strong>Действие</strong></td>
                </tr>
                
                <?php foreach ($articles as $a):?>
                <tr>
                    <td align="center"><?=$a['id']?></td>
                    <td><?=$a['date_create']?></td>
                    <td><?=$a['title']?></td>
                    <td align="center"><?=$a['alias']?></td>
                    <td align="center">
                        <a href="sections_v_edit.php?id=<?=$a['id']?>" type="button" title="Редактировать раздел" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp;<a href="sections_m_delete.php?id=<?=$a['id']?>" type="button" title="Удалить раздел" class="btn btn-primary btn-xs section-delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    </td>
                </tr>
                <?php endforeach ?>
            </table>
			
<? // Подключаем Футер
require_once '../blocks/footer.php'; ?>