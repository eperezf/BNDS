<?php

$cookie_name = "ACCESO";
$cookie_value = "TRUE";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

echo "AHORA PUEDES ACCEDER A BNDS";

?>