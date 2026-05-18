<?php

require_once(
__DIR__."/../models/Category.php"
);

class CategoryController{

private $categoryModel;


public function __construct($pdo)
{

$this->categoryModel=
new Category($pdo);

}


/* all categories */

public function index()
{

return
$this->categoryModel
->getAll();

}


/* single category */

public function show($id)
{

return
$this->categoryModel
->getById($id);

}

}