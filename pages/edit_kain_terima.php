<?php
	$id = $_POST['id'];
	$sts = $_POST['sts'];		
	$sqlupdate=mysqli_query($conlab,"UPDATE `tbl_test_qc` SET 
				`sts_qc`='$sts',
				`tgl_terimakain`=now(),
				`terimakain_by`='".$_SESSION['usrid']."'
				WHERE `id`='$id' LIMIT 1");
				echo " <script>window.location='KainInLab';</script>";
?>