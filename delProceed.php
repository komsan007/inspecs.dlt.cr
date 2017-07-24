<?php
session_start();
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

if(empty($_REQUEST['id'])) {
	    $_SESSION['error_msg'] = "ไม่พบข้อมูลที่ต้องการลบออกจากระบบ";
		echo "<script>window.location='proceed.php';</script>";
} else {
	include("conn.php");

    $sql  = " SELECT * FROM records_status ";
    $sql .= " WHERE records_status.proceed ='".$_REQUEST['id']."' ";

    $check_card = mysqli_query($conn, $sql);
	$numRows = 0;
    if ($check_card) {
        $numRows = mysqli_num_rows($check_card);
    }
    
    if ($numRows > 0) {

	    $_SESSION['error_msg'] = "ไม่สามารถลบข้อมูลได้เนื่องจากมีการใช้งานจากระบบอื่นอยู่ขณะนี้";
		echo "<script>window.location='proceed.php';</script>";
		
	} else {
		
		$delData  = " DELETE FROM proceed ";
		$delData .= " WHERE proceed.id ='".$_REQUEST['id']."'";

		if (mysqli_query($conn, $delData)) {
		 	$_SESSION['success_msg'] = " ลบข้อมูลออกจากระบบเรียบยร้อย";	 
			echo "<script>window.location='proceed.php';</script>";

		} else {
				$_SESSION['error_msg'] = "Error: ". mysqli_error($conn);
				echo "<script>window.location='proceed.php';</script>";
		}
	

	}
	mysqli_close($conn);
}

?>