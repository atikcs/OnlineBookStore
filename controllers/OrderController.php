<?php

require_once(__DIR__."/../models/Order.php");

class OrderController{

private $orderModel;


public function __construct($pdo)
{
$this->orderModel=
new Order($pdo);
}


public function index()
{
return
$this->orderModel
->getAllOrders();
}


public function update(
$id,
$status
)
{
return
$this->orderModel
->updateStatus(
$id,
$status
);
}


public function revenue()
{
return
$this->orderModel
->getRevenue();
}


public function total()
{
return
$this->orderModel
->getTotalOrders();
}


public function items($id)
{
return
$this->orderModel
->getItems($id);
}
public function history(
$userId
)
{

return
$this->orderModel
->getUserOrders(
$userId
);

}

}