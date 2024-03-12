<?php
	$id = $_POST['id'];
	$sts = $_POST['sts'];	
	$approved1 = str_replace("'","''", $_POST['approved1']);
	$sqlupdate=mysqli_query($conlab,"UPDATE `tbl_test_qc` SET 
				`sts_qc`='Hasil Test Parsial',
				`sts_laborat`='Waiting Approval Parsial',
				`approved_qc1` ='$approved1',
				`terimakain_by`='".$_SESSION['usrid']."'
				WHERE `id`='$id' LIMIT 1");
				echo " <script>window.location='KainInLab';</script>";
?>