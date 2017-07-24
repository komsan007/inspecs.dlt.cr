<?php session_start();?>
<?php
if(	empty($_SESSION['ses_userid']) || 
	empty($_SESSION['ses_card_id']) || 
	empty($_SESSION['ses_id']) || 
	($_SESSION['ses_userid'] <> session_id())){
	echo "<script>window.location='index.php';</script>";
}
?>
<?php include('header.php');?>
<?php   
	$numRows = 0;
	if (!empty($_SESSION['ses_id'])) {
			$sql  = " SELECT *, ";
			$sql .= " (YEAR(created_at)) as Y, (MONTH(created_at)) as m, (DAY(created_at)) as d, TIME(created_at) as T ";
			$sql .= " FROM records_status WHERE regis_id ='".$_SESSION['ses_id']."'";
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
<div class="col-sm-12" style="background-color: #8920d4;color: #ffffff;">
<h4> >> ผลการค้นหา: <?php echo $_SESSION['ses_name']." ".$_SESSION['ses_lastname'];?> ID No. <?php echo $_SESSION['ses_card_id'];?></h4> </div>      
<br> 
<br> 
<br>
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
  $sql  = " SELECT * FROM register_data ";
  $sql .= " WHERE register_data.id ='".$row['regis_id']."' ";
  $check_data = mysqli_query($conn, $sql);
  if($check_data) {
    $numRows = mysqli_num_rows($check_data);
  }
  if($numRows > 0) {
    $rowData=mysqli_fetch_assoc($check_data);
    mysqli_free_result($check_data);
  }
?>


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
        <td><?php echo $row["d"]."/".$row["m"]."/".(($row["Y"])+543)." &nbsp;".$row["T"];?> &nbsp;  น.</td>
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

<?php include("contentRemark.php"); ?>

<?php include("footer.php"); ?>