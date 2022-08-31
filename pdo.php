<?php

use \PDO;

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=pizza_tests', 'root', '');
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

$query = $pdo->prepare('SELECT name, price FROM pizzas WHERE id = :id');
$query->bindValue(':id', 2);
$query->execute();
$pizzas = $query->fetchAll(\PDO::FETCH_ASSOC);

var_dump($pizzas);
