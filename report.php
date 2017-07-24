<?php session_start();?>
<?php
/*if(empty($_SESSION['ses_acc_userid']) || empty($_SESSION['ses_acc_id']) || ($_SESSION['ses_acc_userid'] <> session_id())){
	echo "<script>window.location='login.php';</script>";
}*/
?>
<?php 
// 1 = HTML, 2 == "PDF", 3 == PRINT
if(!empty($_REQUEST['rpt']) && $_REQUEST['rpt'] == 3) {
    echo '<script> window.print(); </script>';
}
?>
<?php echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="shortcut icon" href="https://www.dlt.go.th/minisite/favicon/favicon.ico">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php include('conn.php');?>
</head>
<body>
<?php
	$numRows = 0;
	if (!empty($_REQUEST['id'])) {
			$sql = "SELECT * FROM register_data WHERE id ='".$_REQUEST['id']."'";
			$result = mysqli_query($conn, $sql);
			if($result) {
            $numRows = mysqli_num_rows($result);
			}
		}
if ($numRows == 0) { ?>
	 <div class="col-sm-12" style="background-color: #cccccc;color: #ffffff;"><h4> >> ไม่พบข้อมูลคำร้อง</h4> </div></div>
<?php 
}else {
	$row = mysqli_fetch_assoc($result);
}?>
<div class="container" style="margin-top:9px; border: solid 2px #999999; padding: 9px;">
<div class="row">
<div class="col-sm-9">	
<h1><?php echo $_SESSION['ses_acc_departd'];?></h1>
<h3>ระบบตรวจสอบสถานะการตรวจดูข้อมูลข่าวสารส่วนบุคคล (ประวัติอาชญากรรม) </h3>
	<br> 	 
    <h3>ชื่อ สกุล: <?php echo $row["name"];?> &nbsp; <?php echo $row["lastname"];?><h3>
    <h3>รหัสผ่าน: <?php echo base64_decode($row["haspass"]);?></h3>
</div>
<div class="col-sm-3" style="text-align: right;">
<?php
$code = "http://check.rdschiangrai.com/qr.php?code=" . base64_encode($row["id"]) . ":" . base64_encode($row["card_id"]) . ":" . $row["haspass"];
$urlEncode = urlencode($code);
?>
	<img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $urlEncode;?>&choe=UTF-8" title="http://check.rdschiangrai.com" />
</div>
</div>
<?php $phone = (($_SESSION['ses_acc_id'] == 4) ? "0 5372 1917" : "0 5315 2076");?>
<div class="row">
<div class="col-sm-12" style="float: none; margin: 0 auto;">
<h4>หมายเหตุ สามารถตรวจสอบสถานะข้อมูลทางออนไลน์ได้จาก http://check.rdschiangrai.com
โดยใช้เลขประจําตัวประชาชนและรหัสผ่าน หรือสแกนคิวอาร์โค้ดด้านขวามือ
หากมีข้อขัดข้องสอบถามได้ที่ <?php echo $phone;?></h4>
</div>
</div>

<div class="row">
<div class="col-sm-7" style="float:left;"><h4>พิมพ์วันที่ &nbsp;&nbsp;<?php echo date("d")."/".date("m")."/".(date("Y")+543);?><h4></div>
<div class="col-sm-5" style="float:right;">
<button type="button" class="btn btn-info" style="background-image: linear-gradient(to bottom,#777 0,#777 100%);border-color: #777;">
<span style="color: #f9db43;font-size: 19px;">ขับเคลื่อน</span><br>ด้วยนวัตกรรม
</button>
<button type="button" class="btn btn-info" style="background-image: linear-gradient(to bottom,#777 0,#777 100%);border-color: #777;">
<span style="color: #f9db43;font-size: 19px;">ทันต่อ</span><br>การเปลี่นแปลง</button>
<button type="button" class="btn btn-info" style="background-image: linear-gradient(to bottom,#777 0,#777 100%);border-color: #777;">
<span style="color: #f9db43;font-size: 19px;">สู่มาตรฐาน</span><br>สากล</button>
<button type="button" class="btn btn-info" style="background-image: linear-gradient(to bottom,#777 0,#777 100%);border-color: #777;">
<span style="color: #f9db43;font-size: 19px;">องค์กร</span><br>ธรรมาภิบาล</button>
</div>
</div>
<?php mysqli_close($conn); ?>
</body> 
</html>
