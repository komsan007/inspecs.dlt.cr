<?php
 session_start();
 include("conn.php");
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="https://www.dlt.go.th/minisite/favicon/favicon.ico">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/384fd143a0.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Kanit&amp;subset=thai" rel="stylesheet">
  <style> /* body {  font-family: 'Kanit', sans-serif;  } */ </style>
</head>
<body>

<div class="container">
<div class="row">
  <div class="col-md-12" style="text-align:center;">  
	<p><img src="images/logo_200x200.png" border=0 style="width:180px;"/></p>
	<p><h2 style="color:#7f6bb0">สํานักงานขนส่งจังหวัดเชียงราย</h2></p>
	<p><h3 style="color:#f3ef41">Provincial Land Transport Office Of Chiangrai</h3></p>
	<p><h3 style="color:#999999">สถานะการตรวจดูข้อมูลข่าวสารส่วนบุคคล (ประวัติอาชญากรรม)</h3></p>
	</div>
</div>

    <?php if (!empty($_SESSION['error_msg'])) { ?>
        <div class="alert alert-danger"><strong>ข้อมูลผิดพลาด:</strong><?php echo $_SESSION['error_msg'];?></div>
    <?php $_SESSION['error_msg'] = ""; ?>
    <?php } ?>

<div class="row">
<div class="col-sm-12 col-md-6" style="margin: 0 auto;">
  <h3>เข้าสู่ระบบเพื่อตรวจสอบข้อมูล</h3>
  <form id="frmLogin" action="checkLogin.php" method="POST">
    <div class="form-group">
      <label for="text">หมายเลขประจำตัวประชาชน:</label>
      <input type="text" class="form-control" name="card_id" id="card_id" maxlength="13" placeholder="กรุณากรอกหมายเลขประจำตัวประชาชน">
    </div>
    <div class="form-group">
      <label for="pwd">รหัสผ่าน:</label>
      <input type="password" class="form-control" name="pwd" id="pwd" maxlength="10" placeholder="กรุณากรอกรหัสผ่าน">
    </div>
    <!--<div class="checkbox">
      <label><input type="checkbox"> จดจำรหัสผ่าน</label>
    </div>-->
    <button type="submit" class="btn btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
	ตรวจสอบสถานะ</button>
  </form>
</div>

</div>
<br>
<?php include("contentMain.php"); ?>
	
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="padding-top:3px;">
<a class="btn btn-info" href="login.php" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
<span style="color: #f9db43;font-size: 19px;">เข้าสู่ระบบเพื่อบันทึกข้อมูล</span><br>(เฉพาะเจ้าหน้าที่)</a>
</div>

<!--
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="float:left;padding-top:3px;">
<a href=""><img src="images/dlt-appstore.png"/></a>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="float:left;padding-top:3px;">
<a href=""><img src="images/dlt-playstore.png"/></a>
</div>
-->

<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="float:right;padding-top:3px;">	
<a class="btn btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
<span style="color: #f9db43;font-size: 19px;">ขับเคลื่อน</span><br>ด้วยนวัตกรรม</a>
<a class="btn btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
<span style="color: #f9db43;font-size: 19px;">ทันต่อ</span><br>การเปลี่นแปลง</a>
<a class="btn btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
<span style="color: #f9db43;font-size: 19px;">สู่มาตรฐาน</span><br>สากล</a>
<a class="btn btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
<span style="color: #f9db43;font-size: 19px;">องค์กร</span><br>ธรรมาภิบาล</a>
</div>
</div>

</div>
</body> 
</html>
