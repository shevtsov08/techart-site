<?php require_once(VIEW . "/incs/header.php") ?>
<?php $date = new DateTime($post['date']); ?>

<main class="main">
	<section class="post">
		<div class="container">
			<ul class="breadcrumb">
				<li class="breadcrumb__item"><a class="breadcrumb__link" href="/">Главная</a></li>
				<span>/</span>
				<li class="breadcrumb__item breadcrumb__item--active"><?= $post['title'] ?></li>
			</ul>

			<h2 class="post__title"><?= $post['title'] ?></h2>
			<div class="post__inner">
				<div class="post__item">
					<li class="post__item-date"><?= str_replace('-', '.', $date->format('Y-m-d')) ?></li>
					<h3 class="post__item-title"><?= $post['announce']?></h3>
					<div class="post__item-text">
						<?= $post['content'] ?>
					</div>


					<a class="post__item-button" href="/">
						<svg width="27" height="16" style="transform: scale(-1, 1);">
							<path
								d="M1 7C0.447715 7 4.82823e-08 7.44772 0 8C-4.82823e-08 8.55228 0.447715 9 1 9L1 7ZM26.707 8.70711C27.0975 8.31658 27.0975 7.68342 26.707 7.2929L20.343 0.928934C19.9525 0.538409 19.3193 0.538409 18.9288 0.928934C18.5383 1.31946 18.5383 1.95262 18.9288 2.34315L24.5857 8L18.9288 13.6569C18.5383 14.0474 18.5383 14.6805 18.9288 15.0711C19.3193 15.4616 19.9525 15.4616 20.343 15.0711L26.707 8.70711ZM1 9L25.9999 9L25.9999 7L1 7L1 9Z"
								fill="white" />
						</svg>
						назад к новостям
					</a>

				</div>
				<img class="post__item-img" src="../../public/assets/images/<?= $post['image']?>" alt="">
			</div>





		</div>

	</section>




</main>

<?php require_once(VIEW . "/incs/footer.php") ?>