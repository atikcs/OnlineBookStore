<?php

session_start();

require_once(
"../config/database.php"
);

require_once(
"../controllers/OrderController.php"
);

include(
"navbar.php"
);


if(
!isset($_SESSION['user_id'])
)
{

header(
"Location:auth/login.php"
);

exit();

}


$order=
new OrderController(
$pdo
);


$orders=
$order->history(
$_SESSION['user_id']
);

?>


<!DOCTYPE html>

<html>

<head>

<title>

Purchase History

</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
}

.container{

width:85%;
margin:30px auto;

background:white;

padding:30px;

border-radius:10px;

}

table{

width:100%;

border-collapse:collapse;

}

th,
td{

padding:15px;

border-bottom:
1px solid #ddd;

text-align:left;

}

.status{

padding:5px 10px;

border-radius:8px;

background:#e9f2ff;

display:inline-block;

}

</style>

</head>

<body>

<div class="container">

<h1>

Purchase History

</h1>


<table>

<tr>

<th>

Order ID

</th>

<th>

Amount

</th>

<th>

Payment

</th>

<th>

Status

</th>

<th>

Date

</th>

</tr>


<?php

foreach(
$orders
as
$row
)
{

?>

<tr>

<td>

#<?php
echo
$row['id'];
?>

</td>


<td>

৳<?php
echo
$row['total_amount'];
?>

</td>


<td>

<?php
echo
$row['payment_method'];
?>

</td>


<td>

<span
class="status">

<?php
echo
$row['status'];
?>

</span>

</td>


<td>

<?php
echo
$row['order_date'];
?>

</td>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>