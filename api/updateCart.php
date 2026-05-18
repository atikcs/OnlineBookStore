<?php

session_start();

header(
"Content-Type:application/json"
);

require_once(
"../controllers/CartController.php"
);


$id=
(int)$_POST['book_id'];

$qty=
(int)$_POST['quantity'];


$cart=
new CartController();

$cart->update(
$id,
$qty
);


echo json_encode([

"success"=>true

]);

?>