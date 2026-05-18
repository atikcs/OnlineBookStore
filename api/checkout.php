<?php

session_start();

header(
"Content-Type: application/json"
);

require_once(
"../config/database.php"
);

require_once(
"../controllers/CartController.php"
);

require_once(
"../controllers/OrderController.php"
);

require_once(
"../controllers/PaymentController.php"
);



if(
!isset($_SESSION['user_id'])
)
{

echo json_encode([

"success"=>false,

"message"=>
"Login required"

]);

exit();

}



$address=
trim(
$_POST['address']
??""
);


$payment=
trim(
$_POST['payment']
??""
);


$total=
(float)(
$_POST['total']
??0
);



if(
$address==""
||
$payment==""
||
$total<=0
)
{

echo json_encode([

"success"=>false,

"message"=>
"Invalid data"

]);

exit();

}



$cart=
new CartController();

$items=
$cart->index();



if(
empty($items)
)
{

echo json_encode([

"success"=>false,

"message"=>
"Cart empty"

]);

exit();

}



$order=
new OrderController(
$pdo
);


$paymentController=
new PaymentController(
$pdo
);



try{

$pdo->beginTransaction();



/* create order */

$stmt=
$pdo->prepare(

"INSERT INTO orders
(
user_id,
shipping_address,
total_amount,
status
)

VALUES
(
?,?,?,'pending'
)"

);


$stmt->execute([

$_SESSION['user_id'],

$address,

$total

]);


$orderId=
$pdo->lastInsertId();



/* order items */

foreach(
$items
as
$bookId=>$qty
)
{

$stmt=
$pdo->prepare(

"INSERT INTO order_items
(
order_id,
book_id,
quantity
)

VALUES
(
?,?,?
)"

);

$stmt->execute([

$orderId,
$bookId,
$qty

]);

}



/* payment */

$paymentController
->create(

$orderId,

$payment,

$total

);



$pdo->commit();



unset(
$_SESSION['cart']
);



echo json_encode([

"success"=>true

]);

}
catch(Exception $e)
{

$pdo->rollBack();

echo json_encode([

"success"=>false,

"message"=>
$e->getMessage()

]);

}