<?php

session_start();

require_once(
"../config/database.php"
);

require_once(
"../models/User.php"
);


$userModel=
new User($pdo);


/* ======================
CSRF
====================== */

if(
isset($_POST['csrf']) &&
isset($_SESSION['csrf']) &&
$_POST['csrf']!==$_SESSION['csrf']
)
{

die(
"Invalid CSRF token"
);

}



/* ======================
REGISTRATION
====================== */

if(
isset($_POST['register'])
)
{

$name=
trim(
$_POST['name']
);

$email=
trim(
$_POST['email']
);

$password=
$_POST['password'];

$address=
trim(
$_POST['address']
);

$phone=
trim(
$_POST['phone']
);

$role=
$_POST['role'];



if(
!filter_var(
$email,
FILTER_VALIDATE_EMAIL
)
)
{

header(
"Location:../views/auth/register.php?error=email"
);

exit();

}



if(
strlen($password)<8
)
{

header(
"Location:../views/auth/register.php?error=password"
);

exit();

}



/* email exists */

$existing=
$userModel
->findByEmail(
$email
);


if(
$existing
)
{

header(
"Location:../views/auth/register.php?error=exists"
);

exit();

}



/* create account */

$userModel
->register(

$name,
$email,
$password,
$address,
$phone,
$role

);



header(
"Location:../views/auth/login.php?success=1"
);

exit();

}





/* ======================
LOGIN
====================== */

if(
isset($_POST['login'])
)
{

$email=
trim(
$_POST['email']
);

$password=
$_POST['password'];



$user=
$userModel
->findByEmail(
$email
);



if(
$user &&
password_verify(
$password,
$user['password_hash']
)
)
{

$_SESSION['user_id']
=
$user['id'];

$_SESSION['name']
=
$user['name'];

$_SESSION['role']
=
$user['role'];



if(
isset($_POST['remember'])
)
{

setcookie(

"remember",

$user['id'],

time()+86400*30,

"/"

);

}



/* admin/customer redirect */

if(
$_SESSION['role']=="admin"
)
{

header(
"Location:../admin/dashboard.php"
);

exit();

}
else
{

header(
"Location:../index.php"
);

exit();

}

}
else
{

header(
"Location:../views/auth/login.php?error=1"
);

exit();

}

}




/* ======================
UPDATE PROFILE
====================== */

if(
isset($_POST['updateProfile'])
)
{

$userModel
->updateProfile(

$_SESSION['user_id'],

trim($_POST['name']),

trim($_POST['email']),

trim($_POST['address']),

trim($_POST['phone'])

);


$_SESSION['name']
=
$_POST['name'];


header(
"Location:../admin/profile.php?updated=1"
);

exit();

}



/* ======================
CHANGE PASSWORD
====================== */

if(
isset($_POST['changePassword'])
)
{

if(
strlen($_POST['password'])<8
)
{

header(
"Location:../admin/profile.php?error=password"
);

exit();

}


$userModel
->changePassword(

$_SESSION['user_id'],

$_POST['password']

);


header(
"Location:../admin/profile.php?password=1"
);

exit();

}

?>