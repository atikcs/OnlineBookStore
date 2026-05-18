<?php

session_start();

include("../config/database.php");

$id=$_SESSION['user_id'];


/* update profile */

if(isset($_POST['update']))
{

$name=$_POST['name'];

$email=$_POST['email'];

$address=$_POST['address'];

$phone=$_POST['phone'];

$imageName="";


if(
isset($_FILES['picture']) &&
$_FILES['picture']['name']!="")
{

$imageName=
time().
$_FILES['picture']['name'];

move_uploaded_file(

$_FILES['picture']['tmp_name'],

"../public/uploads/".
$imageName

);

$stmt=$pdo->prepare(

"UPDATE users
SET name=?,
email=?,
address=?,
phone=?,
profile_picture=?
WHERE id=?"

);

$stmt->execute([

$name,
$email,
$address,
$phone,
$imageName,
$id

]);

}
else
{

$stmt=$pdo->prepare(

"UPDATE users
SET name=?,
email=?,
address=?,
phone=?
WHERE id=?"

);

$stmt->execute([

$name,
$email,
$address,
$phone,
$id

]);

}


$_SESSION['name']=$name;

header(
"Location:../profile.php?success=1"
);

exit();

}




/* change password */

if(isset($_POST['change_password']))
{

$current=
$_POST['current_password'];

$new=
$_POST['new_password'];

$stmt=$pdo->prepare(
"SELECT * FROM users WHERE id=?"
);

$stmt->execute([$id]);

$user=$stmt->fetch();


if(
password_verify(
$current,
$user['password_hash']
))
{

$newHash=
password_hash(
$new,
PASSWORD_DEFAULT
);

$stmt=$pdo->prepare(

"UPDATE users
SET password_hash=?
WHERE id=?"

);

$stmt->execute([

$newHash,
$id

]);

echo "Password Changed";

}
else
{

echo "Wrong current password";

}

}

?>