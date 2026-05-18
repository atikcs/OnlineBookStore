<?php

session_start();

header(
"Content-Type:application/json"
);

require_once(
"../controllers/CartController.php"
);


if(
!isset(
$_SESSION['user_id']
)
)
{

echo json_encode([

"success"=>false,

"message"=>
"Login required"

]);

exit();

}


$id=
(int)$_POST['book_id'];

$qty=
(int)$_POST['quantity'];


if($qty<=0)
{
$qty=1;
}


$cart=
new CartController();

$cart->add(
$id,
$qty
);


$count=0;


foreach(
$_SESSION['cart']
as
$item
)
{
$count+=$item;
}


echo json_encode([

"success"=>true,

"count"=>$count

]);

?>