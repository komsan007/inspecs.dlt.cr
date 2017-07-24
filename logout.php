<?php
session_start();
unset($_SESSION['ses_userid']);
unset($_SESSION['ses_id']);
unset($_SESSION['ses_card_id']);
unset($_SESSION['ses_status']);
unset($_SESSION['ses_name']);
unset($_SESSION['ses_lastname']);
			
unset($_SESSION['ses_acc_userid']);
unset($_SESSION['ses_acc_id']);
unset($_SESSION['ses_acc_username']);
unset($_SESSION['ses_acc_has']);
session_destroy();
echo "<script>window.location='index.php';</script>";
?>