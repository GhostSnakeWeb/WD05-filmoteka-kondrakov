<h1 class="title-1">Фильмотека</h1>
<?php foreach ($films as $key => $film) { ?>
	<!--row-->
	<div class="card mb-20">
		<div class="row">
			<!--col-4-->
			<div class="col-auto">
				<img height="200" src="<?=HOST?>data/films/min/<?=$film['photo']?>" alt="<?=@$film['title']?>">
			</div>
			<!--//col-4-->
			<!--col-8-->
			<div class="col">
				<div class="card__header">
					<h4 class="title-4"><?=@$film['title'] //@ гасит ошибки. Они не будут видны на странице ?></h4>
					<div>
						<a href="edit.php?id=<?=$film['id']?>" class="button button--editsmall">Редактировать</a>
						<!--GET запрос на удаление карточки-->
						<a href="?action=delete&id=<?=$film['id']?>" class="button button--removesmall">Удалить</a>
					</div>
				</div>
				<div class="badge"><?=@$film['genre']?></div>
				<div class="badge"><?=@$film['year']?></div>
				<div class="mt-20">
					<a href="single.php?id=<?=$film['id']?>" class="button">Подробнее</a>
				</div>
			</div>
			<!--//col-8-->
		</div>
	</div>
	<!--//row-->
<?php } ?>