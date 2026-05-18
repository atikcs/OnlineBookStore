<?php

require_once(
"../config/database.php"
);

$q=
trim(
$_GET['q']
??''
);

$stmt=
$pdo->prepare(

"SELECT
id,
title,
price,
image_path

FROM books

WHERE title LIKE ?

LIMIT 8"

);

$stmt->execute([

"%".$q."%"

]);

$data=
$stmt->fetchAll(
PDO::FETCH_ASSOC
);

header(
"Content-Type:application/json"
);

echo json_encode(
$data
);

?>