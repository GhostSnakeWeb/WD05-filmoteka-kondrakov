<?php 

require('config.php');
//Обнулили значение user в сессии
unset($_SESSION['user']);
//Удалили сессию
session_destroy();
//Перенаправили на главную
header('Location: '. HOST .'index.php');

?>