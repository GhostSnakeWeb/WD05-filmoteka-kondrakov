<?php 

//Получаем все фильмы из БД
function films_all($link){

	$query = "SELECT * FROM `films`";
	$films = array();

	if ($result = mysqli_query($link, $query)) {
		while ($row = mysqli_fetch_array($result)) {
			$films[] = $row;
		}
	}

	return $films;
}

//Сохраняем данные в БД
function film_new($link, $title, $genre, $year, $description){

	require_once("functions/minimize.php");
	//Запись данных в БД
	$query = "INSERT INTO films (title, genre, year, description, photo) VALUES (
		'". mysqli_real_escape_string($link, $title) ."',
		'". mysqli_real_escape_string($link, $genre) ."',
		'". mysqli_real_escape_string($link, $year) ."',
		'". mysqli_real_escape_string($link, $description) ."',
		'". mysqli_real_escape_string($link, $db_file_name) ."'
	)";

	if (mysqli_query($link, $query)) {
		$result = true;
	} else {
		$result = false;
	}

	return $result;

}

function get_film($link, $id){
	$query = "SELECT * FROM films WHERE id = ' " . mysqli_real_escape_string($link, $id) . "' LIMIT 1";
	$result = mysqli_query($link, $query);

	if ($result = mysqli_query($link, $query)) {
		$film = mysqli_fetch_array($result);
	}

	return $film;
}

function film_update($link, $title, $genre, $year, $description, $id){

	require_once("functions/minimize.php");
	//Запись данных в БД
	$query = "	UPDATE films 
				SET title = '". mysqli_real_escape_string($link, $title) ."', 
					genre = '". mysqli_real_escape_string($link, $genre) ."', 
					year = '". mysqli_real_escape_string($link, $year) ."', 
					description = '". mysqli_real_escape_string($link, $description) ."', 
					photo = '". mysqli_real_escape_string($link, $db_file_name) ."' 
					WHERE id = ".mysqli_real_escape_string($link, $id)." LIMIT 1";

	if ( mysqli_query($link, $query) ) {
		$result = true;
	} else { 
		$result = false;
	}
	
	return $result;
}

function film_delete($link, $id){
	//Запрос на удаление
	$query = "DELETE FROM films WHERE id = ' " . mysqli_real_escape_string($link, $id) . "'LIMIT 1";
	//Выполняем запрос на удаление
	mysqli_query($link, $query);
	//Принимает в себя подключение к БД и возвращает количество рядов, которые были затроны при выполнении последнего запроса
	if (mysqli_affected_rows($link) > 0) {
		$resultInfo = "Фильм был удален!";
		$result = true;
	} else {
		$result = false;
	}

	return $result;
}

?>