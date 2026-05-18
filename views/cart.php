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


$cartController=
new CartController();

$bookController=
new BookController(
$pdo
);


$items=
$cartController
->index();


$total=0;

?>

<!DOCTYPE html>

<html>

<head>

<title>

My Cart

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

border-radius:10px;

}

.row{

display:flex;

align-items:center;

justify-content:space-between;

padding:20px;

border-bottom:
1px solid #ddd;

}

img{

width:70px;
height:90px;
object-fit:cover;

}

.qty{

width:70px;
padding:10px;

}

button{

background:#1d4fa5;
color:white;
border:none;
padding:10px 15px;
border-radius:6px;

cursor:pointer;

}

.remove{

background:red;

}

.total{

font-size:25px;
font-weight:bold;

margin-top:30px;

text-align:right;

}

</style>

</head>

<body>

<div class="container">

<h1>

My Cart

</h1>


<?php

if(empty($items))
{

?>

<h2>

Cart Empty

</h2>

<?php

}
else
{

foreach(
$items
as
$bookId=>$qty
)
{

$book=
$bookController
->show(
$bookId
);

$sub=
$book['price']
*
$qty;

$total+=
$sub;

?>

<div
class="row"

id="row<?php
echo $bookId;
?>">

<div>

<img
src="../public/uploads/<?php
echo
$book['image_path'];
?>">

</div>


<div>

<h3>

<?php
echo
$book['title'];
?>

</h3>

<p>

৳<?php
echo
$book['price'];
?>

</p>

</div>



<div>

<input

class="qty"

type="number"

value="<?php
echo $qty;
?>"

min="1"

onchange=
"updateQty(
<?php
echo $bookId;
?>,

this.value
)"

>

</div>


<div>

৳<?php
echo $sub;
?>

</div>


<div>

<button

class="remove"

onclick=
"removeItem(
<?php
echo $bookId;
?>
)"

>

Remove

</button>

</div>

</div>

<?php

}

?>

<div
style="
display:flex;
justify-content:space-between;
align-items:center;
margin-top:30px;
">

<div class="total">

Total:

৳<?php
echo $total;
?>

</div>


<a
href="checkout.php">

<button

style="
padding:14px 30px;
background:#1d4fa5;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
font-size:16px;
">

Proceed To Checkout

</button>

</a>

</div>

<?php
}
?>

</div>



<script>

function updateQty(
id,
qty
)
{

fetch(

"../api/updateCart.php",

{

method:"POST",

headers:{
"Content-Type":
"application/x-www-form-urlencoded"
},

body:

"book_id="
+id+

"&quantity="
+qty

}

)

.then(
r=>r.json()
)

.then(data=>{

location.reload();

});

}

function removeItem(id)
{

fetch(

"../api/removeCart.php",

{

method:"POST",

headers:{

"Content-Type":
"application/x-www-form-urlencoded"

},

body:
"book_id="+id

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
"row"+id
)

.remove();

location.reload();

}

});

}

</script>


</body>

</html>