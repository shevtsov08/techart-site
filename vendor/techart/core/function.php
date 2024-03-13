<?php

function dump($date)
{
	echo '<pre>';
	var_dump($date);
	echo '<pre>';
}

function dd($date)
{
	dump($date);
	die;
}

function abort($code = 404)
{
	http_response_code($code);
	die;
}

function db(): \techart\Db
{
	return \techart\App::get(\techart\Db::class);
}