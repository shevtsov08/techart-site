<?php require_once(VIEW . "/incs/header.php") ?>
<main class="main">
	<section class="top">
		<div class="top__inner" style="background-image: url(../../../public/assets/images/<?= $lastPost['image'] ?>); ">
			<div class="container">
				<h2 class="top__title"><?= $lastPost['title']?> </h2>
				<div class="top__text"><?= $lastPost['announce']?></div>
			</div>
		</div>
		</div>
	</section>

	<section class="news">
		<div class="container">
			<h2 class="news__title">Новости</h2>
			<div class="news__items">

				<?php foreach($posts as $post): ?>
				<?php $date = new DateTime($post['date']); ?>
				<div class="news__item">
					<li class="news__item-date"><?= str_replace('-', '.', $date->format('Y-m-d')) ?></li>
					<h3 class="news__item-title"><?= $post['title'] ?></h3>
					<div class="news__item-text"><?= $post['announce']; ?></div>
					<a class="news__item-button" href="posts?id=<?=$post['id'] ?> ">Подробнее
						<svg class=" wf" width="27" height="16">
							<path
								d="M1 7C0.447715 7 4.82823e-08 7.44772 0 8C-4.82823e-08 8.55228 0.447715 9 1 9L1 7ZM26.707 8.70711C27.0975 8.31658 27.0975 7.68342 26.707 7.2929L20.343 0.928934C19.9525 0.538409 19.3193 0.538409 18.9288 0.928934C18.5383 1.31946 18.5383 1.95262 18.9288 2.34315L24.5857 8L18.9288 13.6569C18.5383 14.0474 18.5383 14.6805 18.9288 15.0711C19.3193 15.4616 19.9525 15.4616 20.343 15.0711L26.707 8.70711ZM1 9L25.9999 9L25.9999 7L1 7L1 9Z"
								fill="white" />
						</svg>
					</a>
				</div>
				<?php endforeach ?>

			</div>
		</div>



		<div class=" container">
			<?= $pagination ?>
		</div>


		</div>
		</div>
		</div>
	</section>
</main>

<?php require_once(VIEW . "/incs/footer.php") ?>