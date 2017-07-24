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
<form id="frmRecord" action="data.php" method="POST">
<div class="row">
<div class="col-sm-6">
<div class="form-group">
  <input type="text" class="form-control" id="searchtxt" name="searchtxt" maxlength="50" placeholder="กรอกข้อมูลเพื่อค้นหาตามรายชื่อ หรือหมายเลขประจำตัวประชาชน">
</div>
</div>
<div class="col-sm-3">
	<button type="submit" class="btn" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
	<span style="color: #f9db43;font-size: 15px;">ค้นหา</span></button>
</div>
<div class="col-sm-3" style="float:right; text-align:right;">
	<a href="record.php" class="btn btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
	<span style="color: #f9db43;font-size: 15px;">บันทึกข้อมูลคำร้องใหม่</span></a>
</div>
</div>    
</form>

<?php if (!empty($_SESSION['error_msg'])) { ?>
        <div class="alert alert-danger"><strong>ข้อมูลผิดพลาด:</strong><?php echo $_SESSION['error_msg'];?></div>
    <?php $_SESSION['error_msg'] = ""; ?>
<?php } ?>

<?php if (!empty($_SESSION['success_msg'])) { ?>
        <div class="alert alert-success"><strong>ข้อมูลคำร้อง:</strong><?php echo $_SESSION['success_msg'];?></div>
    <?php $_SESSION['success_msg'] = ""; ?>
<?php } ?>

<?php

$perpage = 50;
 if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }

 $start = ($page - 1) * $perpage;



$numRows = 0;
if (!empty($_REQUEST['searchtxt'])) {
            $sql  = "SELECT *, (YEAR(created_at)) as Y, (MONTH(created_at)) as m, (DAY(created_at)) as d, TIME(created_at) as T ";
			$sql .= " FROM register_data ";			
			$sql .= " WHERE card_id LIKE '%".$_REQUEST['searchtxt']."%'";
			$sql .= " OR name LIKE '%".$_REQUEST['searchtxt']."%'";
			$sql .= " ORDER BY register_data.id DESC ";
			$sql .= " LIMIT {$start} , {$perpage}";
			//$sql .= " WHERE card_id ='".$_REQUEST['searchtxt']."'";
            //$sql .= " OR name = '".$_REQUEST['searchtxt']."'";
			
            $result = mysqli_query($conn, $sql);
    if ($result) {
            $numRows = mysqli_num_rows($result);
    }
} else {
            $sql  = "SELECT *, (YEAR(created_at)) as Y, (MONTH(created_at)) as m, (DAY(created_at)) as d, TIME(created_at) as T ";
			$sql .= " FROM register_data ";
			$sql .= " ORDER BY register_data.id DESC ";
			$sql .= " LIMIT {$start} , {$perpage}";
            $result = mysqli_query($conn, $sql);
    if ($result) {
            $numRows = mysqli_num_rows($result);
    }
}
?>
<?php if ($numRows == 0) { ?>
<div class="row">
	 <div class="col-sm-12" style="background-color: #8920d4;color: #ffffff;"><h4> >> ไม่พบข้อมูลคำร้อง</h4></div>
	 </div>
<?php } else { ?>
	<br>
	<?php if (!empty($_REQUEST['searchtxt'])) {  ?>
		<div class="row">
			<div class="col-sm-12" style="background-color: #8920d4;color: #ffffff;"><h4> >> ผลการค้นหา:  "<?php echo @$_REQUEST['searchtxt'];?>"</h4></div>
		</div>
	<?php } ?>
<br> 

<div class="row">
<div class="col-sm-12" style="text-align:right;">
	<a href="personals_stat.php" class="btn btn-warning btn-sm" style="color: #ffffff;">
		<span class="glyphicon glyphicon-stats"></span> สถิติการเข้าใช้บริการ 
	</a>        
</div>
</div>
<br>

<div class="row">
  <table class="table table-hover">
    <thead class="btn-info" style="background-image: linear-gradient(to bottom,#8920d4 0,#7511a7 100%);border-color: #7715b1;">
      <tr>
		<th style="vertical-align:top">คำร้อง</th>
		<th style="vertical-align:top">ชื่อ</th>
		<th style="vertical-align:top">นามสกุล</th>
		<th style="vertical-align:top">เลขประจำตัวประชาชน</th>
		<th style="vertical-align:top">โทรศัพท์</th>
		<th style="vertical-align:top">คำร้อง</th>
		<th style="vertical-align:top">ประเภทใบอนุญาต</th>
		<th style="vertical-align:top">หน่วยงานที่ดำเนินการ</th>
		<!--<th style="vertical-align:top">ลงบันทึก</th>-->
		<th style="vertical-align:top">บันทึกคำร้อง</th>
		<th style="vertical-align:top" colspan="3">จัดการ</th>
      </tr>
    </thead>
    <tbody>
<?php 
$arrRequestType =array(1=>"ออกใบอนุญาตใหม่", 2=>"ต่ออายุ"); 
$arrDept =array(1=>"สำนักงานขนส่งจังหวัดเชียงราย", 2=>"สถานีตํารวจภูธรเมืองเชียงราย");
?>
<?php while($row = mysqli_fetch_assoc($result)) { 
  
	$numRows = 0;
	$sqlType = "SELECT * FROM type_license WHERE id = '".$row["license_type"]."'";
	$resType = mysqli_query($conn, $sqlType);
	if($resType) {
      $numRows = mysqli_num_rows($resType);
	}
 if ($numRows == 0) {
	 $licenseType = "";
 } else {
	$rowType = mysqli_fetch_assoc($resType);
	$licenseType = $rowType["name"];
  } 
  
    
        $sql  = " SELECT * FROM department WHERE id ='".$row["request_at"]."'";
		$getDepart = mysqli_query($conn, $sql);
		if ($getDepart) {
			$dpNumRows = mysqli_num_rows($getDepart);
		}
	

       if ($dpNumRows > 0) {
		   $rowDepart = mysqli_fetch_assoc($getDepart);
		   $registerAtName = $rowDepart["name"];
	       $departName = $rowDepart["name"];
	   }

	   $sql  = " SELECT ";
       $sql .= " (SELECT YEAR(datetime)  FROM personals_log WHERE regis_id = '".$row["id"]."' ORDER BY datetime DESC LIMIT 0,1) as Y ,";
       $sql .= " (SELECT MONTH(datetime)  FROM personals_log WHERE regis_id = '".$row["id"]."' ORDER BY datetime DESC LIMIT 0,1) as m ,";
       $sql .= " (SELECT DAY(datetime) FROM personals_log WHERE regis_id = '".$row["id"]."' ORDER BY datetime DESC LIMIT 0,1) as d , ";
       $sql .= " (SELECT TIME(datetime)  FROM personals_log WHERE regis_id = '".$row["id"]."' ORDER BY datetime DESC LIMIT 0,1) as T  ,";
       $sql .= " COUNT(id) as num, action FROM personals_log WHERE regis_id = '".$row["id"]."'";
	   	   	   	   
	   
		$getLog = mysqli_query($conn, $sql);
		if ($getLog) {
			$Numlog = mysqli_num_rows($getLog);
		}
	
       if ($Numlog > 0) {
		   $rowLog = mysqli_fetch_assoc($getLog);
		   $lastLog = $rowLog["d"]."/".$rowLog["m"]."/".(($rowLog["Y"])+543)." &nbsp;".$rowLog["T"]."&nbsp;น.";
	       $nLog = $rowLog["num"];
	   }
  
?>

	<tr>
		<td><?php echo $row["id"];?></td>
		<td><?php echo $row["name"];?>
		<?php if(!empty($nLog) && ($nLog > 0)) { ?>
		<br><a href="#" data-toggle="tooltip" title='จำนวนครั้ง มากกว่า 10  จะแสดง 10+'>ใช้งานล่าสุด <?php echo $lastLog;?> 
		<span class="badge"><?php echo ($nLog > 10 ) ? "10+" : $nLog; ?></span></a>
		<br>
		<?php }?>
		</td>
		<td><?php echo $row["lastname"];?></td>
		<td><?php echo $row["card_id"];?></td>
		<td><?php echo $row["phone"];?></td>
		<td><?php echo $arrRequestType[$row["request_type"]];?></td>
		<td><?php echo $licenseType;?></td>
		<!--<td><?php //echo $registerAtName;?></td>-->
		<td><?php echo $departName;?></td>
		<td><?php echo $row["d"]."/".$row["m"]."/".(($row["Y"])+543)." &nbsp;".$row["T"];?> &nbsp;  น.</td>
		<!--<td><?php //echo $row["updated_at"];?> &nbsp;  น.</td>-->
		<td>
			<a href="report.php?id=<?php echo $row['id'];?>&card_id=<?php echo $row['card_id'];?>" target="_blank">
				<button type="button" class="btn btn-default btn-sm">
					<span class="glyphicon glyphicon-qrcode"></span> 
				</button>
			</a>
		</td>

<!-- Print report QR column -->
		<!--<td>
			<a href="report.php?id=<?php echo $row['id'];?>&card_id=<?php echo $row['card_id'];?>" target="_blank">
				<button type="button" class="btn btn-default btn-sm">
					<span class="glyphicon glyphicon-print"></span> 
				</button>
			</a>
		</td>-->
<!-- End Print report QR column -->

		<td>
			<a href="updateRecord.php?id=<?php echo $row['id'];?>&card_id=<?php echo $row['card_id'];?>" target="_blank">
				<button type="button" class="btn btn-default btn-sm">
					<span class="glyphicon glyphicon-pencil"></span>
				</button>
			</a>
		</td>
		<td>
			<a href="delData.php?id=<?php echo $row['id'];?>&card_id=<?php echo $row['card_id'];?>">
				<button type="button" class="btn btn-default btn-sm">
					<span class="glyphicon glyphicon-remove"></span>
				</button>
			</a>
            <!-- Delete modal confimed -->
			<!---<a href="#del_modal" data-toggle="modal" data-book-id="<?php echo $row['id'].":".$row['card_id'];?>">
				<span class="glyphicon glyphicon-remove"></span>
			</a>-->

		</td>
    </tr>
<?php } ?>  
	  
    </tbody>
  </table>
</div>
<?php } ?>




<?php
 $sql = "select * from register_data ";
 $resTotal = mysqli_query($conn, $sql);
 $total_record = mysqli_num_rows($resTotal);
 $total_page = ceil($total_record / $perpage);
 ?>

 <nav>
 <ul class="pagination">
 <li>
 <a href="data.php?searchtxt=<?php echo @$_REQUEST['searchtxt'];?>&page=1" aria-label="หน้าแรก">
 <span aria-hidden="true">&laquo;</span>
 </a>
 </li>
 <?php for($i=1;$i<=$total_page;$i++){ ?>
 <li><a href="data.php?searchtxt=<?php echo @$_REQUEST['searchtxt'];?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
 <?php } ?>
 <li>
 <a href="data.php?searchtxt=<?php echo @$_REQUEST['searchtxt'];?>&page=<?php echo $total_page;?>" aria-label="หน้าสุดท้าย">
 <span aria-hidden="true">&raquo;</span>
 </a>
 </li>
 </ul>
 </nav>



<!--  Modal confirma delete-->
<div class="modal" id="del_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">ปิด</span></button>
          <h4 class="modal-title">ยืนยันการลบข้อมูลคำร้อง</h4>
      </div>
      <div class="modal-body">
        <p>คุณต้องการที่จะลบข้อมูลคำร้องนี้ใช่หรือไม่</p>
        <input type="text" name="delId" value=""/>
      </div>
      <div class="modal-footer">
      	<button type="button" id="ok_del_modal" class="btn btn-info" data-dismiss="modal">ลบข้อมูลคำร้องนี้</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End modal -->

<!--<a href="delData.php?id=&card_id=">-->

<script>
$('#del_modal').on('show.bs.modal', function(e) {
    var delVal = $(e.relatedTarget).data('book-id');
    $(e.currentTarget).find('input[name="delId"]').val(bookId);

    $("#ok-modal").click(function(){
		window.location='delData.php?id='+idVal+'&card_id='+cardVal+'';
	});

});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

</script>




<?php include("contentRemark.php"); ?>

<?php include("footer.php"); ?>
