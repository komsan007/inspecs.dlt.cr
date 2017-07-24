<?php session_start();?>
<?php
if(empty($_SESSION['ses_acc_userid']) || empty($_SESSION['ses_acc_id']) || empty($_SESSION['ses_acc_username']) || ($_SESSION['ses_acc_userid'] <> session_id())){
	echo "<script>window.location='login.php';</script>";
}
?>
<?php include('header.php');?>

    <?php if (!empty($_SESSION['error_msg'])) { ?>
        <div class="alert alert-danger"><strong>ข้อมูลผิดพลาด:</strong><?php echo $_SESSION['error_msg'];?></div>
		<?php $_SESSION['error_msg'] = ""; ?>
    <?php } ?>
	
	<?php if (!empty($_SESSION['success_msg'])) { ?>
        <div class="alert alert-success"><strong>ข้อมูลคำร้อง:</strong><?php echo $_SESSION['success_msg'];?></div>
		<?php $_SESSION['success_msg'] = ""; ?>
	  
	  <!-- Modal -->
	  <div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog modal-md">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">บันทึกข้อมูลหนังสือตรวจสอบประวัติ</h4>
			</div>
			<div class="modal-body">
			  <p>ต้องการบันทึกข้อมูลหนังสือตรวจสอบประวัติอาชญากรรมหรือไม่</p>
			</div>
			<div class="modal-footer">
			  <button type="button" id="ok-modal" class="btn btn-primary">ตกลง</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
			</div>
		  </div>
		</div>
	  </div>

	<script>
		$(document).ready(function(){
        $("#myModal").modal();
		$("#ok-modal").click(function(){
			window.location='updateRecord.php?id='+<?php echo @$_REQUEST['id'];?>+'&card_id='+<?php echo @$_REQUEST['card_id'];?>+'';
		});
	});
	</script>
    <?php } ?>
	

<div class="row">

<form id="frmRecord" action="saveRecord.php" method="POST">


<div class="col-sm-12"><h3>บันทึกข้อมูลผู้ขอรับใบอนุญาต</h3> </div>
<br>

<div class="col-sm-12">

	<div class="form-group">
	  <label for="name">ชื่อ:</label>
	  <input type="text" class="form-control" name="name" id="name" maxlength="50">
	</div>
	
	<div class="form-group">
	  <label for="lastname">นามสกุล:</label>
	  <input type="text" class="form-control" name="lastname" id="lastname" maxlength="50">
	</div>

	<div class="form-group">
	  <label for="card_id">หมายเลขบัตรประจำตัวประชาชน:</label>
	  <input type="text" class="form-control" name="card_id" id="card_id" maxlength="13">
	</div>

	<div class="form-group">
	  <label for="phone">หมายเลขโทรศัพท์มือถือ:</label>
	  <input type="text" class="form-control" name="phone" id="phone" maxlength="10">
	</div>

	<div class="form-group">
	  <label for="request_type">ขอรับใบอนูญาตผู้ประจำรถ:</label>
		<select class="form-control" name="request_type" id="request_type">
		<option value="1">ออกใบอนุญาตใหม่</option>
		<option value="2">ต่ออายุใบอนุญาต</option>
	  </select>
	</div>

	<div class="form-group">
	  <label for="license_type">ประเภทใบอนูญาต:</label>
	<?php   
		$numRows = 0;
		$sql = "SELECT * FROM type_license ";
		$result = mysqli_query($conn, $sql);
		if($result) {
		  $numRows = mysqli_num_rows($result);
		}
	?>
	<?php if ($numRows == 0) { ?>	
		 <p><span> ไม่พบข้อมูลประเภทใบอนุญาต</span> </p>
	<?php } else { ?>
		<select class="form-control" name="license_type" id="license_type">
			<?php while($row = mysqli_fetch_assoc($result)) { ?>
			<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
			<?php } ?>
		</select>
	  <?php } ?>
	</div>

	<div class="form-group">
	  <label for="proceed">ดำเนินการ:</label>
		<?php   
		$numRows = 0;
		$sql = "SELECT * FROM proceed ";
		$result = mysqli_query($conn, $sql);
		if($result) {
		  $numRows = mysqli_num_rows($result);
		}
	?>
	<?php if ($numRows == 0) { ?>	
		 <p><span> ไม่พบข้อมูลการดำเนินการ</span> </p>
	<?php } else { ?>
		<select class="form-control" name="proceed" id="proceed">
			<?php while($row = mysqli_fetch_assoc($result)) { ?>
			<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
			<?php } ?>
		</select>
	  <?php } ?>
	</div>
	
		<div class="form-group">
	  <label for="document">เอกสาร:</label>
	  <input type="text" class="form-control" name="document" id="document" maxlength="200">
	</div>

	<div class="form-group">
	  <label for="request_at">หน่วยงานที่ดำเนินการ:</label>    
		<?php   
		$numRows = 0;
		$sql = "SELECT * FROM department ";
		$result = mysqli_query($conn, $sql);
		if($result) {
		  $numRows = mysqli_num_rows($result);
		}
	?>
	<?php if ($numRows == 0) { ?>	
		 <p><span> ไม่พบข้อมูลหน่วยงาน</span> </p>
	<?php } else { ?>
		<select class="form-control" name="request_at" id="request_at">
			<?php while($row = mysqli_fetch_assoc($result)) { ?>
			<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
			<?php } ?>
		</select>
	  <?php } ?>
	</div>

		 
	<div class="form-group" style="display:none;">
	  <label for="status">ผลการตรวจสอบ:</label>
		<select class="form-control" name="status" id="status">
		    <option selected value="">กรุณาเลือกผลการตรวจสอบ</option>
			<option value="1">ไม่พบประวัติ</option>
			<option value="2">พบประวัติ</option>
		</select>
	</div>	
	<br><br>
    <button type="submit" class="btn btn-info saveRecord-btn" name="save_record" id="save_record">บันทึกข้อมูล</button>
</div>
</form>
</div>
<br>

<?php include("contentRemark.php"); ?>

<?php include("footer.php"); ?>
<style>
.saveRecord-btn {
	background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;
}
.span-lbl {
	color: #f9db43;font-size: 19px;
}
</style>
