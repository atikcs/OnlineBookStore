<?php

require_once(
__DIR__."/../models/Book.php"
);

class BookController{

private $bookModel;


public function __construct($pdo)
{
$this->bookModel=
new Book($pdo);
}


/* all books */

public function index()
{

return
$this->bookModel
->getAll();

}


/* featured */

public function featured()
{

return
$this->bookModel
->featured();

}


/* single */

public function show($id)
{

return
$this->bookModel
->getById($id);

}


/* category */

public function category($id)
{

return
$this->bookModel
->category($id);

}


/* search */

public function search(
$q,
$category,
$author
)
{

return
$this->bookModel
->search(
$q,
$category,
$author
);

}


/* create */

public function store(

$title,
$author,
$description,
$price,
$category,
$image,
$stock

)
{

return
$this->bookModel
->create(

$title,
$author,
$description,
$price,
$category,
$image,
$stock

);

}


/* update */

public function update(

$id,
$title,
$author,
$description,
$price,
$category,
$image,
$stock

)

{

return
$this->bookModel
->update(

$id,
$title,
$author,
$description,
$price,
$category,
$image,
$stock

);

}


/* delete */

public function destroy($id)
{

return
$this->bookModel
->delete($id);

}

}