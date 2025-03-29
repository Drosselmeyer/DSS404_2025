<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
  setcookie(session_name(), '', 100);
  session_unset();
  session_destroy();
  $_SESSION = array();
  
  header("Location: inicio.php");
  exit();
}
?>