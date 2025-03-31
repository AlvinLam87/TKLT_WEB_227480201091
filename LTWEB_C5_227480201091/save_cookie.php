<?php

$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';


$cookie_lifetime = time() + 600;


setcookie("customer_name", $name, $cookie_lifetime);
setcookie("customer_phone", $phone, $cookie_lifetime);


header("Location: show_cookie.php");
exit();
?>
