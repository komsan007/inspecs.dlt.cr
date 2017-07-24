<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<?php //echo phpinfo();?>


  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
  <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
</head>
<body>





	<?php

	ini_set('display_errors', 1);
	error_reporting(~0);

   $serverName = "localhost";
   $userName = "root";
   $userPassword = "";
   $dbName = "inspec_rec";
  
	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	if (mysqli_connect_errno())
	{
		echo "Database Connect Failed : " . mysqli_connect_error();
	}
	else
	{
		echo "Database Connected.";
	}

	mysqli_close($conn);
?>

<div class="container">



<div class="row">
  <div class="col-md-12" style="text-align:center;">
  
  <p><img src="images/logo_200x200.png" border=0 /></p>
  
<p><h1 style="color:#7f6bb0">สํานักงานขนส่งจังหวัดเชียงราย</h1></p>
<p><h2 style="color:#f3ef41">Provincial Land Transport Office Of Chiangrai</h2></p>
<p><h2 style="color:#999999">สถานะการตรวจดูข้อมูลข่าวสารส่วนบุคคล (ประวัติอาชญากรรม)</h2></p>

	</div>
</div>


<div class="row">
<div class="col-md-12">
  <h2>เข้าสู่ระบบเพื่อตรวจสอบข้อมูล</h2>
  <form>
    <div class="form-group">
      <label for="email">หมายเลขประจำตัวประชาชน:</label>
      <input type="email" class="form-control" id="email" placeholder="กรุณากรอกหมายเลขประจำตัวประชาชน">
    </div>
    <div class="form-group">
      <label for="pwd">รหัสผ่าน:</label>
      <input type="password" class="form-control" id="pwd" placeholder="กรุณากรอกรหัสผ่าน">
    </div>
    <div class="checkbox">
      <label><input type="checkbox"> จดจำรหัสผ่าน</label>
    </div>
    <button type="submit" class="btn btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
	ตรวจสอบสถานะ</button>
  </form>
</div>
</div>
</div>

<br>

<div class="row">
<div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);
    border-color: #7715b1;font-size: 22px;">ระบบตรวจสอบสถานการตรวจดูข้อมูลข่าวสารส่วนบุคคล (ประวัติอาชญากรรม) </div>
      <div class="panel-body">ยินดีตอนรับสู่ ระบบตรวจสอบสถานการตรวจดูข้อมูลข่าวสารส่วนบุคคล (ประวัติอาชญากรรม) ของสํานักงานขนส่ง
จังหวัดเชียงราย ซึ่งระบบนี้เป็นบริการสําหรับการติดตามและตรวจสอบผลการตรวจดูข้อมูลข่าวสารส่วนบุคคล (ประวัติ
อาชญากรรม) จากพิสูจน์หลักฐานจังหวัดเชียงราย ผ่านทางสถานีตํารวจภูธรเมืองเชียงราย เพื่อนําผลการตรวจสอบ
ดังกล่าวมาประกอบการพิจารณาออกหรือต่ออายุใบอนุญาตเป็นผู้ประจํารถ ประเภทใบอนุญาตผู้ขับรถทุกประเภท นั้น
ด้วยขั้นตอนง่ายๆ เพียงกรอกเลขประจําตัวประชาชนของผู้ที่ต้องการทราบผลการตรวจสอบดังกล่าว และรหัสผ่านจาก
เอกสารตรวจสอบสถานการณ์ตรวจดูข้อมูลข่าวสารส่วนบุคคล (ประวัติอาชญากรรม) ที่ได้รับจากสํานักงานขนส่งจังหวัด
เชียงรายขณะรับหนังสือขอตรวจสอบประวัติผู้ขอรับใบอนุญาต (ในกรอบสีแดง) แล้วคลิ๊กปุ่ม “ตรวจสอบสถานะ” เพื่อค้นหา
ผู้ใช้บริการก็จะทราบข้อมูลสถานะการดําเนินการในขณะนี้ได</div>
    </div>
	</div>
	</div>
	
<div class="row">
<div class="col-sm-5"></div>
<div class="col-sm-5" style="float:right;">	
<button type="button" class="btn btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
<span style="color: #f9db43;font-size: 19px;">ขับเคลื่อน</span><br>ด้วยนวัตกรรม
</button>
<button type="button" class="btn btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
<span style="color: #f9db43;font-size: 19px;">ทันต่อ</span><br>การเปลี่นแปลง</button>
<button type="button" class="btn btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
<span style="color: #f9db43;font-size: 19px;">สู่มาตรฐาน</span><br>สากล</button>
<button type="button" class="btn btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
<span style="color: #f9db43;font-size: 19px;">องค์กร</span><br>ธรรมาภิบาล</button>
</div>
</div>


</body> 
</html>
