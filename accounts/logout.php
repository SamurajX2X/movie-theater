<?php
require_once '../includes/hidden.php';

// wyloguj 
session_destroy();
redirect(url('accounts/login.php'));
exit;
?>