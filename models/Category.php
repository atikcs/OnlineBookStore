<?php

class Category{

private $pdo;

function __construct($pdo)
{
$this->pdo=$pdo;
}

function getAll()
{

$stmt=
$this->pdo->query(
"SELECT * FROM categories"
);

return
$stmt->fetchAll(
PDO::FETCH_ASSOC
);

}


function getById($id)
{

$stmt=
$this->pdo->prepare(
"SELECT * FROM categories
WHERE id=?"
);

$stmt->execute([$id]);

return
$stmt->fetch(
PDO::FETCH_ASSOC
);

}

}