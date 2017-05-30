<?php
session_start();
if(!isset($_SESSION['cppassBSI'])) {
   header('Location:index.php?msg=requires_login');
   exit;
}
?>