<?php

class Book{

private $pdo;


public function __construct($pdo)
{
$this->pdo=$pdo;
}


/* all books */

public function getAll()
{

$stmt=
$this->pdo->query(

"SELECT

books.*,

categories.name
AS category

FROM books

LEFT JOIN categories

ON categories.id=
books.category_id

ORDER BY books.id DESC"

);

return
$stmt->fetchAll(
PDO::FETCH_ASSOC
);

}


/* featured books */

public function featured()
{

$stmt=
$this->pdo->query(

"SELECT *

FROM books

ORDER BY created_at DESC

LIMIT 6"

);

return
$stmt->fetchAll(
PDO::FETCH_ASSOC
);

}


/* single book */

public function getById($id)
{

$stmt=
$this->pdo->prepare(

"SELECT

books.*,

categories.name
AS category

FROM books

LEFT JOIN categories

ON categories.id=
books.category_id

WHERE books.id=?"

);

$stmt->execute([
$id
]);

return
$stmt->fetch(
PDO::FETCH_ASSOC
);

}


/* category books */

public function category($id)
{

$stmt=
$this->pdo->prepare(

"SELECT

books.*,

categories.name
AS category

FROM books

LEFT JOIN categories

ON categories.id=
books.category_id

WHERE books.category_id=?"

);

$stmt->execute([
$id
]);

return
$stmt->fetchAll(
PDO::FETCH_ASSOC
);

}


/* search */

public function search(
$q,
$category,
$author
)
{

$sql="SELECT

books.*,

categories.name
AS category

FROM books

LEFT JOIN categories

ON books.category_id=
categories.id

WHERE 1=1";


$params=[];


if($q!="")
{

$sql.=
" AND books.title LIKE ?";

$params[]=
"%$q%";

}


if($category!="")
{

$sql.=
" AND categories.id=?";

$params[]=
$category;

}


if($author!="")
{

$sql.=
" AND books.author LIKE ?";

$params[]=
"%$author%";

}


$stmt=
$this->pdo->prepare(
$sql
);

$stmt->execute(
$params
);

return
$stmt->fetchAll(
PDO::FETCH_ASSOC
);

}


/* create */

public function create(

$title,
$author,
$description,
$price,
$category,
$image,
$stock

)
{

$stmt=
$this->pdo->prepare(

"INSERT INTO books

(title,
author,
description,
price,
category_id,
image_path,
stock)

VALUES
(?,?,?,?,?,?,?)"

);


return
$stmt->execute([

$title,
$author,
$description,
$price,
$category,
$image,
$stock

]);

}


/* update */

public function update(

$id,
$title,
$author,
$description,
$price,
$category,
$image,
$stock

)

{

$stmt=
$this->pdo->prepare(

"UPDATE books

SET

title=?,
author=?,
description=?,
price=?,
category_id=?,
image_path=?,
stock=?

WHERE id=?"

);


return
$stmt->execute([

$title,
$author,
$description,
$price,
$category,
$image,
$stock,
$id

]);

}


/* delete */

public function delete($id)
{

$stmt=
$this->pdo->prepare(

"DELETE FROM books
WHERE id=?"

);

return
$stmt->execute([
$id
]);

}

}