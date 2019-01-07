<?php 

//Подсоединение к БД
function db_connect(){

	$link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);

	if (mysqli_connect_error()) {
		die("Ошибка подключения к базе данных!");
	}

	//Если вернет false, то выполнится код внутри
	if (!mysqli_set_charset($link, "utf8")) {
	 	printf("Error: " . mysqli_error($link));
	} 

	//Возвращаем из функции переменную с соединением
	return $link;
}


?>