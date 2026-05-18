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


$cart=
new CartController();

$cart->remove(
$id
);


echo json_encode([

"success"=>true

]);

?>