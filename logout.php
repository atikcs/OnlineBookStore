<?php

session_start();

/* clear session */
session_unset();

session_destroy();

/* remove remember cookie */
setcookie(
"remember",
"",
time()-3600,
"/"
);

header("Location:index.php");
exit();

?>