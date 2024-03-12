<?php
include("../koneksi.php");
    $modal_id=$_GET['id'];
	$qry=mysqli_query($conlab,"SELECT * FROM tbl_test_qc  WHERE id='$modal_id'");
	$r=mysqli_fetch_array($qry);
	?>
          <div class="modal-dialog ">
            <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="UbahKainApprovedParsial" enctype="multipart/form-data">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Approved Kain Test Dept. LAB Parisal</h4>
              </div>
              <div class="modal-body">                  
				  <div class="form-group">
                  <label for="approved1" class="col-sm-3 control-label">Approved 1</label>
                  <div class="col-sm-6">
				  <input type="text" class="form-control" value="<?php echo $r['approved_qc1'];?>" name="approved1" maxlength="30" required>		   
                  </div>
                  </div>
				 <input type="hidden" id="id" name="id" value="<?php echo $modal_id;?>"> 
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

