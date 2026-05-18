<?php
if(isset($_GET['success']))
{
?>

<div
style="
background:#d4edda;
padding:15px;
margin:20px auto;
width:400px;
color:green;
border-radius:8px;
text-align:center;
font-weight:bold;
">

Registration successful.
Please login.

</div>

<?php
}
?>

<!DOCTYPE html>

<html>

<head>

<title>

Login

</title>

<link
rel="stylesheet"
href="../../public/css/auth.css">

<style>

.options{

display:flex;

justify-content:space-between;

align-items:center;

margin:15px 0;

font-size:14px;

}

.options a{

color:#1d4fa5;

text-decoration:none;

font-weight:bold;

}

.options a:hover{

text-decoration:underline;

}

</style>

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

Login

</h1>


<form
action="../../controllers/AuthController.php"
method="POST">


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



<div class="options">

<label>

<input
type="checkbox"
name="remember">

Remember Me

</label>


<a
href="forgotPassword.php">

Forgot Password?

</a>

</div>



<button
class="btn"
name="login"
type="submit">

Login

</button>



<div
class="link"
style="
margin-top:20px;
">

No account?

<a href="register.php">

Register

</a>

</div>

</form>

</div>

</div>

</body>

</html>