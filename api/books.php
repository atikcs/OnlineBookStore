<?php

require_once(
"../config/database.php"
);

require_once(
"../controllers/SearchController.php"
);

header(
"Content-Type: application/json"
);


$q=
$_GET['q']
??"";


$category=
$_GET['category']
??"";


$author=
$_GET['author']
??"";


$search=
new SearchController(
$pdo
);


$books=

$search->search(

$q,
$category,
$author

);


echo json_encode(
$books
);

?>