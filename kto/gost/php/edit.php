<!DOCTYPE html>
<html>
	<head>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>
			Администрирование
		</title>
		<script src="../../../js/jquery-2.0.3.min.js" type="text/javascript"></script>
		<script>
		var id = "2";
		pageIs = "ns"
		$.post(                              
				"edit_2.php",
				{id:id,
				page:pageIs	
				},
				// Если ответ сервера положительный, работаем дальше	
				function onAjaxSuccess1(datar){   
					document.write(datar);
					
				}
			);
		</script>
	</head>	
		<body>
		
		</body>
</html>		
		