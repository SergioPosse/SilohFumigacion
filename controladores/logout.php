<?php
session_start();
session_destroy();
echo "Cerrando sesion..";
header( "refresh:2; url=../login.php" );
?>