<?php 

require('config.php');
require('database.php');
$link = db_connect();

require('models/films.php');
require('functions/login-functions.php');

if (array_key_exists('newFilm', $_POST)) {

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
		$result = film_new($link, $_POST['title'], $_POST['genre'], $_POST['year'], $_POST['description']);
	}

	if ($result) {
		$resultSuccess = "Фильм был успешно добавлен!";
	} else {
		$resultError = "Что-то пошло не так. Добавьте фильм еще раз!";
	}
}

include('views/head.tpl.php');
include('views/notifications.tpl.php');
include('views/new-film.tpl.php');
include('views/footer.tpl.php');

?>