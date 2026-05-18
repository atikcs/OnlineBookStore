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

$bookController=
new BookController(
$pdo
);

$categoryController=
new CategoryController(
$pdo
);


/* MVC */

$categories=
$categoryController
->index();

$books=
$bookController
->index();

?>

<!DOCTYPE html>

<html>

<head>

<title>

Online Book Store

</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link rel="stylesheet"
href="public/css/style.css">

<style>

.search-wrap{

position:relative;
width:100%;

}

#suggestions{

position:absolute;

top:100%;

width:100%;

background:white;

border:1px solid #ddd;

display:none;

max-height:350px;

overflow-y:auto;

z-index:999;

box-shadow:
0 3px 15px rgba(0,0,0,.1);

}

.suggestion-item{

display:flex;

gap:15px;

padding:12px;

text-decoration:none;

color:black;

border-bottom:
1px solid #eee;

}

.suggestion-item:hover{

background:#f5f5f5;

}

.suggestion-item img{

width:50px;
height:70px;

object-fit:cover;

}

</style>

</head>

<body>


<!-- TOP -->

<div class="topbar">

<div
style="
font-size:28px;
font-weight:bold;
color:#1d4fa5;
">

<i class="fa-solid fa-book-open"></i>

Online Book Store

</div>

<div>
<a href="#">

Help Center

</a>


<a href="views/trackOrder.php">

Track Order

</a>


<?php
if(
isset($_SESSION['user_id'])
)
{
?>

<a href="profile.php">

<?php
echo htmlspecialchars(
$_SESSION['name']
);
?>

</a>

<?php
}
?>

</div>

</div>



<div class="header">

<div class="logo">

<a
href="index.php"

style="
display:flex;
align-items:center;
gap:15px;
text-decoration:none;
color:#1d4fa5;
font-size:35px;
font-weight:bold;
">

<img

src="public/images/logo.jpg"

style="
width:60px;
height:60px;
border-radius:50%;
object-fit:cover;
"

>

Welcome

</a>

</div>


<div class="search">

<div class="search-wrap">


<form

action="search.php"

method="GET"

id="searchForm"

>

<input

id="searchBox"

name="query"

placeholder=
"Search books..."

autocomplete="off"

required

style="
padding:12px;
width:100%;
"

>

</form>


<div
id="suggestions">

</div>

</div>

</div>



<div>

<i class="fa-regular fa-heart"></i>

Wishlist

</div>

</div>



<!-- FILTERS -->

<div

style="
display:flex;
gap:15px;
padding:20px;
background:white;
"

>

<select
id="categoryFilter">

<option value="">

All Categories

</option>


<?php

foreach(
$categories
as
$cat
)
{

?>

<option
value="<?php
echo $cat['id'];
?>">

<?php

echo htmlspecialchars(
$cat['name']
);

?>

</option>

<?php

}

?>

</select>



<input

id="authorFilter"

placeholder=
"Search author"

style="
padding:10px;
"

>

</div>



<!-- MENU -->

<div class="menu">

<a href="index.php">

Home

</a>

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



<!-- HERO -->

<div class="hero">

<div class="left">

<h1>

BIG SALE

</h1>

<h2>

UP TO 35% OFF

</h2>

<a
href="category.php?id=1">

<button>

Shop Now

</button>

</a>

</div>



<div class="right">

<img

src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=1200"

width="500">

</div>

</div>



<h2>

Featured Books

</h2>



<div
class="book-grid"
id="book-list">

<?php

foreach(
$books
as
$book
)
{

?>

<div class="card">

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

<h4>
৳<?php
echo $book['price'];
?>
</h4>

<p>
<?php
echo htmlspecialchars(
$book['description']
);
?>
</p>


<div
style="
margin-top:15px;
display:flex;
flex-direction:column;
gap:10px;
">

<a
href="views/book.php?id=<?php
echo $book['id'];
?>">

<button
style="
width:100%;
padding:12px;
">

View Details

</button>

</a>


<button

onclick="
addCart(
<?php echo $book['id']; ?>
)
"

style="
width:100%;
padding:12px;
background:#28a745;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
"

>

Add To Cart

</button>

</div>

</div>

<?php

}

?>

</div>



<script>

let box=
document.getElementById(
"searchBox"
);


box.addEventListener(
"keyup",
function()
{

let q=
this.value;


if(
q.length<1
)
{

document
.getElementById(
"suggestions"
)
.style.display=
"none";

return;

}


fetch(
"api/search.php?q="
+q
)

.then(
r=>r.json()
)

.then(data=>{

let html="";


data.forEach(book=>{


html+=`

<a

class="suggestion-item"

href="views/book.php?id=${book.id}"

>

<img

src="public/uploads/${book.image_path}"

>

<div>

<div>

${book.title}

</div>

<div
style="
color:#1d4fa5;
">

৳${book.price}

</div>

</div>

</a>

`;

});


let s=
document.getElementById(
"suggestions"
);

s.innerHTML=
html;

s.style.display=
"block";

});

});


document
.addEventListener(
"click",
function(e)
{

if(
!e.target.closest(
".search-wrap"
)
)
{

document
.getElementById(
"suggestions"
)
.style.display=
"none";

}

});

</script>


<script
src="public/js/search.js">
</script>

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
"Added to cart"
);

location.reload();

});

}

</script>

</body>

</html>