<?php $to= $row['mail'].", Сергей Николаев <mccrush@mail.ru>";
/* тема/subject */
$subject = "Ответ на вопрос: Гимназия 131";

/* сообщение */
$message = "
<table width='550' border='0' cellpadding='0' cellspacing='0' style='text-align: left; padding: 0px; box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.37); margin: 0 auto; font-family: Arial, Tahoma, Verdana; color: #656565; line-height: 1.2em;'>
	<tr>
		<td style='background: #9C27B0; color: #fff; font-size: 20px; text-shadow: 1px 1px 1px rgba(0,0,0,0.5); padding: 15px;'>
			<strong>ВОПРОС-ОТВЕТ</strong>
		</td>
	</tr>
	<tr>
		<td style='font-size: 14px; padding: 15px;'>
		<strong>Добрый день, ".$row['name']."!</strong> 
		</td>
	</tr>
	<tr>
		<td style='font-size: 14px; padding: 15px;'>
		Вы получили ответ на вопрос, который задавали на сайте 131 Гимназии (sch131.ru)
		</td>
	</tr>
	<tr>
		<td style='font-size: 14px; padding: 15px; border-bottom: 1px dotted #9E9E9E;'>
		Что бы прочитать ответ, перейдите в раздел \"ВОПРОС-ОТВЕТ\" <br>
		<a href='http://sch131.ru/m7/' title='Перейти в раздел \"ВОПРОС-ОТВЕТ\"' target='_blank'>перейти</a>
		</td>
	</tr>
	<tr>
		<td style='font-size: 14px; padding: 15px; '>
		Письмо отправленно автоматически.<br>
		<strong>Не отвечайте на него</strong>.<br>
		Если есть вопросы по работе сайта, пишите на почту администратору<br>
		mccrush@mail.ru 
		</td>
	</tr>
	<tr>
		<td style='background: #9C27B0; color: #fff; font-size: 14px; text-shadow: 1px 1px 1px rgba(0,0,0,0.5); padding: 15px; text-align: center;'>
			© МБОУ 'Гимназия №131' г.Барнаул, 2017
		</td>
	</tr>
</table>
";

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= 'From: sch131.ru <admin@sch131.ru>' . "\r\n";
/* и теперь отправим из */
$st = mail($to, $subject, $message, $headers);

if($st) {echo "0";}
?>