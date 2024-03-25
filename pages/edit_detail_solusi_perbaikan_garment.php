<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
    echo $modal_id;

    $qry3=mysqli_query($con, "SELECT * 
    from tbl_perbaikan_garment
    where 
    -- id = 15
    no_item = '$modal_id'
    ");
    $row3=mysqli_fetch_array($qry3);
?>
         
<div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit PERBAIKAN GARMENT</h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id" name="id" value="<?php echo $row3['id']?>">
                    <input type="text" id="no_item" name="no_item" value="<?php echo $modal_id?>">
                    <div class="form-group">
                        <label for="pg_pcs" class="col-md-3 control-label">PCS</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="<?php echo $row3['pcs']?>" id="pg_pcs" name="pg_pcs" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pg_amount" class="col-md-3 control-label">AMOUNT</label>
                        <div class="col-md-3" >
                            <select name="currency" id="currency" class="form-control">
                            <option value="IDR" <?php if($row3['currency'] == "IDR") echo "selected"; ?>>IDR</option>
                            <option value="USD" <?php if($row3['currency'] == "USD") echo "selected"; ?>>USD</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="pg_amount" placeholder="Rp. 1.000" value="<?php echo $row3['amount']?>" name="pg_amount" required onkeyup="formatRupiah(this)">
                            <span class="help-block with-errors"></span>
                        </div>
		        </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                   
                   <input type="submit" value="Simpan" name="edit_solusi_pg" id="edit_solusi_pg" class="btn btn-primary pull-right" >  
            
                </div>
            </form>
        </div>
            <!-- /.modal-content -->
</div>
          <!-- /.modal-dialog -->
<script>
  $(function () {
    $('#example9').DataTable({
	  'paging': true,
	})
  });
</script>
