<?php

class Order{

private $pdo;


public function __construct($pdo)
{
$this->pdo=$pdo;
}


/* all orders */

public function getAllOrders()
{

$stmt=
$this->pdo->query(

"SELECT

orders.*,

users.name

FROM orders

LEFT JOIN users

ON users.id=
orders.user_id

ORDER BY
order_date DESC"

);

return
$stmt->fetchAll(
PDO::FETCH_ASSOC
);

}



/* update */

public function updateStatus(
$id,
$status
)
{

$stmt=
$this->pdo->prepare(

"UPDATE orders

SET status=?

WHERE id=?"

);

return
$stmt->execute([

$status,
$id

]);

}



/* total revenue */

public function getRevenue()
{

$stmt=
$this->pdo->query(

"SELECT
SUM(total_amount)
AS total

FROM orders

WHERE
status='delivered'"

);

return
$stmt->fetch(
PDO::FETCH_ASSOC
);

}



/* total orders */

public function getTotalOrders()
{

$stmt=
$this->pdo->query(

"SELECT COUNT(*)
AS total

FROM orders"

);

return
$stmt->fetch(
PDO::FETCH_ASSOC
);

}



/* order items */

public function getItems(
$orderId
)
{

$stmt=
$this->pdo->prepare(

"SELECT

books.title

FROM order_items

LEFT JOIN books

ON books.id=
order_items.book_id

WHERE order_id=?"

);

$stmt->execute([
$orderId
]);

return
$stmt->fetchAll(
PDO::FETCH_ASSOC
);

}
public function getUserOrders(
$userId
)
{

$stmt=
$this->pdo->prepare(

"SELECT

orders.*,

payments.payment_method

FROM orders

LEFT JOIN payments

ON payments.order_id=
orders.id

WHERE
orders.user_id=?

ORDER BY
orders.id DESC"

);

$stmt->execute([
$userId
]);

return
$stmt->fetchAll(
PDO::FETCH_ASSOC
);

}
}