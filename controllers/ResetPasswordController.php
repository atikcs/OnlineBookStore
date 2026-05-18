<?php

if(isset($_POST['reset']))
{

$email=$_POST['email'];

?>

<!DOCTYPE html>

<html>

<head>

<title>

Reset Password

</title>

</head>

<body
style="
font-family:Arial;
text-align:center;
padding-top:50px;
">

<div
style="
position:absolute;
top:20px;
left:20px;
">

<a
href="../index.php"

style="
text-decoration:none;
background:#1d4fa5;
color:white;
padding:10px 18px;
border-radius:8px;
font-weight:bold;
">

← Home

</a>

</div>


<h1>

Password reset feature coming soon

</h1>

<br>

<h2>

Email:
<?php
echo $email;
?>

</h2>

</body>

</html>

<?php

}

?>