<?php session_start();?>
<?php
if(empty($_SESSION['ses_acc_userid']) || empty($_SESSION['ses_acc_id']) || empty($_SESSION['ses_acc_username']) || ($_SESSION['ses_acc_userid'] <> session_id())){
echo "<script>window.location='login.php';</script>";
}
?>
<?php include("conn.php"); ?>
<?php include("header.php"); ?>

    <?php if (!empty($_SESSION['error_msg'])) { ?>
        <div class="alert alert-danger"><strong>ข้อมูลผิดพลาด:</strong><?php echo $_SESSION['error_msg'];?></div>
    <?php $_SESSION['error_msg'] = ""; ?>
    <?php } ?>
	
	<?php if (!empty($_SESSION['success_msg'])) { ?>
        <div class="alert alert-success"><strong>ข้อมูลสถิติ:</strong><?php echo $_SESSION['success_msg'];?></div>
	<?php $_SESSION['success_msg'] = ""; ?>
	<?php } ?>
	
<div class="row">
<form id="frmRecord" action="personals_stat.php" method="POST">
<div class="col-sm-12"><h3>ข้อมูลผู้ใช้บริการ</h3></div>
<br>
<div class="col-sm-3">
	<input type="hidden" class="form-control" name="id" id="id">
	<div class="form-group">
	  <label for="year1">ข้อมูลผู้ใช้บริการ (ปี พ.ศ.)</label>
	  <select class="form-control" name="year1" id="year1">
	    <?php 
		$currYear = date("Y"); 
		for($y = $currYear;$y>=($currYear-10);$y-- ) {
		?>
		<option <?php echo (@$_REQUEST['year1']== $y ? "selected":"");?> value="<?php echo $y; ?>"><?php echo $y; ?></option>
		<?php } ?>
	  </select>
	</div>
	</div>
<div class="col-sm-3"></div>
<div class="col-sm-3"></div> 
<div class="col-sm-3">
<div class="form-group">
	  <label for="save_record">&nbsp;</label><br>
    <button type="submit" class="btn btn-info saveRecord-btn" name="save_record" id="save_record">แสดงข้อมูลสถิติการใช้งาน</button>
	</div>
</div>
</form>
</div>
<br>
<!--  Table display record status -->
<?php

$month =array("0"=>"", "1"=>"มกราคม", "2"=>"กุมภาพันธ์", "3"=>"มีนาคม", "4"=>"เมษายน", "5"=>"พฤษภาคม", "6"=>"มิถุนายน", "7"=>"กรกฎาคม", "8"=>"สิงหาคม", "9"=>"กันยายน", "10"=>"ตุลาคม", "11"=>"พฤศจิกายน", "12"=>"ธันวาคม");
   
   $numRows = 0;
   $sql  = " SELECT MONTH(datetime) as 'month',COUNT(regis_id) as 'count' FROM personals_log";
   $sql .= " WHERE YEAR(datetime) = YEAR(CURDATE())";
   $sql .= " GROUP BY MONTH(datetime)";
      if(!empty($_REQUEST['year1'])) {
	   $sql  = " SELECT MONTH(datetime) as 'month',COUNT(regis_id) as 'count' FROM personals_log";
       $sql .= " WHERE YEAR(datetime) = '".$_REQUEST['year1']."'";
       $sql .= " GROUP BY MONTH(datetime)";
	  }
      $result = mysqli_query($conn, $sql);
      if($result) {
        $numRows = mysqli_num_rows($result);
      }
?>
<?php if ($numRows == 0) { ?> 
   <div class="row"><div class="col-sm-12" style="background-color: #8920d4;color: #ffffff;"><h4> >> ไม่พบข้อมูลสถิติ</h4> </div></div>
<?php } else { ?>
<br>
<div class="row">
   
  <table class="table table-hover">
    <thead class="btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
      <tr>
        <th>ลำดับ</th>
        <th>เดือน</th>
        <th>สถิติจำนวนครั้ง (เข้าใช้บริการ)</th>
      </tr>
    </thead>
    <tbody>

<?php 
$i = 1;
while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $month[$row['month']];?></td>
		<td><?php echo $row['count'];?></td>
    </tr>
<?php 
$i++;
} ?> 

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