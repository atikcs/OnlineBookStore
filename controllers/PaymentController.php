<?php

require_once(
__DIR__."/../models/Payment.php"
);


class PaymentController{

private $payment;


public function __construct($pdo)
{

$this->payment=
new Payment(
$pdo
);

}


public function create(

$orderId,
$method,
$amount

)

{

return

$this->payment

->create(

$orderId,
$method,
$amount

);

}

}
