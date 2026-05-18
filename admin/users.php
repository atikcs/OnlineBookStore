<?php

session_start();

require_once(
"../config/database.php"
);

require_once(
"../controllers/UserController.php"
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
new UserController(
$pdo
);


/* ajax delete still works */

$users=
$controller
->index();

?>
<!DOCTYPE html>
<html>

<head>

<title>Users</title>

<style>

body{
font-family:Arial;
background:#f4f5f7;
margin:0;
}

.top{

background:#1d4fa5;

padding:20px;

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

table{

width:100%;

background:white;

border-collapse:collapse;

}

th,td{

padding:15px;

border:1px solid #ddd;

text-align:center;

}

img{

width:60px;
height:60px;
border-radius:50%;
object-fit:cover;

}

button{

background:red;

color:white;

border:none;

padding:8px 12px;

cursor:pointer;

}

</style>

</head>

<body>


<div class="top">

<div>

Registered Users

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

<table>

<tr>

<th>ID</th>

<th>Picture</th>

<th>Name</th>

<th>Email</th>

<th>Role</th>

<th>Phone</th>

<th>Date</th>

<th>Action</th>

</tr>


<?php
foreach($users as $user)
{
?>

<tr>

<td>

<?php echo $user['id']; ?>

</td>


<td>

<?php

if(
!empty(
$user['profile_picture']
)
)
{
?>

<img
src="../public/uploads/<?php echo $user['profile_picture']; ?>">

<?php
}
else
{
echo "No Image";
}
?>

</td>


<td>

<?php
echo htmlspecialchars(
$user['name']
);
?>

</td>


<td>

<?php
echo htmlspecialchars(
$user['email']
);
?>

</td>


<td>

<?php
echo $user['role'];
?>

</td>


<td>

<?php
echo $user['phone'];
?>

</td>


<td>

<?php
echo $user['created_at'];
?>

</td>


<td>

<?php
if(
$user['role']=="customer"
)
{
?>

<button
onclick=
"deleteUser(<?php echo $user['id'];?>)">

Delete

</button>

<?php
}
else
{
echo "Admin";
}
?>

</td>

</tr>

<?php
}
?>

</table>

</div>


<script>

function deleteUser(id)
{

if(
!confirm(
"Delete customer?"
)
)
return;


fetch(
"deleteUserAjax.php",
{

method:"POST",

headers:{
"Content-Type":
"application/x-www-form-urlencoded"
},

body:
"id="+id

})

.then(
r=>r.json()
)

.then(data=>{

if(data.success)
{

location.reload();

}
else
{

alert("Failed");

}

})

}

</script>

</body>

</html>