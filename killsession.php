<?php
include_once "connect.php";
unset($_SESSION["account"]);
unset($_SESSION["currentpage"]);
session_destroy();
?>