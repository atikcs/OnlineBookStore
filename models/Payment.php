<?php

class Payment{

private $pdo;


public function __construct($pdo)
{
$this->pdo=$pdo;
}


public function create(

$orderId,
$method,
$amount

)

{

$stmt=
$this->pdo->prepare(

"INSERT INTO payments

(
order_id,
payment_method,
amount
)

VALUES
(
?,?,?
)"

);


return
$stmt->execute([

$orderId,
$method,
$amount

]);

}

}