<?php

session_start();

require_once("../config/database.php");

require_once(
"../controllers/BookController.php"
);


$controller=
new BookController(
$pdo
);


if(
!isset($_GET['id'])
)
{
die(
"Book not found"
);
}


$id=
(int)$_GET['id'];


/* get from controller */

$book=
$controller
->show($id);


if(!$book)
{
die(
"Book not found"
);
}

?>


<!DOCTYPE html>

<html>

<head>

<title>

<?php
echo htmlspecialchars(
$book['title']
);
?>

</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
margin:0;
}

.container{

width:80%;

margin:40px auto;

display:flex;

gap:40px;

background:white;

padding:30px;

border-radius:15px;

box-shadow:
0 2px 10px rgba(0,0,0,.1);

}

img{

width:300px;

height:420px;

object-fit:cover;

border-radius:10px;

}

.price{

font-size:30px;

color:#1e4fa8;

font-weight:bold;

margin:20px 0;

}

.btn{

background:#1e4fa8;

color:white;

padding:15px;

border:none;

border-radius:8px;

cursor:pointer;

text-decoration:none;

display:inline-block;

margin-right:10px;

}

</style>

</head>

<body>


<div class="container">


<div>

<img
src="../public/uploads/<?php
echo
$book['image_path'];
?>">

</div>



<div>

<h1>

<?php
echo htmlspecialchars(
$book['title']
);
?>

</h1>


<p>

Author:
<?php
echo htmlspecialchars(
$book['author']
);
?>

</p>



<p>

Category:
<?php
echo htmlspecialchars(
$book['category']
);
?>

</p>



<p>

<?php
echo htmlspecialchars(
$book['description']
);
?>

</p>



<div class="price">

৳<?php
echo
$book['price'];
?>

</div>



<button

class="btn"

id="addCart"

data-id="<?php
echo $book['id'];
?>"

>

Add To Cart

</button>



<a
class="btn"
href="../index.php">

Back

</a>


</div>

</div>



<script>

document
.getElementById(
"addCart"
)

.addEventListener(

"click",

function(){

let id=

this.dataset.id;


fetch(

"../api/cart.php",

{

method:"POST",

headers:{

"Content-Type":

"application/x-www-form-urlencoded"

},

body:

"book_id="+id+

"&quantity=1"

}

)

.then(
response=>
response.json()
)

.then(data=>{

if(
data.success
)
{

alert(
"Book Added To Cart"
);

}
else{

alert(
data.message
);

}

});

}

);

</script>


</body>

</html>