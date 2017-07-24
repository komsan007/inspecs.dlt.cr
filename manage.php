<?php session_start();?>
<?php
if(	empty($_SESSION['ses_acc_userid']) || 
	empty($_SESSION['ses_acc_username']) || 
	empty($_SESSION['ses_acc_id']) || 
	($_SESSION['ses_acc_userid'] <> session_id())) {
    echo "<script>window.location='login.php';</script>";
}
?>
<?php include('header.php');?>

<br>


<?php if (!empty($_SESSION['error_msg'])) { ?>
        <div class="alert alert-danger"><strong>ข้อมูลผิดพลาด:</strong><?php echo $_SESSION['error_msg'];?></div>
    <?php $_SESSION['error_msg'] = ""; ?>
<?php } ?>

<?php if (!empty($_SESSION['success_msg'])) { ?>
        <div class="alert alert-danger"><strong>ข้อมูลคำร้อง:</strong><?php echo $_SESSION['success_msg'];?></div>
    <?php $_SESSION['success_msg'] = ""; ?>
<?php } ?>



<div class="row">


<table class="table table-hover">
    <thead class="btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
      <tr>
		<th style="vertical-align:top">รายการ</th>
		<th style="vertical-align:top" colspan="3">จัดการข้อมูล</th>
      </tr>
    </thead>
    <tbody>

	<tr>
		<td>ข้อมูลหน่วยงาน</td>
		<td>
			<a href="department.php" target="_blank">
				<button type="button" class="btn btn-default btn-sm">
					<span class="glyphicon glyphicon-pencil"></span>
				</button>
			</a>
		</td>
    </tr>	
	<tr>
		<td>ข้อมูลการดำเนินการ</td>
		<td>
			<a href="proceed.php" target="_blank">
				<button type="button" class="btn btn-default btn-sm">
					<span class="glyphicon glyphicon-pencil"></span>
				</button>
			</a>
		</td>
    </tr> 
	  
    </tbody>
  </table>	 
  
</div>


<?php include("contentRemark.php"); ?>

<?php include("footer.php"); ?>
