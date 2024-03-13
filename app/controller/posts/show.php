<?php




 
$id = (int)$_GET['id'] ?? 0;
$post = db()->query("SELECT * FROM news WHERE id = ? LIMIT 1", [$id])->findOrFail();
$title = "{$post['title']}";
 require VIEW . '/posts/show.tpl.php';