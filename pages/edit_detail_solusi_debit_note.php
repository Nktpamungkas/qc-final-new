<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
    echo $modal_id;

    $qry3=mysqli_query($con, "SELECT * 
    from tbl_debit_note
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
                        <h4 class="modal-title">Edit Debit Note</h4>
                </div>
                <div class="modal-body">
                <input type="hidden" id="id" name="id" value="<?php echo $row3['id']?>">
                <input type="hidden" id="no_item" name="no_item" value="<?php echo $modal_id?>">
                    <div class="form-group">
                        <label for="dn_kg" class="col-md-4 control-label">KG</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="dn_kg" value="<?php echo $row3['kg']?>" placeholder="0.0" name="dn_kg" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dn_yd" class="col-md-4 control-label">YD</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="dn_satuan" name="dn_satuan" value="<?php echo $row3['satuan']?>" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dn_amount" class="col-md-4 control-label">AMOUNT</label>
                        <div class="col-md-3" >
                            <select name="currency" id="currency" class="form-control">
                            <option value="IDR" <?php if($row3['currency'] == "IDR") echo "selected"; ?>>IDR</option>
                            <option value="USD" <?php if($row3['currency'] == "USD") echo "selected"; ?>>USD</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="dn_amount" name="dn_amount" value="<?php echo $row3['amount']?>" required onkeyup="formatRupiah(this)">
                            <span class="help-block with-errors"></span>
                        </div>
		        </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                   
                   <input type="submit" value="Simpan" name="edit_solusi_db" id="simpan_solusi_db" class="btn btn-primary pull-right" >  
                   <!-- <input type="submit" value="cetak" name="simpan_solusi_db" id="simpan_solusi" class="btn btn-primary pull-right" >   -->
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