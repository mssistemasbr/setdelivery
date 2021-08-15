﻿<script type="text/javascript" src="./assets/js/jquery.min.js"></script>
<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

if (isset($_SESSION["ID_USUARIO"]) || isset($_SESSION["ID_EMPRESA"])) {
    session_unset();
    session_destroy();
    unset($_SESSION["ID_USUARIO"]);
    unset($_SESSION["ID_EMPRESA"]);
    echo "<script>location.href='index.php';</script>";
} else {
    echo 'teste';
}
?>

