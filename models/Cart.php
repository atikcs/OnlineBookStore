<?php

class Cart{


public function add(
$bookId,
$qty
)
{

if(
!isset($_SESSION['cart'])
)
{
$_SESSION['cart']=[];
}


if(
isset(
$_SESSION['cart'][$bookId]
)
)
{

$_SESSION['cart'][$bookId]
+=
$qty;

}
else{

$_SESSION['cart'][$bookId]
=
$qty;

}

}



/* update quantity */

public function update(
$bookId,
$qty
)
{

if(
$qty<=0
)
{

unset(
$_SESSION['cart'][$bookId]
);

return;

}


$_SESSION['cart'][$bookId]
=
$qty;

}



/* remove */

public function remove(
$bookId
)
{

unset(
$_SESSION['cart'][$bookId]
);

}


/* all */

public function getItems()
{

if(
isset(
$_SESSION['cart']
)
)
{
return
$_SESSION['cart'];
}

return [];

}

}