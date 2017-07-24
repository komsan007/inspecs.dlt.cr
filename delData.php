<?php
session_start();
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

if(empty($_REQUEST['id'])) {
	    $_SESSION['error_msg'] = "ไม่พบข้อมูลที่ต้องการลบออกจากระบบ";
		echo "<script>window.location='data.php';</script>";
} else {
	include("conn.php");

    $sql  = " SELECT * FROM register_data ";
    $sql .= " LEFT JOIN records_status ON records_status.regis_id = register_data.id ";
    $sql .= " WHERE register_data.id ='".$_REQUEST['id']."' ";

    $check_card = mysqli_query($conn, $sql);
	$numRows = 0;
    if ($check_card) {
        $numRows = mysqli_num_rows($check_card);
    }
    
    if ($numRows > 0) {

		$delData  = " DELETE FROM register_data ";
		$delData .= " WHERE register_data.id ='".$_REQUEST['id']."'";

		if (mysqli_query($conn, $delData)) {

		 	$_SESSION['success_msg'] = " ลบข้อมูลการลงทะเบียนออกจากระบบเรียบยร้อย";	 
		  	$sqlRecord = "DELETE FROM records_status WHERE regis_id ='".$_REQUEST['id']."'";
		  	if (mysqli_query($conn, $sqlRecord)) {
		  		$_SESSION['success_msg'] = " ลบข้อมูลการลงทะเบียนออกจากระบบเรียบยร้อย";
				echo "<script>window.location='data.php';</script>";
		  	} else {
				$_SESSION['error_msg'] = "Error: ". mysqli_error($conn);
			}
		} else {
				$_SESSION['error_msg'] = "Error: ". mysqli_error($conn);
		}
	} else {
	    $_SESSION['error_msg'] = "ไม่พบข้อมูลที่ต้องการลบออกจากระบบ";
		echo "<script>window.location='data.php';</script>";
	}
	mysqli_close($conn);
}

?>