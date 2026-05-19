<?php

session_start();

require_once(
"../config/database.php"
);

require_once(
"../models/User.php"
);

if(
!isset($_SESSION['role']) ||
$_SESSION['role']!="admin"
)
{
header(
"Location:../index.php"
);
exit();
}

$userModel=
new User($pdo);

$user=
$userModel->getById(
$_SESSION['user_id']
);

?>

<!DOCTYPE html>
<html>

<head>

<title>

Admin Profile

</title>

<style>

body{

margin:0;
font-family:Arial,sans-serif;

background:
linear-gradient(
135deg,
#1d4fa5,
#6ea8ff
);

min-height:100vh;

padding:40px;

}

.top{

display:flex;

justify-content:
space-between;

align-items:center;

margin-bottom:30px;

}

.back{

background:white;

color:#1d4fa5;

padding:12px 22px;

border-radius:10px;

text-decoration:none;

font-weight:bold;

box-shadow:
0 4px 10px rgba(0,0,0,.2);

}

.back:hover{

transform:translateY(-2px);

}

.card{

max-width:650px;

margin:auto;

background:white;

padding:40px;

border-radius:25px;

box-shadow:
0 10px 30px rgba(0,0,0,.2);

}

h1{

color:#1d4fa5;

text-align:center;

margin-bottom:30px;

}

input{

width:100%;

padding:14px;

margin-top:10px;

margin-bottom:20px;

border:1px solid #ddd;

border-radius:10px;

font-size:16px;

}

button{

width:100%;

padding:14px;

border:none;

border-radius:10px;

background:#1d4fa5;

color:white;

font-size:18px;

cursor:pointer;

margin-top:10px;

}

button:hover{

background:#153a7a;

}

.success{

background:#d4edda;

padding:15px;

color:green;

border-radius:10px;

margin-bottom:20px;

}

.section{

margin-top:35px;

padding-top:20px;

border-top:
1px solid #eee;

}

</style>

</head>

<body>

<div class="top">

<a
class="back"
href="dashboard.php">

← Back To Dashboard

</a>

</div>


<div class="card">

<h1>

Admin Profile

</h1>


<?php
if(isset($_GET['updated']))
{
?>

<div class="success">

Profile Updated Successfully

</div>

<?php
}
?>


<?php
if(isset($_GET['password']))
{
?>

<div class="success">

Password Changed Successfully

</div>

<?php
}
?>


<form
action="../controllers/AuthController.php"
method="POST">

<input
type="text"
name="name"
value="<?php echo $user['name'];?>"
placeholder="Name"
required>


<input
type="email"
name="email"
value="<?php echo $user['email'];?>"
placeholder="Email"
required>


<input
type="text"
name="address"
value="<?php echo $user['address'];?>"
placeholder="Address">


<input
type="text"
name="phone"
value="<?php echo $user['phone'];?>"
placeholder="Phone">


<button
name="updateProfile">

Save Profile

</button>

</form>



<div class="section">

<h2>

Change Password

</h2>

<form
action="../controllers/AuthController.php"
method="POST">

<input
type="password"
name="password"
placeholder="New Password"
required>

<button
name="changePassword">

Change Password

</button>

</form>

</div>

</div>

</body>

</html>