<?php 

//Константы задаются функцией define. Передаются 2 параметра: имя константы и значение.
define('MYSQL_SERVER', 'localhost'); 
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB', 'filmoteka');

//$_SERVER['HTTP_HOST'] - адрес хоста
define('HOST', 'http://'. $_SERVER['HTTP_HOST'] .'/');
//dirname(__FILE__) - вернет директорию в которой лежит config.php
define('ROOT', dirname(__FILE__).'/');

//Выводит информацию о php модулях и т.д.
//phpinfo();

?>