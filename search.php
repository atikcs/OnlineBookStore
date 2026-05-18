<?php

session_start();

require_once(
"config/database.php"
);

require_once(
"controllers/BookController.php"
);

$controller=
new BookController(
$pdo
);


$query=
trim(
$_GET['query']
??''
);


$books=[];

if(
$query!=""
)
{

$books=
$controller
->search(
$query
);

}

?>

<!DOCTYPE html>

<html>

<head>

<title>

Search Results

</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
font-family:Arial;
background:#f4f5f7;
margin:0;
}

.header{

background:white;

padding:20px;

display:flex;

justify-content:space-between;

align-items:center;

}

.logo{

font-size:35px;

font-weight:bold;

color:#1d4fa5;

text-decoration:none;

}

.container{

padding:30px;

}

.grid{

display:grid;

grid-template-columns:
repeat(4,1fr);

gap:20px;

}

.card{

background:white;

padding:15px;

border-radius:10px;

box-shadow:
0 2px 10px rgba(0,0,0,.1);

}

.price{

font-size:22px;

font-weight:bold;

color:#1d4fa5;

}

</style>

</head>

<body>

<div class="header">

<a
href="index.php"
class="logo">

📚 BookStore

</a>

<a
href="index.php">

Home

</a>

</div>


<div class="container">

<h2>

Search Results for:

"<?php echo htmlspecialchars($search); ?>"

</h2>

<br>


<?php

if(count($books)==0)
{

echo
"<h3>No books found</h3>";

}
else
{

?>

<div class="grid">

<?php

foreach($books as $book)
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

<div class="price">

৳<?php
echo $book['price'];
?>

</div>

</div>

<?php

}

?>

</div>

<?php
}
?>

</div>

</body>

</html>