<?php

require('config.php');
require('database.php');
$link = db_connect();
require('models/films.php');
require('functions/login-functions.php');
//Удаление фильма
if (@$_GET['action'] == 'delete') {
	$result = film_delete($link, $_GET['id']);

	if ($result) {
		$resultInfo = "Фильм был удален!";
	} else {
		$resultError = "Что-то пошло не так.";
	}
}

$films = films_all($link);

include('views/head.tpl.php');
include('views/notifications.tpl.php');
include('views/index.tpl.php');
include('views/footer.tpl.php');

//Можно экранировать ошибки с помощью @
/*if (@$_GET['action'] == 'delete') {
	echo "Удаляем фильм";
}*/

?>