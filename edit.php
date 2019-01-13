<?php 

require('config.php');
require('database.php');
$link = db_connect();

require('models/films.php');
require('functions/login-functions.php');

//Обновляем данные в БД
if ( array_key_exists('update-film', $_POST) ) {
	
	//Обработка ошибок
	if ( $_POST['title'] == '') {
		$errors[] = "Необходимо ввести название фильма!";
	}
	if ( $_POST['genre'] == '') {
		$errors[] = "Необходимо ввести жанр фильма!";
	}
	if ( $_POST['year'] == '') {
		$errors[] = "Необходимо ввести год фильма!";
	}

	//Если массив пустой (ошибок нет)
	if (empty($errors)) {

		$result = film_update($link, $_POST['title'], $_POST['genre'], $_POST['year'], $_POST['description'], $_GET['id']);

		if ($result) {
			$resultSuccess = "Фильм был успешно обновлен!";
		} else {
			$resultError = "Что-то пошло не так. Добавьте фильм еще раз!";
		}
	}
}

$film = get_film($link, $_GET['id']);

include('views/head.tpl.php');
include('views/notifications.tpl.php');
include('views/edit-film.tpl.php');
include('views/footer.tpl.php');

?>