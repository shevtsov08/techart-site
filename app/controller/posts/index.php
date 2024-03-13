<?php 


$title = "Techart::Home";
$page = $_GET['page'] ?? 1;
$per_page = 4;
$total = db()->query("SELECT COUNT(*) FROM news")->getColum();
$pagination = new \techart\Pagination((int)$page, $per_page, $total);


$start = $pagination->getStart();

$posts = db()->query("SELECT * FROM news ORDER BY date DESC LIMIT $start, $per_page")->findAll();
$lastPost = db()->query("SELECT * FROM news ORDER BY date DESC LIMIT 1")->findOrFail();


require VIEW . '/posts/index.tpl.php';