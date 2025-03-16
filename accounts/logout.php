<?php
require_once '../includes/hidden.php';

session_start();
session_destroy();
redirect(url('accounts/login.php'));
exit;
?>