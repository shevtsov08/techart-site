<?php

return [ 
	'host' => 'localhost',
  'dbname' => 'news',
  'username' => 'root',
  'password' => '',
  'charset' => 'utf8',
  'option' => [ 
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
    ],
  ];