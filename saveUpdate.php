<?php
session_start();
$_SESSION['error_msg'] ="";
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
if (empty($_REQUEST['id'])) {
       $_SESSION['error_msg'] = "ไม่พบข้อมูลที่ต้องการอัพเดท";
       echo "<script>window.location='data.php';</script>";
}

if (empty($_REQUEST['proceed'])) {
        $_SESSION['error_msg'] = "ไม่สามารถบันทึกข้อมูลได้เนื่องจากข้อมูลไม่ครบถ้วน";
        echo "<script>window.location='updateRecord.php?id=".$_REQUEST['id']."&card_id=".$_REQUEST['card_id']."';</script>";
} else {
    include("conn.php");
	include("function.inc.php");
    $sql  = " SELECT * FROM register_data WHERE id ='".$_REQUEST['id']."'";
    $check_card = mysqli_query($conn, $sql);
    if ($check_card) {
        $numRows = mysqli_num_rows($check_card);
    }

    if ($numRows > 0) {
		if ($_REQUEST['proceed'] != 3) {
                $_REQUEST['status'] = 0;
        }
        $sql = " SELECT * FROM records_status WHERE regis_id ='".$_REQUEST['id']."' AND proceed ='".$_REQUEST['proceed']."' ";
        $check_record = mysqli_query($conn, $sql);
        if ($check_record) {
            $numRows = mysqli_num_rows($check_record);
        }

        if ($numRows > 0) {

            $record  = "UPDATE records_status SET proceed ='".$_REQUEST['proceed']."', status = '".$_REQUEST['status']."'";
            $record .= "WHERE regis_id = '".$_REQUEST['id']."'";
			$record .= "AND proceed = '".$_REQUEST['proceed']."'";

            if (mysqli_query($conn, $record)) {
                $_SESSION['success_msg'] = "บันทึกข้อมูลเข้าสู่ระบบเสร็จเรียบร้อย";
                echo "<script>window.location='updateRecord.php?id=".$_REQUEST['id']."&card_id=".$_REQUEST['card_id']."';</script>";
            } else {
                $_SESSION['error_msg'] = "ไม่สามารถบันทึกข้อมูล " . mysqli_error($conn);
                echo "<script>window.location='updateRecord.php?id=".$_REQUEST['id']."&card_id=".$_REQUEST['card_id']."';</script>";
            }

        } else {
			
            $record  = "INSERT INTO records_status VALUES ( ";
            $record .= " '',";
            $record .= " '".$_REQUEST['id']."',";
            $record .= " '".$_REQUEST['dept_updated']."',";
            $record .= " '".$_REQUEST['proceed']."',";
            $record .= " '".$_REQUEST['document']."',";
            $record .= " '".$_REQUEST['status']."',";
            $record .= " NOW(),";
            $record .= " NOW()";
            $record .= ")";

            if (mysqli_query($conn, $record)) {
                $_SESSION['success_msg'] = "บันทึกข้อมูลเข้าสู่ระบบเสร็จเรียบร้อย";
                echo "<script>window.location='updateRecord.php?id=".$_REQUEST['id']."&card_id=".$_REQUEST['card_id']."';</script>";
            } else {
                $_SESSION['error_msg'] = "ไม่สามารถบันทึกข้อมูล " . mysqli_error($conn);
                echo "<script>window.location='updateRecord.php?id=".$_REQUEST['id']."&card_id=".$_REQUEST['card_id']."';</script>";
            }
        }
    } else {
        $_SESSION['error_msg'] = "ไม่พบข้อมูลลที่ต้องการอัพเดท";
        echo "<script>window.location='data.php';</script>";
    }
    mysqli_close($conn);
}
?>