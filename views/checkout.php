<?php

session_start();

require_once("../config/database.php");

require_once(
"../controllers/CartController.php"
);

require_once(
"../controllers/BookController.php"
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


$cart=
new CartController();

$book=
new BookController(
$pdo
);


$items=
$cart->index();


if(
empty($items)
)
{
die(
"Cart Empty"
);
}


$total=0;

?>

<!DOCTYPE html>

<html>

<head>

<title>

Checkout

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

display:grid;

grid-template-columns:
2fr 1fr;

gap:25px;

}

.left,
.right{

background:white;

padding:30px;

border-radius:12px;

}

.row{

display:flex;

justify-content:space-between;

padding:12px 0;

border-bottom:
1px solid #eee;

}

input,
select{

width:100%;

padding:12px;

margin-top:10px;

margin-bottom:20px;

border:1px solid #ddd;

border-radius:8px;

}

button{

background:#1d4fa5;

color:white;

border:none;

padding:15px;

width:100%;

border-radius:8px;

font-size:16px;

cursor:pointer;

}

.total{

font-size:24px;

font-weight:bold;

margin-top:20px;

}

</style>

</head>

<body>

<div class="container">

<div class="left">

<h2>

Shipping Details

</h2>


<input

id="address"

placeholder=
"Enter shipping address"

required>


<select
id="payment">

<option value="">

Select Payment

</option>

<option>

Cash On Delivery

</option>

<option>

Bkash

</option>

<option>

Nagad

</option>

<option>

Card

</option>

</select>


<button
onclick="checkout()">

Place Order

</button>


<div
id="msg"
style="
margin-top:20px;
font-weight:bold;
">

</div>

</div>



<div class="right">

<h2>

Order Summary

</h2>


<?php

foreach(
$items
as
$id=>$qty
)
{

$b=
$book->show($id);

$sub=
$b['price']
*
$qty;

$total+=
$sub;

?>

<div class="row">

<div>

<?php
echo
htmlspecialchars(
$b['title']
);
?>

x
<?php
echo
$qty;
?>

</div>


<div>

৳<?php
echo
$sub;
?>

</div>

</div>

<?php

}

?>


<div class="total">

Total:
৳<?php
echo $total;?>

</div>


<input
type="hidden"

id="total"

value="<?php
echo $total;
?>">

</div>

</div>



<script>

function checkout()
{

let address=

document
.getElementById(
"address"
)
.value;


let payment=

document
.getElementById(
"payment"
)
.value;


let total=

document
.getElementById(
"total"
)
.value;



if(
address==""
||
payment==""
)
{

alert(
"Fill all fields"
);

return;

}



fetch(

"../api/checkout.php",

{

method:"POST",

headers:{

"Content-Type":
"application/x-www-form-urlencoded"

},

body:

"address="
+
encodeURIComponent(
address
)

+

"&payment="
+
encodeURIComponent(
payment
)

+

"&total="
+
total

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

document
.getElementById(
"msg"
)

.innerHTML=

"Order placed successfully";


setTimeout(
()=>{

window.location=
"purchaseHistory.php"

},
1500
);

}
else{

alert(
data.message
);

}

});

}

</script>

</body>

</html>