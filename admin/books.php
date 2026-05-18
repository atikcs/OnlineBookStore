<?php

session_start();

require_once(
"../config/database.php"
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


$controller=
new BookController(
$pdo
);


/* delete */

if(
isset($_GET['delete'])
)
{

$controller
->destroy(
(int)$_GET['delete']
);

header(
"Location:books.php"
);

exit();

}


/* MVC */

$books=
$controller
->index();

?>


<!DOCTYPE html>

<html>

<head>

<title>

Manage Books

</title>

<style>

body{

margin:0;
font-family:Arial;
background:#f4f5f7;

}

.top{

background:#1d4fa5;
padding:25px;
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

.add{

background:#1d4fa5;
padding:15px 25px;
color:white;
text-decoration:none;
border-radius:10px;

}

table{

width:100%;
margin-top:25px;
background:white;
border-collapse:collapse;

}

th,td{

padding:18px;
border:1px solid #ddd;
text-align:center;

}

img{

width:80px;
height:100px;
object-fit:cover;

}

.edit{

color:green;
text-decoration:none;

}

.delete{

color:red;
text-decoration:none;

}

</style>

</head>

<body>

<div class="top">

<div>

Manage Books

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

<a
class="add"
href="addBook.php">

+ Add Book

</a>


<table>

<tr>

<th>ID</th>

<th>Image</th>

<th>Title</th>

<th>Author</th>

<th>Price</th>

<th>Category</th>

<th>Stock</th>

<th>Action</th>

</tr>


<?php

foreach(
$books
as
$book
)
{

?>

<tr>

<td>

<?php
echo
$book['id'];
?>

</td>


<td>

<img

src="../public/uploads/<?php
echo
$book['image_path'];
?>"

>

</td>


<td>

<?php
echo
$book['title'];
?>

</td>


<td>

<?php
echo
$book['author'];
?>

</td>


<td>

৳<?php
echo
$book['price'];
?>

</td>


<td>

<?php
echo
$book['category'];
?>

</td>


<td>

<?php
echo
$book['stock'];
?>

</td>


<td>

<a
class="edit"

href="editBook.php?id=<?php
echo
$book['id'];
?>">

Edit

</a>

|

<a

class="delete"

onclick=
"return confirm('Delete?')"

href=
"books.php?delete=<?php
echo
$book['id'];
?>">

Delete

</a>

</td>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>