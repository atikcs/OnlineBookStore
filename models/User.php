<?php

class User{

private $pdo;

public function __construct($pdo)
{
$this->pdo=$pdo;
}


/* LOGIN */

public function findByEmail($email)
{

$stmt=
$this->pdo->prepare(

"SELECT *
FROM users
WHERE email=?"

);

$stmt->execute([
$email
]);

return
$stmt->fetch(
PDO::FETCH_ASSOC
);

}


/* REGISTER */

public function register(
$name,
$email,
$password,
$address,
$phone,
$role="customer"
)
{

$hash=
password_hash(
$password,
PASSWORD_DEFAULT
);


$stmt=
$this->pdo->prepare(

"INSERT INTO users
(
name,
email,
password_hash,
role,
address,
phone
)

VALUES
(
?,?,?,?,?,?
)"

);


return
$stmt->execute([

$name,
$email,
$hash,
$role,
$address,
$phone

]);

}



/* PROFILE */

public function getById($id)
{

$stmt=
$this->pdo->prepare(

"SELECT *
FROM users
WHERE id=?"

);

$stmt->execute([
$id
]);

return
$stmt->fetch(
PDO::FETCH_ASSOC
);

}



/* UPDATE PROFILE */

public function updateProfile(
$id,
$name,
$email,
$address,
$phone
)
{

$stmt=
$this->pdo->prepare(

"UPDATE users

SET

name=?,
email=?,
address=?,
phone=?

WHERE id=?"

);

return
$stmt->execute([

$name,
$email,
$address,
$phone,
$id

]);

}



/* CHANGE PASSWORD */

public function changePassword(
$id,
$password
)
{

$hash=
password_hash(
$password,
PASSWORD_DEFAULT
);

$stmt=
$this->pdo->prepare(

"UPDATE users

SET password_hash=?

WHERE id=?"

);

return
$stmt->execute([

$hash,
$id

]);

}



/* ALL CUSTOMERS */

public function getCustomers()
{

$stmt=
$this->pdo->query(

"SELECT *
FROM users

WHERE role='customer'"

);

return
$stmt->fetchAll(
PDO::FETCH_ASSOC
);

}



/* DELETE CUSTOMER */

public function deleteCustomer($id)
{

$stmt=
$this->pdo->prepare(

"DELETE FROM users

WHERE id=?
AND role='customer'"

);

return
$stmt->execute([
$id
]);

}

}

?>