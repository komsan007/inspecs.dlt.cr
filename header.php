<?php echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';?>
<?php include('conn.php');?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="https://www.dlt.go.th/minisite/favicon/favicon.ico">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">             
	<div class="row">
		<div class="col-sm-12 col-md-2 col-lg-2">
			<img src="images/logo_200x200.png" border=0 width="142px" />
		</div>
		<div class="col-sm-5">	
			<p><h2 style="color:#7f6bb0"><?php echo ((isset($_SESSION['ses_acc_departd'])) ? $_SESSION['ses_acc_departd'] : 'สำนักงานขนส่งจังหวัดเชียงราย');?></h2></p>
			<p><h2 style="font-size: 22px;color:#f3ef41">Provincial Land Transport Office Of Chiangrai</h2></p>
		</div>
		<div class="col-sm-5" style="text-align: right;">

<div class="btn-group">		
		<?php if(!empty(@$_SESSION['ses_acc_userid']) && !empty(@$_SESSION['ses_acc_id']) || (@$_SESSION['ses_acc_userid'] == session_id())){ ?>

				<a href="data.php" class="btn btn-sm" style=" background-color: #8920d4; color: #ffffff;">
					<span class="glyphicon glyphicon-th-list"></span> หน้าแสดงรายการ 
				</a>
			
				<a href="manage.php" class="btn btn-sm" style=" background-color: #8920d4; color: #ffffff;">
					<span class="glyphicon glyphicon-th-list"></span> จัดการข้อมูลระบบ 
				</a>
				
				<a href="logout.php" class="btn btn-sm" style="background-color: #8920d4; color: #ffffff;">
					<span class="glyphicon glyphicon-user"></span> ออกจากระบบ 
				</a>
			
		<?php }else{ ?>		
			
				<a href="logout.php" class="btn btn-sm" style="background-color: #8920d4; color: #ffffff;">
					<span class="glyphicon glyphicon-user"></span> ออกจากระบบ 
				</a>
			
		<?php } ?>
		</div>
		</div>	
	</div>