<?php

$container = new \techart\ServiceContainer();

$container->setService(\techart\Db::class, function () {
	$db_config = require CONFIG . "/db.php";
	return (\techart\Db::getInstance())->getConnection($db_config);
});

\techart\App::setContainer($container);