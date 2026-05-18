<?php

session_start();

require_once(
"../config/database.php"
);

require_once(
"../controllers/OrderController.php"
);

require_once(
"../controllers/UserController.php"
);

require_once(
"../controllers/BookController.php"
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


$order=
new OrderController(
$pdo
);

$user=
new UserController(
$pdo
);

$book=
new BookController(
$pdo
);


$totalOrders=
$order
->total()['total'];

$revenue=
$order
->revenue()['total']
??0;

$totalUsers=
count(
$user->index()
);

$totalBooks=
count(
$book->index()
);

?>

<!DOCTYPE html>

<html>

<head>

<title>

Admin Dashboard

</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
margin:0;
}

.top{

background:#1d4fa5;
padding:20px;
color:white;

display:flex;
justify-content:space-between;
}

.top a{
color:white;
text-decoration:none;
margin-left:20px;
}

.wrap{

padding:30px;

display:grid;

grid-template-columns:
repeat(4,1fr);

gap:25px;

}

.card{

background:white;

padding:30px;

border-radius:15px;

box-shadow:
0 2px 10px rgba(0,0,0,.1);

text-align:center;

}

.card h1{

font-size:40px;
color:#1d4fa5;

}

</style>

</head>

<body>

<div class="top">

<div>

Admin Dashboard

</div>


<div>

<a href="books.php">

Books

</a>

<a href="users.php">

Users

</a>

<a href="orders.php">

Orders

</a>

<a href="../logout.php">

Logout

</a>

</div>

</div>



<div class="wrap">

<div class="card">

<h3>

Total Orders

</h3>

<h1>

<?php
echo
$totalOrders;
?>

</h1>

</div>



<div class="card">

<h3>

Revenue

</h3>

<h1>

৳<?php
echo
$revenue;
?>

</h1>

</div>



<div class="card">

<h3>

Users

</h3>

<h1>

<?php
echo
$totalUsers;
?>

</h1>

</div>



<div class="card">

<h3>

Books

</h3>

<h1>

<?php
echo
$totalBooks;
?>

</h1>

</div>

</div>

</body>

</html>