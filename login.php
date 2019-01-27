<?php 

require('config.php');
require('functions/login-functions.php');

if (isset($_POST['enter'])) {
	$userName = 'admin';
	$userPassword = '123456';
	if ($_POST['login'] == $userName) {
		if ($_POST['password'] == $userPassword) {
			$_SESSION['user'] = 'admin';
			header('Location: '. HOST .'index.php');
		}
	}
}

include('views/head.tpl.php');
include('views/login.tpl.php');
include('views/footer.tpl.php');

?>