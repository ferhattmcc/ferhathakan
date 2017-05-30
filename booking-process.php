<?php
session_start();
include("includes/db.conn.php");
include("includes/conf.class.php");
$row_default_lang=mysql_fetch_assoc(mysql_query("select * from bsi_language where `lang_default`=true"));
include("languages/".$row_default_lang['lang_file']);

$pos2 = strpos($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME']);
if(!$pos2){
	header('Location: booking-failure.php?error_code=9');
}
include("includes/mail.class.php");
include("includes/process.class.php");
$bookprs = new BookingProcess();

?>