<?php
ini_set("error_reporting", 1);
include"koneksi.php";
$nocounter=$_GET['nocount'];
?>
<div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                <h3 class="box-title">Kain Masuk dari Laborat</h3>
				<br>					
                    <div class="col-lg-12 overflow-auto table-responsive" style="overflow-x: auto;">
                        <table id="example1" class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr class="bg-green">
                                    <th style="border: 1px solid #ddd;">#</th>
                                    <th style="border: 1px solid #ddd;">Suffix</th>
                                    <th style="border: 1px solid #ddd;">No Counter</th>
                                    <th style="border: 1px solid #ddd;">Jenis Testing</th>
                                    <th style="border: 1px solid #ddd;">Treatment</th>
                                    <th style="border: 1px solid #ddd;">Buyer</th>
                                    <th style="border: 1px solid #ddd;">No Warna</th>
                                    <th style="border: 1px solid #ddd;">Nama Warna</th>
                                    <th style="border: 1px solid #ddd;">Item</th>
                                    <th style="border: 1px solid #ddd;">Jenis Kain</th>
                                    <th style="border: 1px solid #ddd;">Personil Testing</th>
                                    <th style="border: 1px solid #ddd;">Permintaan Testing</th>
                                    <th style="border: 1px solid #ddd;">Created By</th>
                                    <th style="border: 1px solid #ddd;">Status</th>
                                    <th style="border: 1px solid #ddd;">Status QC</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								$no=1;
                                $sql = mysqli_query($conlab,"SELECT * FROM tbl_test_qc WHERE sts_laborat <> 'Cancel' and sts_qc <> 'Kain OK'");
                                while ($r = mysqli_fetch_array($sql)) {                                    
                                    $bgcolor = ($col++ & 1) ? 'gainsboro' : 'antiquewhite';
									$detail2=explode(",",$r['permintaan_testing']);
                                ?>
                                    <tr>
                                        <td valign="center">
                                            <?php echo $no++; ?>
                                        </td>
                                        <td valign="center" align="center"><?php echo $r['suffix']; ?></td>
                                        <td valign="center"><?php echo $r['no_counter']; ?></td>
                                        <td valign="center"><?php echo $r['jenis_testing']; ?></td>
                                        <td valign="center"><?php echo $r['treatment']; ?></td>
                                        <td valign="center"><?php echo $r['buyer']; ?></td>
                                        <td valign="center" align="left"><?php echo $r['no_warna']; ?></td>
                                        <td valign="center"><?php echo $r['warna']; ?></td>
                                        <td valign="center"><?php echo $r['no_item']; ?></td>
                                        <td valign="center"><?php echo $r['jenis_kain']; ?></td>
                                        <td valign="center"><?php echo $r['nama_personil_test']; ?></td>
                                      <td valign="center" align="left"><?php echo $r['permintaan_testing']; ?></td>
                                        <td valign="top" class="13"><?php echo $r['created_by']; ?><hr class="divider"><span class="label <?php if($r['sts']=="normal"){ echo "label-warning"; }else{ echo "label-danger blink_me"; } ?>"><?php echo $r['sts']; ?></span></td>
                                      <td valign="top" class="13"><span class="label <?php if($r['sts_laborat']=="Open"){ echo "label-info"; } else if($r['sts_laborat']=="Waiting Approval"){ echo "label-info"; }else if($r['sts_laborat']=="In Progress"){ echo "label-success"; }else{ echo "label-primary"; } ?>"><?php echo $r['sts_laborat']; ?></span><hr class="divider">
                                      <em><?php echo $r['note_laborat']; ?></em></td>
                                      <td align="left" valign="top" class="13"><?php if($r['sts_qc']=="Belum Terima Kain" or $r['sts_qc']=="Kain Sudah diTes"){ echo "<a href='#' class='kain_terima' id='".$r['id']."'>"; } ?><span class="label <?php if($r['sts_qc']=="Tunggu Kain"){ echo "label-primary"; }else if($r['sts_qc']=="Sudah Terima Kain"){ echo "label-success blink_me"; } else if($r['sts_qc']=="Kain Sudah diTes"){ echo "label-info"; } else if($r['sts_qc']=="Kain Bisa Diambil"){ echo "label-danger blink_me"; }else{ echo "label-warning"; } ?>"><?php echo $r['sts_qc']; ?></span><?php if($r['sts_qc']=="Belum Terima Kain"){ echo "</a>"; } ?><hr class="divider"><em><a data-pk="<?php echo $r['id'] ?>" data-value="<?php echo $r['note_qc'] ?>" class="note_qc" href="javascript:void(0)"><?php echo $r['note_qc']; ?></a></em></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
<div id="TerimaKain" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
