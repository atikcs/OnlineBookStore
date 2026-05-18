<?php

session_start();

require_once(
"config/database.php"
);

require_once(
"controllers/BookController.php"
);

require_once(
"controllers/CategoryController.php"
);

include(
"views/navbar.php"
);


if(
!isset($_GET['id'])
)
{
header(
"Location:index.php"
);
exit();
}


$id=
(int)$_GET['id'];


/* controllers */

$bookController=
new BookController(
$pdo
);

$categoryController=
new CategoryController(
$pdo
);


/* data */

$books=
$bookController
->category($id);


$categories=
$categoryController
->index();


$currentCategory=
$categoryController
->show($id);

?>

<!DOCTYPE html>

<html>

<head>

<title>

<?php
echo htmlspecialchars(
$currentCategory['name']
);
?>

</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial;
}

body{
background:#f4f5f7;
}


.wrapper{

display:flex;

padding:30px;

gap:30px;

}


/* sidebar */

.sidebar{

width:280px;

background:white;

padding:25px;

border-radius:15px;

height:fit-content;

box-shadow:
0 2px 10px rgba(0,0,0,.1);

}

.sidebar h2{

margin-bottom:20px;

}


.sidebar a{

display:block;

padding:16px;

text-decoration:none;

color:black;

border-bottom:
1px solid #eee;

}


.sidebar a:hover{

background:#f7f7f7;

}


/* content */

.content{

flex:1;

background:white;

padding:30px;

border-radius:15px;

box-shadow:
0 2px 10px rgba(0,0,0,.1);

}


.content h1{

margin-bottom:30px;

color:#1d4fa5;

}


.book-grid{

display:grid;

grid-template-columns:
repeat(3,1fr);

gap:25px;

}


.card{

background:white;

padding:20px;

border-radius:12px;

box-shadow:
0 2px 10px rgba(0,0,0,.1);

}


.card img{

width:100%;

height:220px;

object-fit:cover;

border-radius:10px;

}


.card h3{

margin-top:15px;

}


.price{

font-size:25px;

color:#1d4fa5;

font-weight:bold;

margin:15px 0;

}


.btn{

width:100%;

padding:12px;

border:none;

cursor:pointer;

border-radius:8px;

color:white;

margin-top:10px;

}


.details{

background:#1d4fa5;

}


.cart{

background:#28a745;

}

</style>

</head>

<body>


<div class="wrapper">


<!-- sidebar -->

<div class="sidebar">

<h2>

Categories

</h2>


<?php

foreach(
$categories
as
$cat
)
{

?>

<a
href="category.php?id=<?php
echo $cat['id'];
?>">

<?php
echo htmlspecialchars(
$cat['name']
);
?>

</a>

<?php
}
?>

</div>



<!-- content -->

<div class="content">

<h1>

<?php
echo htmlspecialchars(
$currentCategory['name']
);
?>

</h1>


<div class="book-grid">

<?php

foreach(
$books
as
$book
)
{

?>

<div class="card">

<img
src="public/uploads/<?php
echo $book['image_path'];
?>">


<h3>

<?php
echo htmlspecialchars(
$book['title']
);
?>

</h3>


<p>

<?php
echo htmlspecialchars(
$book['author']
);
?>

</p>


<div class="price">

৳<?php
echo $book['price'];
?>

</div>



<a
href="views/book.php?id=<?php
echo $book['id'];
?>">

<button
class="btn details">

View Details

</button>

</a>



<button

class="btn cart"

onclick=
"addCart(<?php
echo $book['id'];
?>)"

>

Add To Cart

</button>


</div>

<?php
}
?>

</div>

</div>

</div>


<script>

function addCart(id)
{

fetch(

"api/cart.php",

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
r=>r.json()
)

.then(data=>{

alert(
"Added To Cart"
);

location.reload();

});

}

</script>

</body>

</html>