<style>
input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
 
input[type="number"] {
    -moz-appearance: textfield;
}
<?php

$nodemand = $_GET['nodemand'];
$sqlCek = mysqli_query($con, "SELECT no_test FROM tbl_tq_nokk WHERE nodemand='$nodemand' ORDER BY id DESC LIMIT 1");
$cek = mysqli_num_rows($sqlCek);
$rcek = mysqli_fetch_array($sqlCek);

$no_test_value = !empty($rcek['no_test']) ? $rcek['no_test'] : '';

?>
</style>
	<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form0" id="form0">
		<div class="box box-info">
   	<div class="box-header with-border">
    	<h3 class="box-title">Report Kaken Mizuno</h3>
		<div class="box-tools pull-right">
		</div>
  	</div>
  	<div class="box-body"> 
	 	<div class="col-md-6">
     		<!-- <div class="form-group">
                  <label for="no_po" class="col-sm-3 control-label">No Demand</label>
                  	<div class="col-sm-4">
						<div class="input-group">	  
							<input name="nodemand" type="text" class="form-control" id="nodemand" 
								onchange="window.location='ReportKakenMizunoNoTest-<?php echo $no_test_value; ?>'" 
								value="<?php if($_GET['notest']!="") { echo $_GET['notest']; } else { echo $nodemand; } ?>" 
								placeholder="No Demand" required <?php if($_SESSION['lvl_id']=="TQ"){echo "readonly";}?>>
						</div>	  
		  			</div>
            </div>	 -->
			<div class="form-group">
				<label for="no_test" class="col-sm-3 control-label">No Test</label>
				<div class="col-sm-4">
					<input name="no_test" type="text" class="form-control" id="no_test" placeholder="No Test" autocomplete="off" 
					onchange="window.location='ReportKakenMizunoNoTest-'+this.value" value="<?php if($cek>0){echo $rcek['no_test'];}else{echo $_GET['no_test'];} ?>" >
				</div>				   
			</div>
		</div>
	</div>
	</div>
	</form>


