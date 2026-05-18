<?php

require_once(
__DIR__."/../models/Book.php"
);

class SearchController{

private $book;

public function __construct($pdo)
{
$this->book=
new Book($pdo);
}

public function search(
$q="",
$category="",
$author=""
)
{

return
$this->book
->search(
$q,
$category,
$author
);

}

}