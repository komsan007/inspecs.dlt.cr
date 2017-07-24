<?php
session_start();
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$cardId = $_REQUEST['card_id'];
$password = $_REQUEST['pwd'];

if($cardId == "") {
	$_SESSION['error_msg'] = "คุณยังไม่ได้กรอกชื่อผู้ใช้";
	echo "<script>window.location='index.php';</script>";
} else if($password == "") {
	$_SESSION['error_msg'] = "คุณยังไม่ได้กรอกรหัสผ่าน";
	echo "<script>window.location='index.php';</script>";
} else {
	include("conn.php");
	include("function.inc.php");
	
	$sql  = " SELECT * FROM register_data WHERE card_id ='".$cardId."' AND password ='".md5($password)."' ";
	$check_log = mysqli_query($conn, $sql);
	if($check_log) {
           $numRows = mysqli_num_rows($check_log);
	}

	if($numRows <= 0) {
		$_SESSION['error_msg'] = "หมายเลขบัตรประจำตัวประชาชน หรือ รหัสผ่าน ผิดกรุณา เข้าสู่ระบบใหม่อีกครั้ง";
		echo "<script>window.location='index.php';</script>";
	} else {
		$data = mysqli_fetch_assoc($check_log);
		if(!empty($data['card_id'])){
			$_SESSION['ses_userid'] = session_id();
			$_SESSION['ses_id'] = $data['id'];
			$_SESSION['ses_card_id'] = $cardId;				
			$_SESSION['ses_status'] = @$data['status'];				
			$_SESSION['ses_name'] = $data['name'];
			$_SESSION['ses_lastname'] = $data['lastname'];

			//record personals_log table
			recordLog($conn, "personals_log", $data['id'], "login");
			
			echo "<script>window.location='list.php';</script>";
		}else{
			$_SESSION['error_msg'] = "ไม่พบข้อมูลผู้ใช้นี้ในระบบ";
			echo "<script>window.location='index.php';</script>";
		}		
	}
}
?>