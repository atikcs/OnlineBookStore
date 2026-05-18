<?php

session_start();

if(
empty($_SESSION['csrf'])
)
{
$_SESSION['csrf']=
bin2hex(
random_bytes(32)
);
}

?>

<!DOCTYPE html>

<html>

<head>

<title>

Register

</title>

<link
rel="stylesheet"
href="../../public/css/auth.css">

<script
src="../../public/js/validation.js">

</script>

</head>

<body>


<div
style="
padding:20px;
position:absolute;
top:10px;
left:10px;
z-index:100;
">

<a
href="../../index.php"

style="
background:white;
color:#1d4fa5;
padding:12px 20px;
border-radius:10px;
text-decoration:none;
font-size:16px;
font-weight:bold;
box-shadow:0 4px 10px rgba(0,0,0,.2);
display:inline-block;
">

← Back To Home

</a>

</div>



<div class="container">

<div class="card">

<h1>

Create Account

</h1>


<form
name="regForm"
onsubmit="return validateRegister()"
action="../../controllers/AuthController.php"
method="POST">



<div class="input-box">

<input
type="text"
name="name"
placeholder="Full Name"
required>

</div>



<div class="input-box">

<input
type="email"
name="email"
placeholder="Email"
required>

</div>



<div class="input-box">

<input
type="password"
name="password"
placeholder="Password"
required>

</div>



<div class="input-box">

<input
type="text"
name="address"
placeholder="Address"
required>

</div>



<div class="input-box">

<input
type="text"
name="phone"
placeholder="Phone"
required>

</div>



<div class="input-box">

<select
name="role">

<option value="customer">

Customer

</option>


<option value="admin">

Admin

</option>

</select>

</div>



<input
type="hidden"
name="csrf"
value="<?php echo $_SESSION['csrf'];?>">



<button
class="btn"
name="register">

Register

</button>



<div
style="
text-align:center;
margin-top:20px;
">

Already have an account?

<a
href="login.php"

style="
color:#1d4fa5;
font-weight:bold;
text-decoration:none;
">

Login

</a>

</div>


</form>

</div>

</div>

</body>

</html>