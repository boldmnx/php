<?php
require_once 'db.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function isLoggedIn()
{
  return isset($_SESSION['user_id']);
}

function isAdmin()
{
  return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}
