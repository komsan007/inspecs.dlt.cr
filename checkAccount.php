<?php
session_start();
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

if($username == "") {
	$_SESSION['error_msg'] = "คุณยังไม่ได้กรอกชื่อผู้ใช้";
	echo "<script>window.location='login.php';</script>";
} else if($password == "") {
	$_SESSION['error_msg'] = "คุณยังไม่ได้กรอกรหัสผ่าน";
	echo "<script>window.location='login.php';</script>";
} else {
	include("conn.php");
	$sql  = " SELECT * FROM accounts WHERE username ='".$username."' AND password ='".md5($password)."' ";
	$check_log = mysqli_query($conn, $sql);
	if($check_log) {
      $numRows = mysqli_num_rows($check_log);
	}

	if($numRows <= 0) {
		$_SESSION['error_msg'] = "ไม่พบข้อมูลผู้ใช้งานในระบบ";
		echo "<script>window.location='login.php';</script>";
	} else {
		$data = mysqli_fetch_assoc($check_log);
		if(!empty($data['id']) && !empty($data['username'])){
			$_SESSION['ses_acc_userid'] = session_id();
			$_SESSION['ses_acc_id'] = $data['id'];
			$_SESSION['ses_acc_username'] = $data['username'];				
			$_SESSION['ses_acc_has'] = @$data['hash'];
            $_SESSION['ses_acc_departd'] = @$data['department'];
            $_SESSION['ses_acc_departd_en'] = @$data['department_en'];

        
			$departd = "สำนักงานขนส่งจังหวัดเชียงราย";
			$departd_en = "Provincial Land Transport Office Of Chiangrai";
            $_SESSION['ses_acc_departd'] = (!empty($_SESSION['ses_acc_departd'])? $_SESSION['ses_acc_departd'] : $departd);
            $_SESSION['ses_acc_departd_en'] = (!empty($_SESSION['ses_acc_departd_en'])? $_SESSION['ses_acc_departd_en'] : $departd_en);




			
			echo "<script>window.location='data.php';</script>";
		}else{
			$_SESSION['error_msg'] = "ไม่พบข้อมูลผู้ใช้งานในระบบ";
			echo "<script>window.location='login.php';</script>";
		}		
	}
}
?>