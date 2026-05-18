<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>

<title>

Forgot Password

</title>

<link
rel="stylesheet"
href="../../public/css/auth.css">

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
href="login.php"

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

← Back To Login

</a>

</div>


<div class="container">

<div class="card">

<h1>

Forgot Password

</h1>

<p
style="
text-align:center;
margin-bottom:20px;
">

Enter your email to reset password

</p>


<form
action="../../controllers/ResetPasswordController.php"
method="POST">


<div class="input-box">

<input
type="email"
name="email"
placeholder="Enter Email"
required>

</div>


<button
class="btn"
type="submit"
name="reset">

Send Reset Link

</button>

</form>

</div>

</div>

</body>

</html>