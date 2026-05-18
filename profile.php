<?php

session_start();

include("config/database.php");

if(!isset($_SESSION['user_id']))
{
header("Location:views/auth/login.php");
exit();
}

$id=$_SESSION['user_id'];

$stmt=$pdo->prepare(
"SELECT * FROM users WHERE id=?"
);

$stmt->execute([$id]);

$user=$stmt->fetch();

?>

<!DOCTYPE html>

<html>

<head>
<title>Profile</title>
</head>

<body>

<?php include("views/navbar.php"); ?>

<link
rel="stylesheet"
href="public/css/auth.css">


<div class="container">

<div class="card">

<div
style="text-align:center;">

<?php

if(
!empty(
$user['profile_picture']
))
{
?>

<img

src="public/uploads/<?php
echo $user['profile_picture'];
?>"

style="
width:120px;
height:120px;
border-radius:50%;
object-fit:cover;
margin-bottom:20px;
">

<?php
}
else
{
?>

<img

src="https://cdn-icons-png.flaticon.com/512/149/149071.png"

style="
width:120px;
height:120px;
border-radius:50%;
margin-bottom:20px;
">

<?php
}
?>

<h1>

My Profile

</h1>

</div>


<?php

if(isset($_GET['success']))
{

echo"

<p
style='color:green'>

Profile Updated Successfully

</p>

";

}

?>


<form
action=
"controllers/ProfileController.php"

method="POST"

enctype=
"multipart/form-data"

>


<div class="input-box">

<input
type="text"
name="name"
value="<?php echo htmlspecialchars($user['name']); ?>">

</div>


<div class="input-box">

<input
type="email"
name="email"
value="<?php echo htmlspecialchars($user['email']); ?>">

</div>


<div class="input-box">

<input
type="text"
name="address"
value="<?php echo htmlspecialchars($user['address']); ?>">

</div>


<div class="input-box">

<input
type="text"
name="phone"
value="<?php echo htmlspecialchars($user['phone']); ?>">

</div>


<div class="input-box">

<input
type="file"
name="picture">

</div>


<button
class="btn"
name="update">

Update Profile

</button>

</form>

<hr>

<h3>

Change Password

</h3>


<form
action=
"controllers/ProfileController.php"

method="POST">

<div class="input-box">

<input
type="password"
name="current_password"
placeholder="Current Password">

</div>


<div class="input-box">

<input
type="password"
name="new_password"
placeholder="New Password">

</div>


<button
class="btn"
name="change_password">

Change Password

</button>

</form>

</div>

</div>

</body>
</html>