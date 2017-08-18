<?
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Присваиваем переменным все текстоввые значения из пришедших данных
$description = trim($_POST['description']);
$section = trim($_POST['section']);
$page = trim($_POST['page']);
$st = trim($_POST['st']);
$pt = trim($_POST['pt']);

// Массив допустимых расширений
$arrayExtensions = array('.doc', '.docx', '.xls', '.xlsx', '.pdf', '.rtf', '.rar', '.zip', '.jpg', '.jpeg', '.png', '.gif', '.ppt', '.pptx', '.odt', '.ods', '.odp');

// Проверяем на пустоту, максимальный размер и расширение
if(!empty($_FILES['uploadfile']['tmp_name'])) {
    if(in_array(strrchr($_FILES['uploadfile']['name'], "."), $arrayExtensions)) {
        if($_FILES['uploadfile']['size'] > 30000000) {
            echo '<p>Размер загружаемого файла превышает <strong>30 Мб</strong><br>Разбейте файл на меньшие по объему и загрузите по отдельности<p>';
            echo '<p><a href="downs_v_add.php?section='.$section.'&st='.$st.'&page='.$page.'&pt='.$pt.'" title="Вернуться на страницу загрузки" target="_self">Вернуться на страницу загрузки</a></p>';
            exit;
        }
    } else {
        echo '<p>Тип загружаемого файла не соответствует <strong>допустимому расширению</strong>:<br>doc, docx, xls, xlsx, pdf, rtf, rar, zip, jpg, jpeg, png, gif, ppt, pptx, odt, ods, odp</p><p>А вы пытаетесь загрузить тип: <strong>'.strrchr($_FILES['uploadfile']['name'], ".").'</strong></p>';
        echo '<p><a href="downs_v_add.php?section='.$section.'&st='.$st.'&page='.$page.'&pt='.$pt.'" title="Вернуться на страницу загрузки" target="_self">Вернуться на страницу загрузки</a></p>';
        exit;
    }
} else {
    echo '<p><strong>Файл НЕ загружен!</strong> Возможные ошибки:<br>
    Вы забыли указать путь к файлу;<br>Пытаетесь загрузить недопустимый тип файла;<br>
    Размер загружаемого файла > 30 Мб.<br>
    <strong>Вернитесь и проверьте!</strong></p>';
    echo '<p><a href="downs_v_add.php?section='.$section.'&st='.$st.'&page='.$page.'&pt='.$pt.'" title="Вернуться на страницу загрузки" target="_self">Вернуться на страницу загрузки</a></p>';
    exit;
}

// Сохраняем размер файла в Мб
//echo $_FILES['uploadfile']['size'];
//$fileSize = round(($_FILES['uploadfile']['size'] / 1024), 2);
$bytes = $_FILES['uploadfile']['size'];
if ($bytes >= 1048576) {
  $fileSize = round(($bytes / 1048576), 2)." MB";
} elseif ($bytes >= 1024) {
  $fileSize = round(($bytes / 1024), 0)." KB";
} else {
  $fileSize = $bytes." B";
}

// Путь к папке в которую будем сохранять сам файл:
$uploaddir = '../../../down/'.$section.'/'.$page.'/';
//echo "Путь для загрузки ".$uploaddir."<br>";

// Если такой папки еще нет, то создаем ее
if (!file_exists($uploaddir)) {
    mkdir($uploaddir, 0755, true);
}

// Формируем имя файла
// 1. Сохраняем расширение в переменную
$ext = '.'.pathinfo($_FILES['uploadfile']['name'])['extension'];
//echo "Расширение ".$ext."<br>";
// Это массив для замены кирилицы на транслит
$tr = array(
        "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
        "Д"=>"d","Е"=>"e","Ё"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
        "Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
        "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
        "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
        "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
        "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 
        " -"=> "", ","=> "", " "=> "_", "."=> "", "/"=> "_", 
        "-"=> ""
    );
// 2. Сохраняем в переменную имя самого файла, без пути
$file_name = basename($_FILES['uploadfile']['name']);
//echo "Имя файла с компьютера ".$file_name."<br>";

// 3. Переводим имя в транслит
$file_name = strtr($file_name, $tr);
//echo "Имя файла в транслите ".$file_name."<br>";

// 4. Берем первые 20 символов
$file_name = substr($file_name, 0, 20);
//echo "Имя файла 20 символов ".$file_name."<br>";

// 5. Составляем уникальное имя
// Соединяемся с БД, вытаскиваем последнее ID
require_once '../../../config/db_connect.php';
$res_id = mysqli_query($dbcnx, "SELECT * FROM `mc_downs` order by id DESC LIMIT 1");
$ost_id = mysqli_fetch_array($res_id);
$file_name = date("ym").$ost_id['id'].'_'.$file_name;
//echo "Готовое имя файла ".$file_name."<br>";
//exit;
// 6. Перемещаем файл в нужную нам директорию
if (copy($_FILES['uploadfile']['tmp_name'], $uploaddir.$file_name.$ext)) {
	//echo "<br>"."Файл успешно загружен, можно проверить <br>";



    $query = sprintf("INSERT INTO `mc_downs` (`description`, `ext`, `file_name`, `section`, `page`, `position`, `date_create`, `file_size`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $description, $ext, $file_name, $section, $page, 1,  date("Y-m-d"), $fileSize);

    //echo $query;

    $result = mysqli_query($dbcnx, $query);


    // если все ОК, то перенаправляем на старницу списка всех документов
    if($result) {
        //echo "Данные успешно добавлены<br>";
        mysqli_close($dbcnx);
        header('Location: downs_v_list.php?section='.$section.'&st='.$st.'&page='.$page.'&pt='.$pt);
    } else {
        echo "<br>Данные НЕ отправлены. Ищи ошибку<br>";
    }





} else { 
	echo "<h4>Ошибка! Не удалось загрузить файл на сервер!</h4> Код ошибки:".$_FILES['uploadfile']['error']; exit; 
}

?>