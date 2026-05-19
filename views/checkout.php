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

border-radius:15px;

box-shadow:
0 4px 15px rgba(0,0,0,.08);

}

input,
select{

width:100%;

padding:15px;

margin-top:10px;

margin-bottom:15px;

border:1px solid #ddd;

border-radius:8px;

font-size:15px;

box-sizing:border-box;

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

font-weight:bold;

transition:.3s;

}

button:hover{

background:#163d82;

}

.row{

display:flex;

justify-content:space-between;

padding:15px 0;

border-bottom:
1px solid #eee;

}

.total{

font-size:28px;

font-weight:bold;

margin-top:20px;

color:#1d4fa5;

}

.paymentBox{

margin-top:15px;

}

h2{
margin-bottom:20px;
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
id="paymentMethod">

<option value="">
Select Payment Method
</option>

<option value="Cash On Delivery">
Cash On Delivery
</option>

<option value="bKash">
bKash
</option>

<option value="Nagad">
Nagad
</option>

<option value="Credit Card">
Credit Card
</option>

<option value="Bank Transfer">
Bank Transfer
</option>

</select>


<div
id="paymentFields"
class="paymentBox">

</div>


<button
onclick="checkout()">

Place Order

</button>


<div
id="msg"

style="
margin-top:20px;
font-weight:bold;
color:green;
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
echo
$total;
?>

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

const method=
document.getElementById(
"paymentMethod"
);

const fields=
document.getElementById(
"paymentFields"
);


method.addEventListener(
"change",

function()
{

let p=
this.value;

fields.innerHTML="";


if(
p=="bKash"
||
p=="Nagad"
)
{

fields.innerHTML=`

<input
type="text"
placeholder="Enter Mobile Number"
id="mobile">

<input
type="text"
placeholder="Transaction ID"
id="trx">

`;

}



else if(
p=="Credit Card"
)
{

fields.innerHTML=`

<input
type="text"
placeholder="Card Number">

<div style="
display:flex;
gap:10px;
">

<input
placeholder="MM/YY">

<input
placeholder="CVV">

</div>

`;

}



else if(
p=="Bank Transfer"
)
{

fields.innerHTML=`

<input
type="text"
placeholder="Bank Account Number">

`;

}

});





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
"paymentMethod"
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

"Order placed successfully ✔";


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