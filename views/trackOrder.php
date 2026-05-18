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

Track Order

</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
margin:0;
}

.container{

width:85%;
margin:30px auto;

background:white;

padding:30px;

border-radius:12px;

}

table{

width:100%;
border-collapse:collapse;

}

th,td{

padding:15px;
border-bottom:1px solid #ddd;
text-align:center;

}

.pending{
color:orange;
font-weight:bold;
}

.processing{
color:#1d4fa5;
font-weight:bold;
}

.shipped{
color:purple;
font-weight:bold;
}

.delivered{
color:green;
font-weight:bold;
}

.cancelled{
color:red;
font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h1>

Track Orders

</h1>

<table>

<tr>

<th>Order ID</th>
<th>Total</th>
<th>Payment</th>
<th>Status</th>
<th>Date</th>

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
echo $row['id'];
?>

</td>


<td>

৳<?php
echo $row['total_amount'];
?>

</td>


<td>

<?php
echo htmlspecialchars(
$row['payment_method']
??"N/A"
);
?>

</td>


<td>

<span
class="<?php
echo $row['status'];
?>">

<?php
echo ucfirst(
$row['status']
);
?>

</span>

</td>


<td>

<?php
echo $row['order_date'];
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