<?php

if(session_status()===PHP_SESSION_NONE)
{
session_start();
}

?>


<hr>

<div style="
display:flex;
justify-content:space-between;
align-items:center;
padding:15px 30px;
background:white;
">

<div>

<a
href="/OnlineBookStore/index.php"
style="
text-decoration:none;
font-size:22px;
font-weight:bold;
color:#1d4fa5;
">

🏠 Home

</a>

</div>



<div
style="
display:flex;
align-items:center;
gap:20px;
">

<a
href="/OnlineBookStore/views/cart.php"
style="
text-decoration:none;
color:black;
font-size:18px;
">

🛒 Cart

<span

id="cart-count"

style="
background:#1d4fa5;
color:white;
padding:4px 10px;
border-radius:50%;
font-size:14px;
margin-left:5px;
">

<?php

if(
isset($_SESSION['cart'])
)
{

echo
array_sum(
$_SESSION['cart']
);

}
else{

echo 0;

}

?>

</span>

</a>



<?php
if(
isset($_SESSION['user_id'])
)
{
?>

<a
href="/OnlineBookStore/profile.php">

Profile

</a>


|


<a
href="/OnlineBookStore/logout.php">

Logout

</a>

<?php
}
else
{
?>

<a
href="/OnlineBookStore/views/auth/login.php">

Login

</a>


|


<a
href="/OnlineBookStore/views/auth/register.php">

Register

</a>

<?php
}
?>

</div>

</div>