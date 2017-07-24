<?php session_start();?>
<?php
if(empty($_SESSION['ses_acc_userid']) || empty($_SESSION['ses_acc_id']) || empty($_SESSION['ses_acc_username']) || ($_SESSION['ses_acc_userid'] <> session_id())){
echo "<script>window.location='login.php';</script>";
}
?>
<?php
include("conn.php");
  //check duplidate card id
  $sql  = " SELECT * FROM register_data ";
  $sql .= " LEFT JOIN records_status ON records_status.regis_id = register_data.id ";
  $sql .= " WHERE register_data.card_id ='".$_REQUEST['card_id']."' ";
  $sql .= " AND register_data.id ='".$_REQUEST['id']."' ";

  $check_card = mysqli_query($conn, $sql);
  if($check_card) {
        $numRows = mysqli_num_rows($check_card);
  }
  if($numRows <= 0) {
    $_SESSION['error_msg'] = "ไม่พบข้อมูลในระบบ";
    echo "<script>window.location='data.php';</script>";
  } else {
    $rowData=mysqli_fetch_assoc($check_card);
    mysqli_free_result($check_card);
  }
?>

<?php include("header.php"); ?>

    <?php if (!empty($_SESSION['error_msg'])) { ?>
        <div class="alert alert-danger"><strong>ข้อมูลผิดพลาด:</strong><?php echo $_SESSION['error_msg'];?></div>
    <?php $_SESSION['error_msg'] = ""; ?>
    <?php } ?>
	
	<?php if (!empty($_SESSION['success_msg'])) { ?>
        <div class="alert alert-success"><strong>ข้อมูลคำร้อง:</strong><?php echo $_SESSION['success_msg'];?></div>
	<?php $_SESSION['success_msg'] = ""; ?>
	<?php } ?>
	
<div class="row">
<form id="frmRecord" action="saveUpdate.php" method="POST">
<div class="col-sm-12"><h3>บันทึกข้อมูลหนังสือตรวจสอบประวัติอาชญากรรม</h3></div>
<br>
<div class="col-sm-12">
	<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $_REQUEST['id'];?>">
	<div class="form-group">
	  <label for="name">ชื่อ:</label>
	  <input type="text" class="form-control" name="name" id="name" maxlength="50" value="<?php echo $rowData['name'];?>">
	</div>
	
	<div class="form-group">
	  <label for="lastname">นามสกุล:</label>
	  <input type="text" class="form-control" name="lastname" id="lastname" maxlength="50" value="<?php echo $rowData['lastname'];?>">
	</div>

	<div class="form-group">
	  <label for="card_id">หมายเลขบัตรประจำตัวประชาชน:</label>
	  <input type="text" class="form-control" name="card_id" id="card_id" maxlength="13" value="<?php echo $rowData['card_id'];?>">
	</div>

	<div class="form-group">
	  <label for="phone">หมายเลขโทรศัพท์มือถือ:</label>
	  <input type="text" class="form-control" name="phone" id="phone" maxlength="10" value="<?php echo $rowData['phone'];?>">
	</div>

	<div class="form-group">
	  <label for="request_type">ขอรับใบอนูญาตผู้ประจำรถ:</label>
		<select class="form-control" name="request_type" id="request_type">
		<option value="1" <?php echo (($rowData['request_type'] == 1) ? 'selected' : ''); ?> >ออกใบอนุญาตใหม่</option>
		<option value="2" <?php echo (($rowData['request_type'] == 2) ? 'selected' : ''); ?> >ต่ออายุใบอนุญาต</option>
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
			 <p><span> ไม่พบข้อมูลคำร้อง</span> </p>
		<?php } else { ?>
		  <select class="form-control" name="license_type" id="license_type">
			<?php while($row = mysqli_fetch_assoc($result)) { ?>
			   <option <?php echo (($rowData['license_type'] == $row['id']) ? 'selected' : ''); ?> value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
			<?php } ?>
		  </select>
		<?php } ?>
	</div>

	<div class="form-group">	  
	  <label for="dept_updated">หน่วยงานที่ดำเนินการ:</label>    
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
		<select class="form-control" name="dept_updated" id="dept_updated">
			<?php while($row = mysqli_fetch_assoc($result)) { ?>
			<option <?php echo (($rowData['dept_updated'] == $row['id']) ? 'selected' : ''); ?> value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
			<?php } ?>
		</select>
	  <?php } ?>   
	  
	</div>

<?php
$sqlRecProceed = "SELECT * FROM records_status WHERE regis_id ='".$_REQUEST['id']."' ORDER BY proceed DESC LIMIT 1";
$result = mysqli_query($conn,$sqlRecProceed);
$rowProceed = mysqli_fetch_assoc($result);
?>
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
			<option <?php echo (($rowData['proceed'] == $row['id']) ? 'selected' : ''); ?> value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
			<?php } ?>
		</select>
	  <?php } ?>
 </div>


		<div class="form-group">
	  <label for="document">เอกสาร:</label>
	  <input type="text" class="form-control" name="document" id="document" maxlength="200">
	</div>	

 <?php if($rowProceed['proceed'] >= 2) { ?>
<div class="form-group">
  <label for="status">ผลการตรวจสอบ:</label>
    <select class="form-control" name="status" id="status">
	<option value="1">ไม่พบประวัติ</option>
	<option value="2">พบประวัติ</option>
  </select>
</div>
 <?php } ?>
 
   
 <br><br>
  
 
    <button type="submit" class="btn btn-info saveRecord-btn" name="save_record" id="save_record">บันทึกข้อมูล</button>
</div>

</form>
</div>


<div class="row">
  <div class="col-md-10">&nbsp;</div>
  <div class="col-md-2" style="text-align:right;">

      <a href="report.php?id=<?php echo $_REQUEST['id'];?>&card_id=<?php echo $rowData['card_id'];?>&rpt=0" target="_blank">
        <button type="button" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-qrcode"></span> 
        </button>
      </a>

      <a href="report.php?id=<?php echo $_REQUEST['id'];?>&card_id=<?php echo $rowData['card_id'];?>&rpt=3" target="_blank">
        <button type="button" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-print"></span> 
        </button>
      </a>

  </div>
</div>

<!--  Table display record status -->
<?php   
  $numRows = 0;
  if (!empty($_REQUEST['id'])) {
      $sql = "SELECT *, (YEAR(created_at)) as Y, (MONTH(created_at)) as m, (DAY(created_at)) as d, TIME(created_at) as T FROM records_status WHERE regis_id ='".$_REQUEST['id']."'";
      $result = mysqli_query($conn, $sql);
      if($result) {
            $numRows = mysqli_num_rows($result);
      }
    }
?>
<?php if ($numRows == 0) { ?> 
   <div class="row"><div class="col-sm-12" style="background-color: #8920d4;color: #ffffff;"><h4> >> ไม่พบข้อมูลคำร้อง</h4> </div></div>
<?php } else { ?>
<br>
<div class="row">
   
  <table class="table table-hover">
    <thead class="btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
      <tr>
        <th>วันที่/เวลา</th>
        <th>หน่วยงาน</th>
        <th>ดำเนินการ</th>
    <th>เอกสาร</th>
    <th>ผลการตรวจสอบ</th>
      </tr>
    </thead>
    <tbody>
<?php $arrRequestType =array(1=>"ออกใบอนุญาตใหม่", 2=>"ต่ออายุ"); ?>	
<?php while($row = mysqli_fetch_assoc($result)) { ?>

<?php
        $sql  = " SELECT * FROM department WHERE id ='".$row["dept_updated"]."'";
		$getDepart = mysqli_query($conn, $sql);
		if ($getDepart) {
			$dpNumRows = mysqli_num_rows($getDepart);
		}
	
       if ($dpNumRows > 0) {
		   $rowDepart = mysqli_fetch_assoc($getDepart);
	       $departName = $rowDepart["name"];
	   }
	   	   
	    $sql  = " SELECT * FROM proceed WHERE id ='".$row["proceed"]."'";
		$getProceed = mysqli_query($conn, $sql);
		if ($getProceed) {
			$dpNumRows = mysqli_num_rows($getProceed);
		}
	
       if ($dpNumRows > 0) {
		   $rowProceed = mysqli_fetch_assoc($getProceed);
	       $proceedName = $rowProceed["name"];
	   }
	   
	   ?>
  <tr>
        <td><?php echo $row["d"]."/".$row["m"]."/".(($row["Y"])+543)."&nbsp;&nbsp;". $row["T"];?> &nbsp;  น.</td>
        <td><?php echo $departName;?></td>
        <td><?php echo $proceedName;?></td>
        <td><?php echo $row["document"];?></td>
    <td>&nbsp;
   <?php if(!empty($row["status"])) {
        echo ($row["status"] == '2') ? "<span class='btn btn-danger'>พบประวัติ</span>" : "<span class='btn btn-success'>ไม่พบประวัติ</span>"; 
      }?>
    </td>
    </tr>
<?php } ?> 

    </tbody>
  </table>
  </div>
  <?php  } ?>

<br><br>
<!-- End Table -->

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
