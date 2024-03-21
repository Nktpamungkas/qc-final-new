<?php
session_start(); 
ini_set("error_reporting",1);

$DemandNo	= isset($_POST['demandno']) ? $_POST['demandno'] : '';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Update Additional Data</title>
	</head>

	<body>
  <div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"> Filter Elements Inspection</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1">
    <div class="box-body">	
      <div class="form-group">
        <div class="col-sm-2">
          <input name="demandno" type="text" class="form-control pull-right" id="order" placeholder="No Demand" value="<?php echo $DemandNo;  ?>" autocomplete="off"/>
        </div>
        <!-- /.input group -->
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-2">
        <button type="submit" class="btn btn-block btn-social btn-linkedin btn-sm" name="save" style="width: 60%">Search <i class="fa fa-search"></i></button>
      </div>      
    </div>
    <!-- /.box-footer -->
  </form>
</div>
  <form method="post" name="form2" action="#">		
  <div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Additional Data</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="box-body">
	  <div class="col-md-6">
      <div class="form-group">
		<label for="disdefect" class="col-sm-3 control-label">Disposisi Defect</label>
		<div class="col-sm-4">
		  <input name="disdefect" type="text" class="form-control pull-right" id="disdefect" placeholder="Disposisi Defect" value="" autocomplete="off"/>
		</div>
		<!-- /.input group -->
	  </div>
	 </div>	  
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-sm btn-success pull-right" name="cetak" value="Cetak" formtarget="_blank"><i class="fa fa-save"></i> Update</button>      
    </div>
    <!-- /.box-footer -->
</div>	
		
  <div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Data Elements Inspection</h3>
							<br>
						</div>
						<div class="box-body">								
							<table id="example1" class="table table-bordered table-hover table-striped nowrap" style="width:100%"> 
								<thead class="bg-red">
									<tr>
										<th width="24">
											<div align="center">#</div>
										</th>
										<th width="24">
											<div align="center">No</div>
										</th>
										<th width="41">
											<div align="center">Elements</div>
										</th>
										<th width="58">
											<div align="center">Kg</div>
										</th>
										<th width="82">
											<div align="center">Ket. St</div>
										</th>
										<th width="61"><div align="center">Grade</div></th>
										<th width="61">
											<div align="center">Opertor</div>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
  $sqlData  = db2_exec($conn1, "SELECT x.* FROM DB2ADMIN.ELEMENTSINSPECTION x
WHERE LENGTH(TRIM(x.ELEMENTCODE)) > 11 AND ELEMENTITEMTYPECODE ='KFF' AND x.DEMANDCODE ='$DemandNo'");
  while ($r= db2_fetch_assoc($sqlData)) {
      $no++;
      $bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
      ?>
									<tr>
										<td align="center"><input type=checkbox name="cek[<?php echo $no; ?>]" value="<?php echo $r['id']; ?>"></td>
										<td align="center">
											<?php echo $no; ?>
										</td>
										<td align="center"><?php echo $r['ELEMENTCODE'];?></td>
										<td align="center"><?php echo $r['WEIGHTNET'];?></td>
										<td align="center"><?php echo $r['QUALITYREASONCODE'];?></td>
										<td align="center"><?php echo $r['QUALITYCODE'];?></td>
										<td align="center"><?php echo $r['OPERATORCODE'];?></td>
									</tr>
									<?php
  } ?>
								</tbody>
								<tfoot class="bg-red">
									<tr>
										<th width="24">
											<div align="center">#</div>
										</th>
										<th width="24">
											<div align="center">No</div>
										</th>
										<th width="41">
											<div align="center">Elements</div>
										</th>
										<th width="58">
											<div align="center">Kg</div>
										</th>
										<th width="82">
											<div align="center">Ket. St</div>
										</th>
										<th width="61"><div align="center">Grade</div></th>
										<th width="61">
											<div align="center">Opertor</div>
										</th>
									</tr>
								</tfoot>
							</table>
							<!-- Modal Popup untuk Edit-->
							<div id="DetailProduksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  </div>
							<div id="CekButuhBenang" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							</div>
							<div id="GDBTerima" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							</div>

					  </div>
					</div>
				</div>
			</div>
  </form>
	</body>

</html>
