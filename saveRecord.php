<?php
session_start();
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
if(empty($_REQUEST['name']) ||
	empty($_REQUEST['lastname']) ||
	empty($_REQUEST['card_id']) ||
	empty($_REQUEST['phone']) ||
	empty($_REQUEST['request_type']) ||
	empty($_REQUEST['license_type']) ||
	empty($_REQUEST['proceed']) ||
	empty($_REQUEST['request_at'])) {
		$_SESSION['error_msg'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
		echo "<script>window.location='record.php';</script>";
} else {
	include("conn.php");
	include("function.inc.php");
	//check duplidate card id
	$sql  = " SELECT * FROM register_data ";
	$sql .= " LEFT JOIN records_status ON records_status.regis_id = register_data.id ";
	$sql .= " WHERE card_id ='".$_REQUEST['card_id']."' ";

	$check_card = mysqli_query($conn, $sql);
	if($check_card) {
        $numRows = mysqli_num_rows($check_card);
	}
	if($numRows > 0) {
		$_SESSION['error_msg'] = "มีข้อมูลบัตรประจำตัวประชาชนนี้อยู่แล้วในระบบ";
		echo "<script>window.location='record.php';</script>";
	} else {

		$passNohas = randomPassword();
		$_REQUEST['reqister_at'] = 0;
		$_REQUEST['dept_updated'] = $_REQUEST['request_at'];
		$register  = "INSERT INTO register_data VALUES ( ";
		$register .= " '',";
		$register .= " '".$_REQUEST['name']."',";
		$register .= " '".$_REQUEST['lastname']."',";
		$register .= " '".$_REQUEST['card_id']."',";
		$register .= " '".md5($passNohas)."',";
		$register .= " '".base64_encode($passNohas)."',";
		$register .= " '".$_REQUEST['phone']."',";
		$register .= " '".$_REQUEST['request_type']."',";
		$register .= " '".$_REQUEST['license_type']."',";
		$register .= " '".$_REQUEST['request_at']."',";
		$register .= " '".$_REQUEST['reqister_at']."',";

		//$register .= " '".$_REQUEST['created_by']."',";
		//$register .= " '".$_REQUEST['updated_by']."',";

		$register .= " NOW(),";
		$register .= " NOW()";
		$register .= ")";
		
	    $_REQUEST['status'] = 0;
		if (mysqli_query($conn, $register)) {
			$res = mysqli_fetch_assoc(mysqli_query($conn, "SELECT LAST_INSERT_ID()"));
			$insert_id = $res['LAST_INSERT_ID()'];
			$record  = "INSERT INTO records_status VALUES ( ";
			$record .= " '',";
			$record .= " '".$res['LAST_INSERT_ID()']."',";
			$record .= " '".$_REQUEST['dept_updated']."',";
			$record .= " '".$_REQUEST['proceed']."',";
			$record .= " '".$_REQUEST['document']."',";
			$record .= " '".$_REQUEST['status']."',";
			$record .= " NOW(),";
			$record .= " NOW()";
			$record .= ")";
			
			if (mysqli_query($conn, $record)) {
				$_SESSION['success_msg'] = "บันทึกข้อมูลคำร้องเสร็จเรียบร้อบ";
				echo "<script>window.location='record.php?id=".$insert_id."&card_id=".$_REQUEST['card_id']."';</script>";
			} else {
				$_SESSION['error_msg'] = "Error: ". mysqli_error($conn);
				echo "<script>window.location='record.php';</script>";
			}				
		} else {
			$_SESSION['error_msg'] = "Error: ". mysqli_error($conn);
			echo "<script>window.location='record.php';</script>";
		}
	}
	mysqli_close($conn);
}
?>