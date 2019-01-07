<?php 

//$_FILES - массив фотографий. В массиве содержится информация об имени, формате изображения, куда была помещена, ошибки и размер изображения.
if (isset($_FILES['photo']['name']) && $_FILES['photo']['tmp_name'] != "") {
	$fileName = $_FILES['photo']['name'];
	$fileTmpLoc = $_FILES['photo']['tmp_name'];
	$fileType = $_FILES['photo']['type'];
	$fileSize = $_FILES['photo']['size'];
	$fileErrorMsg = $_FILES['photo']['error'];
	//Разбиваем строку с именем файла на два элемента. До точки и после точки
	$kaboom = explode(".", $fileName);
	//Берем последний элемент массива и записываем в переменную. В переменной будет лежать расширение файла
	$fileExt = end($kaboom);
	//list запишет знаечния в переменные width и height и запишет значения, полученные с помощью функции getimagesize, из файла по пути из fileTmpLoc 
	list($width, $height) = getimagesize($fileTmpLoc);
	if ($width < 10 || $height < 10) {
		$errors[] = 'That image has no dimensions.';
	}

	//рандомное имя в виде числа с расширением
	$db_file_name = rand(10000000, 99999999) . "." . $fileExt;

	if ($fileSize > 10485760) {
		$errors[] = "Your image file was larger than 10mb";
	} elseif (!preg_match("/\.(gif|jpg|png|jpeg)$/i", $fileName)) {
		//Проверка на допустимые разрешения. Если расширение файла не заканчивается на jpg, gif или png
		$errors[] = "Your image file was not jpg, gif or png type";
	} elseif ($fileErrorMsg == 1) {
		$errors[] = "An unknown error occurred";
	}

	$photoFolderLocation = ROOT . 'data/films/full/';
	$photoFolderLocationMin = ROOT . 'data/films/min/';

	$uploadfile = $photoFolderLocation . $db_file_name;
	//Перемещаем файл из временного хранилища в папку с изоражениями (data/films/)
	$moveResult = move_uploaded_file($fileTmpLoc, $uploadfile);	

	if ($moveResult != true) {
		$errors[] = 'File upload failed';
	}

	require_once(ROOT . "/functions/image_resize_imagick.php");
	//Берем файл
	$target_file =  $photoFolderLocation . $db_file_name;
	$resized_file = $photoFolderLocationMin . $db_file_name;
	$wmax = 137;
	$hmax = 200;
	//Создаем миниатюру картинки
	$img = createThumbnail($target_file, $wmax, $hmax);
	$img->writeImage($resized_file);
}

?>