﻿<?php

//Подсоединение к БД
$link =	mysqli_connect('localhost', 'root', '', 'filmoteka');

if (mysqli_connect_error()) {
	die("Ошибка подключения к базе данных!");
}

$errors = array();

//Обновляем данные в БД
if (array_key_exists('update-film', $_POST)) {
	
	//Обработка ошибок
	if ($_POST['title'] == "") {
		$errors[] = "Необходимо ввести название фильма!";
	}
	if ($_POST['genre'] == "") {
		$errors[] = "Необходимо ввести жанр фильма!";
	}
	if ($_POST['year'] == "") {
		$errors[] = "Необходимо ввести год фильма!";
	}

	//Если массив пустой (ошибок нет)
	if (empty($errors)) {
		//Запись данных в БД
		$query = "UPDATE films 
			SET title = '". mysqli_real_escape_string($link, $_POST['title']) ."', 
			genre = '". mysqli_real_escape_string($link, $_POST['genre']) ."',
			year = '". mysqli_real_escape_string($link, $_POST['year']) ."' 
			WHERE id = ". mysqli_real_escape_string($link, $_GET['id']) ." LIMIT 1 ";

		if (mysqli_query($link, $query)) {
			$resultSuccess = "Фильм был успешно обновлен!";
		} else {
			$resultError = "Что-то пошло не так. Попробуйте обновить фильм еще раз!";
		}
	}
}

//Получаем данные о фильме
$query = "SELECT * FROM films WHERE id = ' " . mysqli_real_escape_string($link, $_GET['id'] ) . "' LIMIT 1";
$result = mysqli_query($link, $query);
if ( $result = mysqli_query($link, $query) ) {
	$film = mysqli_fetch_array($result);
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8" />
	<title>[Имя и фамилия] - Фильмотека</title>
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"/><![endif]-->
	<meta name="keywords" content="" />
	<meta name="description" content="" /><!-- build:cssVendor css/vendor.css -->
	<link rel="stylesheet" href="libs/normalize-css/normalize.css" />
	<link rel="stylesheet" href="libs/bootstrap-4-grid/grid.min.css" />
	<link rel="stylesheet" href="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.css" /><!-- endbuild -->
	<!-- build:cssCustom css/main.css -->
	<link rel="stylesheet" href="/css/main.css" /><!-- endbuild -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic-ext" rel="stylesheet">
	<!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->
</head>

<body class="index-page">
	<div class="container user-content section-page">

		<?php if (@$resultSuccess != '') { ?>
			<div class="notify notify--success mb-20"><?=$resultSuccess?></div>
		<?php }	?>

		<?php if (@$resultInfo != '') { ?>
			<div class="notify notify--update mb-20"><?=$resultInfo?></div>
		<?php }	?>

		<?php if (@$resultError != '') { ?>
			<div class="notify notify--error mb-20"><?=$resultError?></div>
		<?php }	?>

		<h1 class="title-1">Фильм <?=$film['title']?></h1>


		<div class="panel-holder mt-0 mb-40">
			<div class="title-3 mt-0">Редактировать фильм</div>
			<form action="edit.php?id=<?=$film['id']?>" method="POST">

				<?php
					if (!empty($errors)) {
						foreach ($errors as $key => $value) { ?>
							<div class="notify notify--error mb-20"><?=$value?></div>
				<?php }	} ?>
				<div class="form-group"><label class="label">Название фильма<input class="input" name="title" type="text" placeholder="Такси 2" value="<?=$film['title']?>" /></label></div>
				<div class="row">
					<div class="col">
						<div class="form-group"><label class="label">Жанр<input class="input" name="genre" type="text" placeholder="комедия" value="<?=$film['genre']?>" /></label></div>
					</div>
					<div class="col">
						<div class="form-group"><label class="label">Год<input class="input" name="year" type="text" placeholder="2000" value="<?=$film['year']?>" /></label></div>
					</div>
				</div><input class="button" type="submit" name="update-film" value="Обновить информацию" />
			</form>
		</div>
			<div class="mb-100">
				<a href="index.php" class="button">Вернуться на главную</a>
			</div>
	</div><!-- build:jsLibs js/libs.js -->
	<script src="libs/jquery/jquery.min.js"></script><!-- endbuild -->
	<!-- build:jsVendor js/vendor.js -->
	<script src="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIr67yxxPmnF-xb4JVokCVGgLbPtuqxiA"></script><!-- endbuild -->
	<!-- build:jsMain js/main.js -->
	<script src="js/main.js"></script><!-- endbuild -->
	<script defer="defer" src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>

</html>