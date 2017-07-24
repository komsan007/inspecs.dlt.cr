<?php
session_start();
$_SESSION['error_msg'] ="";
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

if (empty($_REQUEST['name'])) {
       $_SESSION['error_msg'] = "ไม่สามารถบันทึกข้อมูลได้เนื่องจากข้อมูลไม่ครบถ้วน";
       echo "<script>window.location='proceed.php';</script>";
}

if (empty($_REQUEST['description'])) {
        $_SESSION['error_msg'] = "ไม่สามารถบันทึกข้อมูลได้เนื่องจากข้อมูลไม่ครบถ้วน";
        echo "<script>window.location='proceed.php';</script>";
} else {
		
    include("conn.php");	
	include("function.inc.php");
	$numRows = 0;
	if (!empty($_REQUEST['id'])) {
	
		$sql  = " SELECT * FROM proceed WHERE id ='".$_REQUEST['id']."'";
		$check_card = mysqli_query($conn, $sql);
		if ($check_card) {
			$numRows = mysqli_num_rows($check_card);
		}
	}

       if ($numRows > 0) {
            $_REQUEST['status'] = 1;
            $record  = "UPDATE proceed SET status = '".$_REQUEST['status']."'";
            $record .= "WHERE id = '".$_REQUEST['id']."'";

            if (mysqli_query($conn, $record)) {
                $_SESSION['success_msg'] = "บันทึกข้อมูลเข้าสู่ระบบเสร็จเรียบร้อย";
                echo "<script>window.location='proceed.php';</script>";
            } else {
                $_SESSION['error_msg'] = "ไม่สามารถบันทึกข้อมูล " . mysqli_error($conn);
                echo "<script>window.location='proceed.php';</script>";
            }

        } else {
			$_REQUEST['status'] = 1;
            $record  = "INSERT INTO proceed VALUES ( ";
            $record .= " '',";
            $record .= " '".$_REQUEST['name']."',";
            $record .= " '".$_REQUEST['description']."',";
            $record .= " '".$_REQUEST['status']."'";
            $record .= ")";

            if (mysqli_query($conn, $record)) {
                $_SESSION['success_msg'] = "บันทึกข้อมูลเข้าสู่ระบบเสร็จเรียบร้อย";
                echo "<script>window.location='proceed.php';</script>";
            } else {
                $_SESSION['error_msg'] = "ไม่สามารถบันทึกข้อมูล " . mysqli_error($conn);
                echo "<script>window.location='proceed.php';</script>";
            }
        }
    
    }
    mysqli_close($conn);
?>