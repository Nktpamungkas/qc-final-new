<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
?>
         
<div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Data Detail Persediaan Kain</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="<?php echo $r['id'];?>">
                    <h5><strong>Prod. Order : <?php echo $_GET['id'];?></strong></h5>
                    <table id="example9" class="table table-bordered table-hover table-striped" width="100%">
                        <thead>
                            <tr>
                                <th width="5%"><div align="center">No</div></th>
                                <th width="15%"><div align="center">Tgl Balance</div></th>
                                <th width="15%"><div align="center">Item Element</div></th>
                                <th width="10%"><div align="center">Primary Qty</div></th>
                                <th width="5%"><div align="center">UOM Primary</div></th>
                                <th width="10%"><div align="center">Secondary Qty</div></th>
                                <th width="5%"><div align="center">UOM Secondary</div></th>
                                <th width="15%"><div align="center">Warehouse</div></th>
                                <th width="15%"><div align="center">Lokasi</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                            	$sqldtl="SELECT 
                                BALANCE.ELEMENTSCODE,
                                BALANCE.BASEPRIMARYQUANTITYUNIT,
                                BALANCE.BASEPRIMARYUNITCODE,
                                BALANCE.BASESECONDARYQUANTITYUNIT,
                                BALANCE.BASESECONDARYUNITCODE,
                                BALANCE.LOGICALWAREHOUSECODE,
                                BALANCE.WAREHOUSELOCATIONCODE,
                                BALANCE.WHSLOCATIONWAREHOUSEZONECODE,
                                BALANCE.CREATIONDATETIME 
                                FROM BALANCE BALANCE WHERE BALANCE.LOTCODE ='$modal_id'";
                                $stmt=db2_exec($conn1,$sqldtl, array('cursor'=>DB2_SCROLLABLE));
                            while($r=db2_fetch_assoc($stmt)){
                            ?>
                            <tr>
                                <td align="center" width="5%"><?php echo $no;?></td>
                                <td align="center" width="15%"><?php echo substr($r['CREATIONDATETIME'],0,10);?></td>
                                <td align="center" width="15%"><?php echo $r['ELEMENTSCODE'];?></td>
                                <td align="center" width="5%"><?php echo $r['BASEPRIMARYQUANTITYUNIT'];?></td>
                                <td align="center" width="5%"><?php echo $r['BASEPRIMARYUNITCODE'];?></td>
                                <td align="center" width="5%"><?php echo $r['BASESECONDARYQUANTITYUNIT'];?></td>
                                <td align="center" width="5%"><?php echo $r['BASESECONDARYUNITCODE'];?></td>
                                <td align="center" width="10%"><?php echo $r['LOGICALWAREHOUSECODE'];?></td>
                                <td align="center" width="10%"><?php echo $r['WHSLOCATIONWAREHOUSEZONECODE']."-".$r['WAREHOUSELOCATIONCODE'];?></td>
                            </tr>
                            <?php $no++;}?>
                        </tbody>
                    </table>
		        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary" <?php if($_SESSION['lvl_id']!="LEADERTQ"){echo "disabled"; } ?> >Save Changes</button> -->
                    <!--<?php if($_SESSION['lvl_id']!="ADMIN"){echo "disabled"; } ?>-->
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