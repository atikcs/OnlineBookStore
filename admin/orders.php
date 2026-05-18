<?php

session_start();

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
header(
"Location:../index.php"
);

exit();
}


$controller=
new OrderController(
$pdo
);


$orders=
$controller
->index();

?>

<!DOCTYPE html>

<html>

<head>

<title>

Order Management

</title>

<style>

body{
font-family:Arial;
background:#f4f5f7;
margin:0;
}

.top{

background:#1d4fa5;

padding:20px;

display:flex;

justify-content:space-between;

color:white;

}

.top a{

color:white;
text-decoration:none;
margin-left:20px;

}

.container{

padding:30px;

}

table{

width:100%;

background:white;

border-collapse:collapse;

}

th,
td{

padding:15px;

border:1px solid #ddd;

text-align:center;

}

select{

padding:8px;

border-radius:5px;

}

</style>

</head>

<body>


<div class="top">

<div>

Order Management

</div>


<div>

<a href="dashboard.php">

Dashboard

</a>


<a href="../logout.php">

Logout

</a>

</div>

</div>



<div class="container">


<table>

<tr>

<th>ID</th>

<th>Customer</th>

<th>Total</th>

<th>Payment</th>

<th>Status</th>

<th>Date</th>

</tr>



<?php

foreach(
$orders
as
$order
)
{

?>

<tr>

<td>

<?php
echo
$order['id'];
?>

</td>



<td>

<?php
echo htmlspecialchars(
$order['name']
);
?>

</td>



<td>

৳<?php
echo
$order['total_amount'];
?>

</td>



<td>

<?php
echo
$order['payment_method']
??"N/A";
?>

</td>



<td>

<select

onchange=
"changeStatus(
<?php
echo $order['id'];
?>,
this.value
)"

>

<?php

$options=[

"pending",

"processing",

"shipped",

"delivered",

"cancelled"

];


foreach(
$options
as
$op
)
{

?>

<option

value="<?php
echo $op;
?>"

<?php

if(
$order['status']
==
$op
)
echo
"selected";

?>

>

<?php
echo ucfirst(
$op
);
?>

</option>

<?php

}

?>

</select>

</td>



<td>

<?php
echo
$order['order_date'];
?>

</td>

</tr>

<?php

}

?>

</table>

</div>



<script>

function changeStatus(
id,
status
)
{

fetch(

"../api/updateOrderStatus.php",

{

method:"POST",

headers:{

"Content-Type":
"application/x-www-form-urlencoded"

},

body:

"order_id="
+id+

"&status="
+status

}

)

.then(
r=>r.json()
)

.then(data=>{

if(
data.success
)
{

alert(
"Status Updated"
);

}
else{

alert(
"Update failed"
);

}

});

}

</script>

</body>

</html>