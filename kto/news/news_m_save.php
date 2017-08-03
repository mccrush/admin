<?

if($_FILES['userfile_all']['name'][0] != '') {
	$imgs = count($_FILES['userfile_all']['name']);
} else {
	$imgs = 0;
}


// Присваиваем переменным все текстоввые значения из пришедших данных
$title = trim($_POST['title']);
$description = trim($_POST['description']);
$text = htmlspecialchars(trim($_POST['text']));
$date_create = DATE('Y-m-d');
$status = $_POST['status'];

//echo "<br>$title, $description, $text, $date_create, $date_create, Администратор, 0, $imgs<br>";

//$imgs = count($_FILES['userfile_all']['name']);
// Соединяемся с БД
require_once("../../../config/db_connect.php");

$query = sprintf("INSERT INTO `mc_news` (`title`, `description`, `text`, `date_create`, `date_edit`, `author`, `views`, `imgs`, `status`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s')", $title, $description, $text, $date_create, $date_create, 'Администратор', 0, $imgs, $status);

//echo $query;

$result = mysqli_query($dbcnx, $query);



// функция очистки папки temp
function clear($date) {
if (file_exists('../../../m2/n/img/2017/'.$date.'/temp/'))
foreach (glob('../../../m2/n/img/2017/'.$date.'/temp/*') as $file)
unlink($file);}

function imgUpload($tmp_name, $name, $nn, $date){
	//$date = date("dmy");
	//echo "Текущая дата: $date<br>tmp_name = $tmp_name";
	// Перемемщаем файл в нужную нам директорию
	if(move_uploaded_file($tmp_name, "../../../m2/n/img/2017/$date/temp/$name")){
		$f = "../../../m2/n/img/2017/$date/temp/$name";
		//echo "f = $f<br>";
	} else {
		echo "Ошибка при загрузке в папку temp<br>";
		exit();
	}

	// Вытаскиваем расширение 
	$ext = strtolower(substr($name, strpos($name,'.'), strlen($name)-1)); 
	//echo $f."<br>Typ img ".$ext."<br>";

	switch ($ext) {
		case ".jpg":
			$src = imagecreatefromjpeg($f); 
			break;
		case ".jpeg":
			$src = imagecreatefromjpeg($f); 
			break;
		case ".png":
			$src = imagecreatefrompng($f); 
			break;
		case ".gif":
			$src = imagecreatefromgif($f); 
			break;	
	}
	
	if(!$src) {
		echo "<br>Неудалось создать картинку из загруженного файла<br>";
		exit();
	}
	 // Получаем ширину и высоту нашей загруженной
	if(!imagesx($src)) {
		echo "<br>Невозможно вычислить ширину<br>";
	} else {$w_src = imagesx($src);}
	//$w_src = imagesx($src); 
	$h_src = imagesy($src);

	// Создаем картинку нужных нам размеров 250 на 141 px
	$newImgSmol = imagecreatetruecolor(250,141);

	if($w_src/$h_src > 1.8) {

		$k = round(141 / $h_src, 2);
		$k2 = round(960 / $w_src, 2);
		$w2_src = $w_src * $k;
		$h2_src = $h_src * $k2;
		$x1_src = (($w2_src - 250) / 2) / $k;
		$x2_src = $w_src - $x1_src * 2;
		//echo "$y1_src = ".$y1_src."<br>";
		
		// вставили в маленькую
		imagecopyresampled($newImgSmol, $src, 0, 0, $x1_src, 0, 250, 141, $x2_src, $h_src);
		
		// создаем новое большое изображение 
		$newImg = imagecreatetruecolor(960, $h2_src); 
		// вставим в него исходное
		imagecopyresampled($newImg, $src, 0, 0, 0, 0, 960, $h2_src, $w_src, $h_src);
		
	} else {

		$k = round(250 / $w_src, 2);
		$k2 = round(640 / $h_src, 2);
		$w2_src = $w_src * $k2;
		$y2_src = round(141 / $k);

		imagecopyresampled($newImgSmol, $src, 0, 0, 0, 0, 250, 141, $w_src, $y2_src);
		
		// создаем новое большое изображение 
		$newImg = imagecreatetruecolor($w2_src, 640); 
		// вставим в него исходное
		imagecopyresampled($newImg, $src, 0, 0, 0, 0, $w2_src, 640, $w_src, $h_src);
	}
		
		// сохраняем большую
		imagejpeg($newImg,"../../../m2/n/img/2017/$date/big/0".$nn.".jpg",100);
		
		// сохраняем маленькую
		imagejpeg($newImgSmol,"../../../m2/n/img/2017/$date/smol/0".$nn.".jpg",100);
		
		// Очищаем память
		imagedestroy($newImg);
		imagedestroy($newImgSmol);
}
	
$res = mysqli_query($dbcnx, "SELECT * FROM `mc_news` order by id DESC LIMIT 1");
$ost = mysqli_fetch_array($res);
$date = date("dmy").$ost['id'];
//echo "<br> Новая дата = ".$date;
if (!file_exists("../../../m2/n/img/2017/$date")) {
    if(mkdir("../../../m2/n/img/2017/$date", 0755)) {
		//echo "<br>Директория http://sch131.ru/m2/n/img/2017/$date создана<br>";
	};
}
if (!file_exists("../../../m2/n/img/2017/$date/temp")) {
    mkdir("../../../m2/n/img/2017/$date/temp", 0755);
}
if (!file_exists("../../../m2/n/img/2017/$date/big")) {
    mkdir("../../../m2/n/img/2017/$date/big", 0755);
}
if (!file_exists("../../../m2/n/img/2017/$date/smol")) {
    mkdir("../../../m2/n/img/2017/$date/smol", 0755);
}

/*echo "<pre>";
print_r($_FILES);
echo "</pre>";*/

$tmp_name = $_FILES['userfile']['tmp_name'];
//echo "Код ошибки при загрузке ".$_FILES['userfile']['error']."<br>";
//echo "Размер загруж файла в байтах ".$_FILES['userfile']['size']."<br>";
//echo "tmp_name = ".$tmp_name."<br>";
$name = basename($_FILES["userfile"]["name"]);
//echo "name = ".$name."<br>";
imgUpload($tmp_name, $name, 1, $date);

// Подготовка данных для множественной загрузки
//echo "<br>FILES = ".$_FILES['userfile_all']['name'][0];
$imgs = count($_FILES['userfile_all']['name']);
//echo "<br>imgs = $imgs<br>";
if($_FILES['userfile_all']['name'][0] != '') {
	for ($i = 0; $i < $imgs; $i++) {
		$tmp_name = $_FILES['userfile_all']['tmp_name'][$i];
		//echo "<br>Temp name $i = $tmp_name <br>";
		$name = basename($_FILES['userfile_all']['name'][$i]);
		//echo "Name $i = $name <br>";
		imgUpload($tmp_name, $name, $i+2, $date);
	}
} else {
	$imgs = 0;
}

// Вызываем функцию очистки папки темп
clear($date);


// если все ОК, то перенаправляем на старницу списка всех новостей
if($result) {
	//echo "Данные успешно добавлены<br>";
	mysqli_close($dbcnx);
	header('Location: news_v_list.php');
} else {
	echo "<br>Данные НЕ отправлены. Ищи ошибку<br>";
}



	
?>