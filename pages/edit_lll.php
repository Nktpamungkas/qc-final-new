<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
	$modal=mysqli_query($con,"SELECT * FROM `master_matrialname` WHERE id='$modal_id'");
while($r=mysqli_fetch_array($modal)){
?>
         
<div class="modal-dialog modal1">
        <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="LLL_Edit" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Data LLL Material Name</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="<?php echo $r['id'];?>">
                        <div class="form-group">
                            <label for="no_item" class="col-md-2 control-label">No Hanger</label>
                            <div class="col-md-8">
                                <input name="no_item" type="text" class="form-control" id="no_item" placeholder="No Hanger" required autocomplete="off" value="<?php echo $r['item'];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_item" class="col-md-2 control-label">Material Name</label>
                            <div class="col-md-8">
                                <input name="material_name" type="text" class="form-control" id="material_name" placeholder="Material Name" required autocomplete="off" value="<?php echo $r['matrial_name'];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hangtag" class="col-md-2 control-label">Fiber Content</label>
                            <div class="col-md-8">
                                <textarea name="fiber_content" class="form-control" id="fiber_content" placeholder="Fiber Content" required autocomplete="off"><?php echo $r['fiber_content'];?></textarea>
                            </div>
                        </div>
		        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" <?php if($_SESSION['lvl_id']!="LEADERTQ"){echo "disabled"; } ?> >Save Changes</button>
                    <!--<?php if($_SESSION['lvl_id']!="ADMIN"){echo "disabled"; } ?>-->
                </div>
            </form>
        </div>
            <!-- /.modal-content -->
</div>
          <!-- /.modal-dialog -->
          <?php } ?>