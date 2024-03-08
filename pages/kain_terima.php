<?php
include("../koneksi.php");
    $modal_id=$_GET['id'];
	$qry=mysqli_query($conlab,"SELECT * FROM tbl_test_qc  WHERE id='$modal_id'");
	$r=mysqli_fetch_array($qry);
	?>
          <div class="modal-dialog ">
            <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="UbahKainTerima" enctype="multipart/form-data">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Terima Kain dari Dept. LAB</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                  <label for="sts" class="col-sm-3 control-label">Status</label>
                  <div class="col-sm-4">
                   <select name="sts" class="form-control" id="sts" required>
					   <?php if($r['sts_qc']=="Belum Terima Kain") { ?>
					   <option value="Belum Terima Kain" <?php if($r['sts_qc']=="Belum Terima Kain"){ echo "SELECTED"; } ?>>Belum Terima Kain</option>
					   <option value="Sudah Terima Kain" <?php if($r['sts_qc']=="Sudah Terima Kain"){ echo "SELECTED"; } ?>>Sudah Terima Kain</option>
					   <?php } ?>
					   <?php if($r['sts_qc']=="Kain Sudah diTes") { ?>
					   <option value="Kain Sudah diTes" <?php if($r['sts_qc']=="Kain Sudah diTes"){ echo "SELECTED"; } ?>>Kain Sudah DiTes</option>
					   <option value="Kain Bisa Diambil" <?php if($r['sts_qc']=="Kain Bisa Diambil"){ echo "SELECTED"; } ?>>Kain Bisa Diambil</option>
					   <?php } ?>
				   </select>	   
                  </div>
                </div> 
				  <?php if($r['sts_qc']=="Belum Terima Kain") { ?>
				  <div class="form-group">
                  <label for="diterima_oleh" class="col-sm-3 control-label">DiTerima Oleh</label>
                  <div class="col-sm-6">
				  <input type="text" class="form-control" value="" name="diterima_oleh" maxlength="30" required>		   
                  </div>
                  </div>
				  <div class="form-group">
                  <label for="nama_penerima" class="col-sm-3 control-label">Nama Penerima</label>
                  <div class="col-sm-6">
				  <input type="text" class="form-control" value="" name="nama_penerima" maxlength="30" required>		   
                  </div>
                  </div>
				  <?php } ?>
				  <?php if($r['sts_qc']=="Kain Sudah diTes") { ?>
				  <div class="form-group">
                  <label for="approved1" class="col-sm-3 control-label">Approved 1</label>
                  <div class="col-sm-6">
				  <input type="text" class="form-control" value="" name="approved1" maxlength="30" required>		   
                  </div>
                  </div>
				  <div class="form-group">
                  <label for="approved2" class="col-sm-3 control-label">Approved 2</label>
                  <div class="col-sm-6">
				  <input type="text" class="form-control" value="" name="approved2" maxlength="30">		   
                  </div>
                  </div>
				  <?php } ?>
				<input type="hidden" id="id" name="id" value="<?php echo $modal_id;?>"> 
				<em>Note: Jika kain diambil parsial harap nama Approved 2 diisikan </em> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
          
<script>
  
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    }),
	//Date picker
    $('#datepicker1').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    }),
	//Date picker
    $('#datepicker2').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    }),
	//Date picker
    $('#datepicker3').datepicker({
      autoclose: true,
	  format: 'yyyy-mm-dd'
    })
</script>

