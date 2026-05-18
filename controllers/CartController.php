<?php

require_once(
__DIR__."/../models/Cart.php"
);

class CartController{

private $cart;


public function __construct()
{
$this->cart=
new Cart();
}


/* add */

public function add(
$bookId,
$qty
)
{

$this->cart
->add(
$bookId,
$qty
);

}


/* update */

public function update(
$bookId,
$qty
)
{

$this->cart
->update(
$bookId,
$qty
);

}


/* remove */

public function remove(
$bookId
)
{

$this->cart
->remove(
$bookId
);

}


/* all */

public function index()
{

return
$this->cart
->getItems();

}

}