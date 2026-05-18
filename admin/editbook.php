<?php

session_start();

require_once("../config/database.php");

require_once("../controllers/BookController.php");

require_once("../controllers/CategoryController.php");


if(
!isset($_SESSION['role'])
||
$_SESSION['role']!="admin"
)
{
header("Location:../index.php");
exit();
}


$bookController=
new BookController($pdo);

$categoryController=
new CategoryController($pdo);


$id=
(int)$_GET['id'];


/* MVC */

$categories=
$categoryController
->index();

$book=
$bookController
->show($id);


if(!$book)
{
die("Book not found");
}


$error="";


if(isset($_POST['submit']))
{

$title=
trim($_POST['title']);

$author=
trim($_POST['author']);

$description=
trim($_POST['description']);

$price=
(float)$_POST['price'];

$category=
(int)$_POST['category'];

$stock=
(int)$_POST['stock'];

$imageName=
$book['image_path'];


/* validation */

if(
empty($title)
||
empty($author)
)
{
$error=
"Fill all fields";
}

elseif(
$price<=0
)
{
$error=
"Price must be positive";
}

else
{

if(
!empty(
$_FILES['image']['name']
)
)
{

$imageType=
mime_content_type(
$_FILES['image']['tmp_name']
);

$allowed=
[
'image/jpeg',
'image/png'
];


if(
!in_array(
$imageType,
$allowed
)
)
{
$error=
"Only JPG/PNG allowed";
}

elseif(
$_FILES['image']['size']
>
2*1024*1024
)
{
$error=
"Image max 2MB";
}

else
{

$old=
"../public/uploads/".
$book['image_path'];

if(
file_exists($old)
&&
$book['image_path']!=""
)
{
unlink($old);
}


$imageName=
time().
$_FILES['image']['name'];

move_uploaded_file(

$_FILES['image']['tmp_name'],

"../public/uploads/".
$imageName

);

}

}


if($error=="")
{

$bookController
->update(

$id,

$title,

$author,

$description,

$price,

$category,

$imageName,

$stock

);


header(
"Location:books.php"
);

exit();

}

}

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Book</title>

<style>

body{
font-family:Arial;
background:#f4f5f7;
}

.box{
width:700px;
margin:40px auto;
background:white;
padding:30px;
border-radius:10px;
}

input,
textarea,
select{
width:100%;
padding:14px;
margin-top:10px;
margin-bottom:20px;
border:1px solid #ddd;
border-radius:8px;
}

button{
width:100%;
padding:14px;
background:#1d4fa5;
color:white;
border:none;
border-radius:8px;
}

img{
width:120px;
height:150px;
object-fit:cover;
margin-bottom:20px;
}

.error{
color:red;
margin-bottom:20px;
}

</style>

</head>

<body>

<div class="box">

<h1>Edit Book</h1>

<?php
if($error!="")
{
?>
<div class="error">

<?php echo $error;?>

</div>
<?php
}
?>


<form
method="POST"
enctype="multipart/form-data">


<input
name="title"
value="<?php echo htmlspecialchars($book['title']); ?>">


<input
name="author"
value="<?php echo htmlspecialchars($book['author']); ?>">


<textarea
name="description"><?php
echo htmlspecialchars(
$book['description']
);
?></textarea>


<input
type="number"
step="0.01"
name="price"
value="<?php echo $book['price'];?>">


<select name="category">

<?php
foreach($categories as $cat)
{
?>

<option

value="<?php
echo $cat['id'];
?>"

<?php
if(
$cat['id']==$book['category_id']
)
echo"selected";
?>

>

<?php
echo $cat['name'];
?>

</option>

<?php
}
?>

</select>


<input
type="number"
name="stock"
value="<?php echo $book['stock'];?>">


<img
src="../public/uploads/<?php echo $book['image_path'];?>">


<input
type="file"
name="image">


<button
name="submit">

Update Book

</button>

</form>

</div>

<script>

document
.querySelector("form")
.addEventListener(
"submit",
function(e){

let price=
document.querySelector(
"[name='price']"
).value;

if(price<=0){

alert(
"Price must be positive"
);

e.preventDefault();

}

});

</script>

</body>
</html>