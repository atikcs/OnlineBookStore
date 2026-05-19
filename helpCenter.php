<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>

<title>
Help Center
</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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

}


/* navbar */

.navbar{

background:white;

padding:18px 50px;

display:flex;

justify-content:space-between;

align-items:center;

box-shadow:
0 4px 15px rgba(0,0,0,.1);

}

.logo{

font-size:30px;

font-weight:bold;

color:#1d4fa5;

}

.nav-links a{

margin-left:25px;

text-decoration:none;

font-size:18px;

color:#333;

font-weight:bold;

}

.nav-links a:hover{

color:#1d4fa5;

}


/* container */

.container{

display:flex;

justify-content:center;

align-items:center;

padding:60px;

}


.card{

background:white;

width:700px;

padding:40px;

border-radius:25px;

box-shadow:
0 10px 30px rgba(0,0,0,.2);

text-align:center;

animation:fade 1s;

}


@keyframes fade{

from{

opacity:0;
transform:translateY(30px);

}

to{

opacity:1;
transform:translateY(0);

}

}


.card h1{

color:#1d4fa5;

font-size:40px;

margin-bottom:20px;

}


.team{

background:#f3f6ff;

padding:20px;

border-radius:15px;

margin-top:25px;

}


.team h2{

color:#1d4fa5;

}


.member{

padding:8px;

font-size:20px;

}


.contact{

margin-top:30px;

text-align:left;

font-size:20px;

line-height:45px;

}


.contact i{

width:40px;

color:#1d4fa5;

}


.btn{

margin-top:30px;

background:#1d4fa5;

color:white;

padding:14px 30px;

border-radius:10px;

text-decoration:none;

display:inline-block;

font-size:18px;

font-weight:bold;

}


.btn:hover{

background:#153a7a;

}

</style>

</head>

<body>


<div class="navbar">

<div class="logo">

📘 Online Book Store

</div>

<div class="nav-links">

<a href="index.php">

Home

</a>

<a href="trackOrder.php">

Track Order

</a>

</div>

</div>



<div class="container">

<div class="card">

<h1>

Help Center

</h1>

<p>

Need support? Contact our team.

</p>


<div class="team">

<h2>

Team Members

</h2>

<div class="member">
Atik
</div>

<div class="member">
Labib
</div>

<div class="member">
Mishal
</div>

<div class="member">
Eeron
</div>

</div>


<div class="contact">

<div>

<i class="fa-solid fa-phone"></i>

Phone :
01791944937

</div>


<div>

<i class="fa-solid fa-fax"></i>

Fax :
+8802564545

</div>


<div>

<i class="fa-solid fa-envelope"></i>

Mail :
support@onlinebook.com

</div>

</div>


<a
href="index.php"
class="btn">

← Back Home

</a>

</div>

</div>

</body>

</html>