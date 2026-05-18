<?php

session_start();

require_once(
"../config/database.php"
);

require_once(
"../models/User.php"
);


header(
"Content-Type: application/json"
);


/* admin protection */

if(
!isset($_SESSION['role'])
||
$_SESSION['role']!="admin"
)
{

echo json_encode([

"success"=>false,

"message"=>
"Unauthorized"

]);

exit();

}


/* validate id */

if(
!isset($_POST['id'])
)
{

echo json_encode([

"success"=>false,

"message"=>
"Missing user id"

]);

exit();

}


$id=
(int)$_POST['id'];


/* model */

$userModel=
new User(
$pdo
);


$ok=
$userModel
->deleteCustomer(
$id
);


echo json_encode([

"success"=>$ok,

"message"=>

$ok
?
"Customer deleted"
:
"Delete failed"

]);

?>