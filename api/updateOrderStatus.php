<?php

session_start();

header(
"Content-Type: application/json"
);

require_once(
"../config/database.php"
);

require_once(
"../controllers/OrderController.php"
);


if(
!isset($_SESSION['role'])
||
$_SESSION['role']!="admin"
)
{

echo json_encode([

"success"=>false,

"message"=>
"Unauthorized"

]);

exit();

}


$id=
(int)(
$_POST['order_id']
??0
);


$status=
trim(
$_POST['status']
??""
);


$allowed=[

"pending",

"processing",

"shipped",

"delivered",

"cancelled"

];


if(
$id<=0
||
!in_array(
$status,
$allowed
)
)
{

echo json_encode([

"success"=>false,

"message"=>
"Invalid data"

]);

exit();

}


$order=
new OrderController(
$pdo
);


$ok=
$order->update(
$id,
$status
);


echo json_encode([

"success"=>$ok

]);

?>