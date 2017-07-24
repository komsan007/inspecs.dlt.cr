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
        <div class="alert alert-success"><strong>ข้อมูลหน่วยงาน:</strong><?php echo $_SESSION['success_msg'];?></div>
	<?php $_SESSION['success_msg'] = ""; ?>
	<?php } ?>
	
<div class="row">
<form id="frmRecord" action="saveDepartment.php" method="POST">

<div class="col-sm-12"><h3>บันทึกข้อมูลหน่วยงาน</h3></div>
<br>

<div class="col-sm-12">

	<input type="hidden" class="form-control" name="id" id="id">

	<div class="form-group">
	  <label for="name">ชื่อหน่วยงาน:</label>
	  <input type="text" class="form-control" name="name" id="name" maxlength="150" >
	</div>
	
	<div class="form-group">
	  <label for="description">รายละเอียด:</label>
	  <input type="text" class="form-control" name="description" id="description" maxlength="200">
	</div>
	<!--
	<div class="form-group">
	  <label for="status">สถานะ:</label>
		<select class="form-control" name="status" id="status">
		<option value="0">ปิดการใช้งาน</option>
		<option value="1">เปิดใช้งาน</option>
	  </select>
	</div>
     -->
	<br>
    <button type="submit" class="btn btn-info saveRecord-btn" name="save_record" id="save_record">บันทึกข้อมูล</button>
</div>

</form>
</div>


<br>

<!--  Table display record status -->
<?php   
  $numRows = 0;
      $sql = "SELECT * FROM department ORDER BY id ASC";
      $result = mysqli_query($conn, $sql);
      if($result) {
        $numRows = mysqli_num_rows($result);
      }
?>
<?php if ($numRows == 0) { ?> 
   <div class="row"><div class="col-sm-12" style="background-color: #8920d4;color: #ffffff;"><h4> >> ไม่พบข้อมูลหน่วยงาน</h4> </div></div>
<?php } else { ?>
<br>
<div class="row">
   
  <table class="table table-hover">
    <thead class="btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
      <tr>
        <th>ID</th>
        <th>หน่วยงาน</th>
        <th>รายละเอียด</th>
		<!--<th>สถานะ</th>-->
         <th>จัดการ</th>
      </tr>
    </thead>
    <tbody>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
        <td><?php echo $row["id"];?></td>
        <td><?php echo $row["name"];?></td>
		<td><?php echo $row["description"];?></td>
        
    <!--<td>&nbsp;
   <?php //if(!empty($row["status"])) {
        //echo ($row["status"] == '1') ? "<span class='btn btn-success'>เปิดใช้งาน</span>" : "<span class='btn btn-danger'>ปิดการใช้งาน</span>"; 
      //}?>
	  </td>-->
	 <td>&nbsp;
	 <a href="delDeparment.php?id=<?php echo $row['id'];?>">
				<button type="button" class="btn btn-default btn-sm">
					<span class="glyphicon glyphicon-remove"></span>
				</button>
			</a>
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
